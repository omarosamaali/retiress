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
    private function generateMembershipNumber()
    {
        do {
            $membershipNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (MemberApplication::where('membership_number', $membershipNumber)->exists());
        return $membershipNumber;
    }

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
        if (!Auth::check()) {
            return response()->json(['error' => 'يجب تسجيل الدخول لتجديد عضويتك.'], 401);
        }

        // Validate renewal form data
        $validated = $request->validate([
            'membership_id_kw' => 'required|string|max:255',
            'national_id_kw' => 'required|string|max:255',
            'email_kw' => 'required|email|max:255',
            'pension' => 'nullable|string|max:255', // Added validation for pension
        ]);

        // Find the existing application
        $application = MemberApplication::where('membership_number', $request->input('membership_id_kw'))
            ->where('national_id', $request->input('national_id_kw'))
            ->where('email', $request->input('email_kw'))
            ->where('user_id', Auth::id())
            ->first();

        if (!$application) {
            return response()->json(['error' => 'بيانات العضوية المدخلة غير صحيحة أو لا تتطابق مع حسابك.'], 422);
        }

        // Create a new application for renewal
        $newApplicationData = $application->toArray();
        unset($newApplicationData['id']);
        $newApplicationData['membership_number'] = $this->generateMembershipNumber();
        $newApplicationData['created_at'] = now();
        $newApplicationData['updated_at'] = now();
        $newApplicationData['pension'] = $request->input('pension'); // Include pension in the renewal data

        // Optionally add renewal-specific fields
        // $newApplicationData['status'] = 'renewed';
        // $newApplicationData['expires_at'] = now()->addYear();

        $renewedApplication = MemberApplication::create($newApplicationData);

        return response()->json([
            'message' => 'تم تأكيد تجديد عضويتك بنجاح! رقم العضوية الجديد هو: ' . $renewedApplication->membership_number
        ], 200);
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
