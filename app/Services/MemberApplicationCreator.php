<?php

namespace App\Services;

use App\Models\MemberApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberApplicationCreator
{
    private const FILE_FIELDS = [
        'passport_photo' => 'passport_photo_path',
        'national_id_photo' => 'national_id_photo_path',
        'personal_photo' => 'personal_photo_path',
        'educational_qualification_photo' => 'educational_qualification_photo_path',
        'retirement_card_photo' => 'retirement_card_photo_path',
        'front_id' => 'front_id',
        'back_id' => 'back_id',
    ];

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'emirate' => 'required|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'status' => 'required|string|in:0,1,2,3,4',
            'membership_number' => 'nullable|string|max:255|unique:member_applications,membership_number',
            'expiration_date' => 'nullable|date',
            'national_id' => 'required|string|max:255|unique:member_applications,national_id',
            'educational_qualification' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'home_phone' => 'nullable|string|max:20',
            'membership_email' => 'required|email|max:255',
            'po_box' => 'nullable|string|max:255',
            'retirement_date' => 'nullable|date',
            'contract_type' => 'nullable|string|in:نظامي,مبكر',
            'early_reason' => 'nullable|string|max:500',
            'pension' => 'nullable|string|max:255',
            'passport_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'national_id_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'personal_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'educational_qualification_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'retirement_card_photo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'front_id' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'back_id' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'professional_experiences' => 'nullable|array',
            'professional_experiences.*.year' => 'nullable|string|max:255',
            'professional_experiences.*.job_title' => 'nullable|string|max:255',
            'professional_experiences.*.employer' => 'nullable|string|max:255',
            'professional_experiences.*.years_of_experience' => 'nullable|string|max:255',
            'previous_experience' => 'nullable|array',
            'previous_experience.*.year' => 'nullable|string|max:255',
            'previous_experience.*.job_title' => 'nullable|string|max:255',
            'previous_experience.*.employer' => 'nullable|string|max:255',
            'previous_experience.*.years_of_experience' => 'nullable|string|max:255',
        ];
    }

    public function create(Request $request, User $user): MemberApplication
    {
        if ($request->filled('membership_status')) {
            $request->merge(['status' => $request->input('membership_status')]);
        }

        if (! $request->filled('full_name') && $request->filled('name')) {
            $request->merge(['full_name' => $request->input('name')]);
        }

        if (! $request->filled('membership_email') && $request->filled('email')) {
            $request->merge(['membership_email' => $request->input('email')]);
        }

        $validated = $request->validate($this->rules());

        $data = collect($validated)->except(array_keys(self::FILE_FIELDS))->all();
        $data['email'] = $validated['membership_email'];
        unset($data['membership_email']);
        $data['user_id'] = $user->id;
        $data['membership_number'] = $validated['membership_number'] ?? $this->generateMembershipNumber();
        $data['professional_experiences'] = $this->cleanExperiences(
            $request->input('professional_experiences', [])
        );
        $data['previous_experience'] = $this->cleanExperiences(
            $request->input('previous_experience', [])
        );

        foreach (self::FILE_FIELDS as $requestField => $dbColumn) {
            if ($request->hasFile($requestField)) {
                $data[$dbColumn] = $request->file($requestField)
                    ->store('member_applications_documents/'.$user->id, 'public');
            }
        }

        $application = MemberApplication::create($data);

        if ((string) $application->status === '3') {
            $user->update(['role' => 'عضو']);
        }

        return $application;
    }

    private function cleanExperiences(array $rows): array
    {
        $cleaned = [];

        foreach ($rows as $row) {
            if (! empty(array_filter($row ?? []))) {
                $cleaned[] = $row;
            }
        }

        return $cleaned;
    }

    public function generateMembershipNumber(): string
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $attempt++;
            $number = 'MEM-'.date('Y').'-'.str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);

            if ($attempt >= $maxAttempts) {
                throw new \RuntimeException('تعذّر إنشاء رقم عضوية فريد.');
            }
        } while (MemberApplication::where('membership_number', $number)->exists());

        return $number;
    }
}
