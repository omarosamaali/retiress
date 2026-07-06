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
        return view('members.membership.wizard');
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

        $postMaxBytes = $this->iniSizeToBytes(ini_get('post_max_size'));
        $contentLength = (int) $request->server('CONTENT_LENGTH');
        if ($contentLength > 0 && $postMaxBytes > 0 && $contentLength > $postMaxBytes) {
            return redirect()->back()->withInput()->with(
                'error',
                'حجم الملفات المرفقة كبير جداً. يرجى تقليل حجم الصور (يفضّل أقل من 4 ميجابايت لكل ملف) والمحاولة مرة أخرى.'
            );
        }

        $userId = Auth::id();

        $existingApplication = MemberApplication::where('user_id', $userId)->first();
        if ($existingApplication) {
            return redirect()->back()->with('error', 'لقد قمت بتقديم طلب بالفعل. لا يمكن تقديم أكثر من طلب واحد.');
        }

        $fileRules = 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096';

        try {
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
                'contract_type' => 'required|string|in:نظامي,مبكر',
                'early_reason' => 'nullable|string|max:500',
                'pension' => 'required|string|max:255',
                'passport_photo' => $fileRules,
                'national_id_photo' => $fileRules,
                'personal_photo' => $fileRules,
                'educational_qualification_photo' => $fileRules,
                'retirement_card_photo' => $fileRules,
                'professional_experience.*.year' => 'nullable|string|max:255',
                'professional_experience.*.job_title' => 'nullable|string|max:255',
                'professional_experience.*.employer' => 'nullable|string|max:255',
                'professional_experience.*.years_of_experience' => 'nullable|string|max:255',
                'terms_accepted' => 'accepted',
            ], [
                'passport_photo.max' => 'صورة جواز السفر يجب ألا تتجاوز 4 ميجابايت.',
                'national_id_photo.max' => 'صورة الهوية يجب ألا تتجاوز 4 ميجابايت.',
                'personal_photo.max' => 'الصورة الشخصية يجب ألا تتجاوز 4 ميجابايت.',
                'educational_qualification_photo.max' => 'صورة المؤهل يجب ألا تتجاوز 4 ميجابايت.',
                'retirement_card_photo.max' => 'صورة بطاقة التقاعد يجب ألا تتجاوز 4 ميجابايت.',
                'passport_photo.uploaded' => 'فشل رفع صورة جواز السفر. تأكد أن حجم الملف لا يتجاوز 4 ميجابايت.',
                'national_id_photo.uploaded' => 'فشل رفع صورة الهوية. تأكد أن حجم الملف لا يتجاوز 4 ميجابايت.',
                'personal_photo.uploaded' => 'فشل رفع الصورة الشخصية. تأكد أن حجم الملف لا يتجاوز 4 ميجابايت.',
                'educational_qualification_photo.uploaded' => 'فشل رفع صورة المؤهل. تأكد أن حجم الملف لا يتجاوز 4 ميجابايت.',
                'retirement_card_photo.uploaded' => 'فشل رفع صورة بطاقة التقاعد. تأكد أن حجم الملف لا يتجاوز 4 ميجابايت.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        }

        try {
        $data = $request->except([
            'passport_photo',
            'national_id_photo',
            'personal_photo',
            'educational_qualification_photo',
            'retirement_card_photo',
            'professional_experience',
            'terms_accepted',
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
                $path = $request->file($field)->store('member_applications_documents/' . $userId, 'public');
                $data[$field . '_path'] = $path;
            }
        }

        $data['user_id'] = $userId;
        $data['status'] = '1'; // قيد التفعيل — ينتظر مراجعة الموظف
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

        $data['previous_experience'] = [];

        $application = MemberApplication::create($data);

        // Push notification للموظفين
        \App\Http\Controllers\PushController::sendToStaff(
            'طلب عضوية جديد',
            ($data['full_name'] ?? 'عضو جديد') . ' قدّم طلب عضوية جديدة',
            '/admin/manageMembership'
        );

        return redirect()->back()->with('success', 'تم تقديم طلب العضوية بنجاح! رقم العضوية هو: ' . $application->membership_number);
        } catch (\Throwable $e) {
            \Log::error('Membership application store failed', [
                'user_id' => $userId,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withInput()->with(
                'error',
                'حدث خطأ أثناء إرسال طلب العضوية. يرجى التحقق من حجم الملفات والمحاولة مرة أخرى.'
            );
        }
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

    public function editApplication()
    {
        $application = MemberApplication::where('user_id', Auth::id())->first();
        if (! $application) {
            return redirect()->route('members.membership-show')
                ->with('error', 'لا يوجد طلب عضوية مرتبط بحسابك.');
        }
        return view('members.membership.edit', compact('application'));
    }

    public function updateApplication(Request $request)
    {
        $application = MemberApplication::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'mobile_phone'    => 'required|string|max:20',
            'home_phone'      => 'nullable|string|max:20',
            'po_box'          => 'nullable|string|max:255',
            'passport_photo'                  => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'national_id_photo'               => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'personal_photo'                  => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'educational_qualification_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'retirement_card_photo'           => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'front_id'                        => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'back_id'                         => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
        ]);

        $data = [
            'mobile_phone' => $validated['mobile_phone'],
            'home_phone'   => $validated['home_phone'] ?? null,
            'po_box'       => $validated['po_box'] ?? null,
        ];

        $fileFields = [
            'passport_photo'                  => 'passport_photo_path',
            'national_id_photo'               => 'national_id_photo_path',
            'personal_photo'                  => 'personal_photo_path',
            'educational_qualification_photo' => 'educational_qualification_photo_path',
            'retirement_card_photo'           => 'retirement_card_photo_path',
            'front_id'                        => 'front_id',
            'back_id'                         => 'back_id',
        ];

        foreach ($fileFields as $field => $column) {
            if (! $request->hasFile($field)) continue;
            $existing = $application->{$column};
            if ($existing && Storage::disk('public')->exists($existing)) {
                Storage::disk('public')->delete($existing);
            }
            $data[$column] = $request->file($field)
                ->store('member_applications_documents/' . Auth::id(), 'public');
        }

        $application->update($data);

        return redirect()->route('members.application.edit')
            ->with('success', 'تم تحديث بيانات طلب العضوية بنجاح.');
    }

    public function uploadMembershipReceipt(Request $request)
    {
        $application = \App\Models\MemberApplication::where('user_id', Auth::id())->firstOrFail();

        if ((string) $application->status !== '0') {
            return redirect()->back()->with('error', 'لا يمكن رفع إيصال الدفع في هذه المرحلة.');
        }

        $request->validate([
            'payment_receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ], [
            'payment_receipt.required' => 'يرجى اختيار ملف الإيصال.',
            'payment_receipt.mimes'    => 'يجب أن يكون الملف صورة أو PDF.',
        ]);

        if ($application->payment_receipt) {
            Storage::disk('public')->delete($application->payment_receipt);
        }

        $path = $request->file('payment_receipt')->store('membership_receipts', 'public');
        $application->update([
            'payment_receipt' => $path,
            'status'          => '1', // بانتظار التفعيل — أُرسل الإيصال، ينتظر تأكيد الموظف
        ]);

        \App\Http\Controllers\PushController::sendToStaff(
            'تم رفع إيصال دفع عضوية',
            ($application->full_name ?? 'عضو') . ' رفع إيصال دفع العضوية. يرجى المراجعة.',
            '/admin/manageMembership'
        );

        return redirect()->back()->with('success', 'تم رفع إيصال الدفع بنجاح. سيتم مراجعته من قبل الموظفين.');
    }

    /**
     * طلب تجديد العضوية — يحول الحالة إلى "بانتظار الدفع" مباشرة
     */
    public function requestRenewal(Request $request)
    {
        $application = \App\Models\MemberApplication::where('user_id', Auth::id())->firstOrFail();

        if (!in_array((string) $application->status, ['3', '4'])) {
            return redirect()->route('members.panel.invoices')
                ->with('error', 'لا يمكن تجديد العضوية في وضعها الحالي.');
        }

        $application->update(['status' => '0']);

        \App\Http\Controllers\PushController::sendToStaff(
            'طلب تجديد عضوية',
            ($application->full_name ?? 'عضو') . ' طلب تجديد عضويته. يرجى المراجعة.',
            '/admin/manageMembership'
        );

        return redirect()->route('members.panel.invoices')
            ->with('success', 'تم إرسال طلب التجديد. يرجى رفع إيصال الدفع.');
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

    private function iniSizeToBytes(string $value): int
    {
        $value = trim($value);
        if ($value === '') {
            return 0;
        }

        $unit = strtolower(substr($value, -1));
        $number = (int) $value;

        return match ($unit) {
            'g' => $number * 1024 * 1024 * 1024,
            'm' => $number * 1024 * 1024,
            'k' => $number * 1024,
            default => (int) $value,
        };
    }
}
