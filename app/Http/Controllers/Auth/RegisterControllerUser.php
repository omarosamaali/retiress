<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail; // <--- Add this line

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // For handling dates and times
use Exception;
use Illuminate\Support\Facades\Http;

class RegisterControllerUser extends Controller
{
    public function showRegistrationForm()
    {
        return view('members.members.register');
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'g-recaptcha-response' => 'required'
            ], [
                'g-recaptcha-response.required' => 'يرجى التحقق من أنك لست روبوت'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // التحقق من reCAPTCHA
            $recaptchaSecret = config('services.recaptcha.secret');
            $recaptchaResponse = $request->input('g-recaptcha-response');

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip()
            ]);

            $responseData = $response->json();

            // تسجيل الاستجابة للتأكد
            \Log::info('reCAPTCHA Response:', $responseData);

            if (!$responseData['success']) {
                $errorCodes = $responseData['error-codes'] ?? [];
                \Log::error('reCAPTCHA Failed:', $errorCodes);

                return response()->json([
                    'errors' => ['recaptcha' => ['فشل التحقق من reCAPTCHA. حاول مرة أخرى.']]
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'مستخدم'
            ]);

            auth()->login($user);

            return response()->json([
                'success' => true,
                'message' => 'تم تسجيل الحساب بنجاح!',
                'redirect' => route('members.login')
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Registration Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تسجيل الحساب',
                'error' => config('app.debug') ? $e->getMessage() : 'خطأ في الخادم'
            ], 500);
        }
    }

    public function forgetpassword()
    {
        return view('members.members.forgetpassword');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = rand(100000, 999999);
        $expirationTime = Carbon::now()->addMinutes(10);

        $user->otp_code = $otp;
        $user->otp_expires_at = $expirationTime;
        $user->save();

        \Log::info('Attempting to send OTP for email: ' . $request->email);

        try {
            // Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            //     \Log::info('Inside Mail::send() callback for email: ' . $user->email);
            //     $message->to($user->email);
            //     $message->subject('Your Password Reset OTP');
            //     \Log::info('Mail subject and recipient set.');
            // });

            \Log::info('OTP email sent successfully for email: ' . $user->email);

            // ----------------------------------------------------
            // **أضف هذا السطر لتخزين الإيميل في الـ session**
            session(['password_reset_email' => $user->email]);
            // ----------------------------------------------------

            return redirect()->route('members.otp')->with('success', 'OTP sent to your email.');
        } catch (Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage(), [
                'email' => $user->email,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }



    public function otp()
    {
        return view('members.members.otp');
    }

    public function changePassword()
    {
        return view('members.members.changepassword');
    }

    // This method will verify the OTP
    public function verifyOtp(Request $request)
    {
        // Debugging: سجل ما تستقبله
        \Log::info('Verifying OTP request received.', $request->all());

        $request->validate([
            'otp' => 'required|string|min:6|max:6',
            'email' => 'required|email|exists:users,email',
        ]);

        // Debugging: سجل قيمة OTP والإيميل بعد الـ validation
        \Log::info('OTP and Email validated. OTP: ' . $request->otp . ', Email: ' . $request->email);


        $user = User::where('email', $request->email)->first();

        // Debugging: تأكد من أن المستخدم موجود
        if (!$user) {
            \Log::error('OTP Verification: User not found for email: ' . $request->email);
            return back()->withErrors(['otp' => 'User not found for this email.']);
        }

        // Debugging: سجل البيانات اللي هتتقارن
        \Log::info('User found. Stored OTP: ' . $user->otp_code . ', Received OTP: ' . $request->otp . ', Expired At: ' . ($user->otp_expires_at ? $user->otp_expires_at->toDateTimeString() : 'N/A') . ', Current Time: ' . Carbon::now()->toDateTimeString());


        if (!$user || $user->otp_code !== $request->otp || Carbon::now()->isAfter($user->otp_expires_at)) {
            // Debugging: سجل سبب فشل التحقق
            $reason = [];
            if (!$user) $reason[] = 'User null';
            if ($user && $user->otp_code !== $request->otp) $reason[] = 'OTP mismatch';
            if ($user && Carbon::now()->isAfter($user->otp_expires_at)) $reason[] = 'OTP expired';
            \Log::warning('OTP Verification failed for email: ' . $request->email . '. Reason: ' . implode(', ', $reason));

            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP is valid, clear it and redirect to change password page
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Store email in session to use on the change password page
        session(['password_reset_email' => $user->email]);

        \Log::info('OTP verified successfully for email: ' . $user->email . '. Redirecting to change password.');
        return redirect()->route('members.changepassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $email = session('password_reset_email');
        if (!$email) {
            return redirect()->route('members.forgetpassword')->withErrors(['error' => 'Password reset session expired. Please start over.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('members.forgetpassword')->withErrors(['error' => 'User not found.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        // Clear the session variable after successful password change
        session()->forget('password_reset_email');

        return redirect()->route('members.login')->with('success', 'Your password has been changed successfully!');
    }
}
