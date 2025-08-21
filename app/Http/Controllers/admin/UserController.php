<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
// import AUth
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // تأكد من استيراد Carbon
use App\Mail\OtpMail; // تأكد من استيراد OtpMail
use Illuminate\Support\Facades\Mail; // <--- ADD THIS LINE

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:مدير,مشرف,مدخل بيانات,طاه',
            'status' => 'sometimes|in:فعال,غير فعال,بانتظار التفعيل',
        ]);

        // إعداد بيانات المستخدم
        $userData = [
            'name' => $request->name, // الاسم الرئيسي (يفترض أنه باللغة العربية)
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status ?? 'بانتظار التفعيل', // الحالة الأولية
            'email_verified_at' => null, // يجب أن تكون null حتى يتم تأكيد الـ OTP
            'otp_expires_at' => null, // سيتم تعيينه لاحقاً إذا كان طاهياً
        ];

        // ترجمة الاسم للغات الأخرى
        $tr = new GoogleTranslate(); // الافتراضي 'en' كـ source language. إذا كان الـ input Arabic, فاجعلها 'ar'.
        // مثال: new GoogleTranslate('ar');
        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new User())->getFillable())) {
                    $userData[$columnName] = $tr->setTarget($code)->translate($request->input('name'));
                }
            } catch (\Exception $e) {
                $userData[$columnName] = null;
                Log::error("Translation failed for {$code} (User Store): " . $e->getMessage());
            }
        }

        $user = User::create($userData); // تم إنشاء المستخدم

        // logic for chef
        if ($request->role === 'طاه') {
            // إنشاء OTP وتعيينه للمستخدم
            $otp = (string)random_int(100000, 999999);
            $otpExpiresAt = Carbon::now()->addMinutes(config('auth.passwords.otp_expire_minutes', 5));

            $user->forceFill([
                'otp' => $otp,
                'otp_expires_at' => $otpExpiresAt,
            ])->save();

            // إرسال الـ OTP عبر البريد الإلكتروني
            Mail::to($user->email)->send(new OtpMail($otp));

            // بيانات ChefProfile
            $chefProfileData = [
                'user_id' => $user->id,
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            // رفع الصورة
            if ($request->hasFile('official_image')) {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');
                $chefProfileData['official_image'] = $imagePath;
            }

            // أسعار الاشتراك (إذا كان نوع العقد annual_subscription)
            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months'] = $request->subscription_12_months_price; // تم تصحيح الاسم
            } else {
                $chefProfileData['subscription_3_months'] = null;
                $chefProfileData['subscription_6_months'] = null;
                $chefProfileData['subscription_12_months'] = null; // تم تصحيح الاسم
            }

            // إنشاء ChefProfile
            ChefProfile::create($chefProfileData);

            // إعادة التوجيه إلى صفحة تأكيد الـ OTP للطهاة
            return redirect()->route('c1he3f.auth.otp-confirm', ['email' => $user->email])
                ->with('success', 'تم التسجيل بنجاح! الرجاء إدخال رمز التحقق الذي تم إرساله إلى بريدك الإلكتروني.');
        } else {
            // إذا لم يكن الدور 'طاه'، قم بتسجيل الدخول مباشرة (كما كان يحدث سابقاً)
            Auth::login($user);
            return redirect()->route('admin.users.index')
                ->with('success', 'تم إضافة المستخدم بنجاح.');
        }
    }


    // End of public function store
    public function show(User $user)
    {
        $user->load('chefProfile');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255', // name_en
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:مدير,موظف استقبال,أمين الصندوق,عضو,مدخل بيانات',
            'status' => 'required|in:فعال,غير فعال,بانتظار التفعيل,بإنتظار إستكمال البيانات',
        ];

        $request->validate($rules);

        $data = [
            'name_en' => $request->name, // Save input as name_en
            'name' => $request->name, // Save input as name (for compatibility)
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Initialize Google Translate
        $tr = new GoogleTranslate('en'); // Source language is English

        // Translate name to other languages
        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new User())->getFillable())) {
                    $data[$columnName] = $tr->setTarget($code)->translate($request->input('name'));
                } else {
                    Log::warning("Column {$columnName} not found in User model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $data[$columnName] = null;
                Log::error("Translation failed for {$code} (User Update): " . $e->getMessage());
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->role === 'طاه') {
            $chefProfileData = [
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months_price'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months_price'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months_price'] = $request->subscription_12_months_price;
            } else {
                $chefProfileData['subscription_3_months_price'] = null;
                $chefProfileData['subscription_6_months_price'] = null;
                $chefProfileData['subscription_12_months_price'] = null;
            }

            if ($user->chefProfile) {
                $imagePath = $user->chefProfile->official_image;
                if ($request->hasFile('official_image')) {
                    if ($imagePath && Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    $imagePath = $request->file('official_image')->store('chef_images', 'public');
                }
                $chefProfileData['official_image'] = $imagePath;
                $user->chefProfile->update($chefProfileData);
            } else {
                $imagePath = null;
                if ($request->hasFile('official_image')) {
                    $imagePath = $request->file('official_image')->store('chef_images', 'public');
                }
                $chefProfileData['user_id'] = $user->id;
                $chefProfileData['official_image'] = $imagePath;
                ChefProfile::create($chefProfileData);
            }
        } else {
            if ($user->chefProfile) {
                if ($user->chefProfile->official_image && Storage::exists($user->chefProfile->official_image)) {
                    Storage::delete($user->chefProfile->official_image);
                }
                $user->chefProfile->delete();
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك حذف حسابك الشخصي');
        }

        if ($user->chefProfile && $user->chefProfile->official_image) {
            Storage::delete($user->chefProfile->official_image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }
}
