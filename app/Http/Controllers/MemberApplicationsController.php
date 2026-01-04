<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MemberApplicationsController extends Controller
{
    public function showForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لتقديم طلب العضوية أو تجديدها.');
        }
        return view('members.sidebar.membership-show');
    }

    /**
     * Generate a unique 5-digit membership number.
     */


    /**
     * تخزين بيانات طلب العضوية الجديد.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لإكمال هذه العملية.');
        }

        $userId = Auth::id();

        $existingApplication = MemberApplication::where('user_id', $userId)->first();
        if ($existingApplication) {
            return redirect()->back()->with('error', 'لقد قمت بتقديم طلب بالفعل. لا يمكن تقديم أكثر من طلب واحد.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'emirate' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'national_id' => 'required|string|unique:member_applications,national_id|max:255',
            'educational_qualification' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'home_phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'po_box' => 'nullable|string|max:255',
            'retirement_date' => 'nullable|date',
            'contract_type' => 'nullable|string|in:نظامي,مبكر',
            'early_reason' => 'nullable|string|max:500',
            'pension' => 'nullable|string|max:255',
            'passport_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'national_id_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'personal_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'educational_qualification_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'retirement_card_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'professional_experience.*.year' => 'nullable|string|max:255',
            'professional_experience.*.job_title' => 'nullable|string|max:255',
            'professional_experience.*.employer' => 'nullable|string|max:255',
            'professional_experience.*.years_of_experience' => 'nullable|integer',
            'previous_experience.*.year' => 'nullable|string|max:255',
            'previous_experience.*.job_title' => 'nullable|string|max:255',
            'previous_experience.*.employer' => 'nullable|string|max:255',
            'previous_experience.*.years_of_experience' => 'nullable|integer',
        ]);

        $user_id = Auth::id();
        $data = $request->except([
            'passport_photo',
            'national_id_photo',
            'personal_photo',
            'educational_qualification_photo',
            'retirement_card_photo',
            'professional_experience',
            'previous_experience',
        ]);

        $fileFields = [
            'passport_photo',
            'national_id_photo',
            'personal_photo',
            'educational_qualification_photo',
            'retirement_card_photo',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('member_applications_documents/' . $user_id, 'public');
                $data[$field . '_path'] = $path;
            }
        }

        $data['user_id'] = $user_id;
        $data['membership_number'] = $this->generateMembershipNumber();
        $data['pension'] = $request->input('pension');
        if ($request->has('professional_experience')) {
            $cleanedExperiences = [];
            foreach ($request->input('professional_experience') as $experienceData) {
                if (!empty(array_filter($experienceData))) {
                    $cleanedExperiences[] = $experienceData;
                }
            }
            $data['professional_experiences'] = $cleanedExperiences;
        } else {
            $data['professional_experiences'] = [];
        }

        if ($request->has('previous_experience')) {
            $cleanedPreviousExperiences = [];
            foreach ($request->input('previous_experience') as $experienceData) {
                if (!empty(array_filter($experienceData))) {
                    $cleanedPreviousExperiences[] = $experienceData;
                }
            }
            $data['previous_experience'] = $cleanedPreviousExperiences;
        } else {
            $data['previous_experience'] = [];
        }

        $application = MemberApplication::create($data);
        // Mail::raw(
        //     'تم تقديم طلب العضوية بنجاح! رقم العضوية هو: ' . $application->membership_number,
        //     function ($message) use ($application) {
        //         $message->to([$application->email, 'contact@uaeretired.ae'])
        //         ->subject('تم تقديم طلب العضوية بنجاح');
        //     }
        // );
        return redirect()->back()->with('success', 'تم تقديم طلب العضوية بنجاح! رقم العضوية هو: ' . $application->membership_number);
    }

    /**
     * معالجة طلب تجديد العضوية.
     */
    public function renew(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'يجب تسجيل الدخول لتجديد عضويتك.'], 401);
            }
            $validated = $request->validate([
                'membership_id_kw' => 'required|string|max:255',
                'national_id_kw' => 'required|string|max:255',
                'email_kw' => 'required|email|max:255',
            ]);
            $application = MemberApplication::where('membership_number', $validated['membership_id_kw'])
                ->where('national_id', $validated['national_id_kw'])
                ->where('email', $validated['email_kw'])
                ->where('user_id', Auth::id())
                ->first();

            if (!$application) {
                \Log::warning('Application not found', [
                    'membership_number' => $validated['membership_id_kw'],
                    'user_id' => Auth::id()
                ]);
                return response()->json(['error' => 'بيانات العضوية المدخلة غير صحيحة أو لا تتطابق مع حسابك.'], 422);
            }

            \Log::info('Application found', ['id' => $application->id]);

            // تحديث تاريخ انتهاء العضوية بإضافة سنة
            $currentExpirationDate = \Carbon\Carbon::parse($application->expiration_date);
            $newExpirationDate = $currentExpirationDate->addYear();

            $application->expiration_date = $newExpirationDate;
            $application->save();

            \Log::info('Application renewed successfully', [
                'id' => $application->id,
                'new_expiration_date' => $newExpirationDate->format('Y-m-d')
            ]);

            // Mail::raw(
            //     "تم تقديم طلب تجديد العضوية بنجاح!\n\n" .
            //         "رقم العضوية: " . $application->membership_number . "\n" .
            //         "الاسم: " . $application->full_name . "\n" .
            //         "رقم الهاتف: " . $application->mobile_phone,
            //     function ($message) use ($application) {
            //         $message->to([$application->email, 'contact@uaeretired.ae'])
            //             ->subject('طلب تجديد العضوية');
            //     }
            // );

            return response()->json([
                'message' => 'تم ارسال طلب التجديد بنجاح وسيتم التواصل معكم بالبريد الإلكتروني المسجل لاستكمال الاجراءات',
                'membership_number' => $application->membership_number,
                'expiration_date' => $newExpirationDate->format('Y-m-d')
            ], 200);


        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json([
                'error' => 'بيانات غير صحيحة',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Renewal error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'حدث خطأ غير متوقع. الرجاء المحاولة لاحقاً.'
            ], 500);
        }
    }

    private function generateMembershipNumber()
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $attempt++;
            $number = 'MEM-' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

            if ($attempt >= $maxAttempts) {
                throw new \Exception('Failed to generate unique membership number after ' . $maxAttempts . ' attempts');
            }
        } while (MemberApplication::where('membership_number', $number)->exists());

        return $number;
    }

    /**
     * Display membership requirements for the authenticated user.
     */
    public function showRequirements()
    {
        // Get the member application for the currently authenticated user
        $memberApplication = MemberApplication::where('user_id', Auth::user()->id)->first();

        // Check if a membership application was found for the user
        $membership = $memberApplication; // Assuming membership is the same as memberApplication

        return view('members.sidebar.my-membership', compact('memberApplication', 'membership'));
    }
}
