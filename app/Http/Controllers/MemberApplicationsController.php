<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

        // Validate the input data, including the new pension field
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
            'pension' => 'nullable|string|max:255', // Added validation for pension
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

        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Prepare data for creation
        $data = $request->except([
            'passport_photo',
            'national_id_photo',
            'personal_photo',
            'educational_qualification_photo',
            'retirement_card_photo',
            'professional_experience',
            'previous_experience',
        ]);

        // Handle file uploads
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

        // Add user_id, membership_number, and pension
        $data['user_id'] = $user_id;
        $data['membership_number'] = $this->generateMembershipNumber();
        $data['pension'] = $request->input('pension'); // Include pension in the data

        // Handle professional experiences
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

        // Handle previous experiences
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

        // Create the membership application
        $application = MemberApplication::create($data);

        // Return response
        return redirect()->back()->with('success', 'تم تقديم طلب العضوية بنجاح! رقم العضوية هو: ' . $application->membership_number);
    }

    /**
     * معالجة طلب تجديد العضوية.
     */
    public function renew(Request $request)
    {
        try {
            // تسجيل البيانات المستلمة للتشخيص
            \Log::info('Renewal request received', $request->all());

            if (!Auth::check()) {
                return response()->json(['error' => 'يجب تسجيل الدخول لتجديد عضويتك.'], 401);
            }

            // Validate renewal form data
            $validated = $request->validate([
                'membership_id_kw' => 'required|string|max:255',
                'national_id_kw' => 'required|string|max:255',
                'email_kw' => 'required|email|max:255',
                'pension' => 'nullable|string|max:255',
            ]);

            \Log::info('Validation passed', $validated);

            // Find the existing application
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

            // Create a new application for renewal
            $newApplicationData = $application->toArray();

            // إزالة الحقول التي لا نريد نسخها
            unset(
                $newApplicationData['id'],
                $newApplicationData['created_at'],
                $newApplicationData['updated_at']
            );

            // Generate new membership number
            $newMembershipNumber = $this->generateMembershipNumber();
            \Log::info('Generated membership number', ['number' => $newMembershipNumber]);

            $newApplicationData['membership_number'] = $newMembershipNumber;
            $newApplicationData['pension'] = $validated['pension'] ?? $application->pension;
            $newApplicationData['user_id'] = Auth::id();

            // إزالة أي حقول nullable قد تسبب مشاكل
            $newApplicationData = array_filter($newApplicationData, function ($value) {
                return $value !== null;
            });

            \Log::info('Creating new application', $newApplicationData);

            $renewedApplication = MemberApplication::create($newApplicationData);

            \Log::info('Application created successfully', ['id' => $renewedApplication->id]);

            return response()->json([
                'message' => 'تم تأكيد تجديد عضويتك بنجاح! رقم العضوية الجديد هو: ' . $renewedApplication->membership_number,
                'membership_number' => $renewedApplication->membership_number
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json([
                'error' => 'بيانات غير صحيحة',
                'details' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error in renewal', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return response()->json([
                'error' => 'حدث خطأ في قاعدة البيانات. الرجاء التحقق من البيانات والمحاولة مرة أخرى.'
            ], 500);
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
