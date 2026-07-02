<?php

namespace App\Services;

use App\Models\MemberApplication;
use App\Models\MemberBroadcastNotification;
use App\Models\UserNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberApplicationUpdater
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

    public function rules(MemberApplication $application): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,ذكر,انثي,أنثى,انثى',
            'emirate' => 'required|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'status' => 'required|string|in:0,1,2,3,4',
            'membership_number' => 'nullable|string|max:255',
            'expiration_date' => 'nullable|date',
            'national_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('member_applications')->ignore($application->id),
            ],
            'educational_qualification' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'home_phone' => 'nullable|string|max:20',
            'membership_email' => 'required|email|max:255',
            'po_box' => 'nullable|string|max:255',
            'retirement_date' => 'nullable|date',
            'contract_type' => 'nullable|string|max:255',
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

    public function update(Request $request, MemberApplication $application): void
    {
        if ($request->filled('membership_status')) {
            $request->merge(['status' => $request->input('membership_status')]);
        }

        $validated = $request->validate($this->rules($application));

        $data = collect($validated)->except(array_keys(self::FILE_FIELDS))->all();
        $data['email'] = $validated['membership_email'];
        unset($data['membership_email']);

        // marital_status column is NOT NULL — store empty string instead of null
        if (array_key_exists('marital_status', $data) && $data['marital_status'] === null) {
            $data['marital_status'] = '';
        }

        if ($request->has('professional_experiences')) {
            $data['professional_experiences'] = $this->cleanExperiences(
                $request->input('professional_experiences', [])
            );
        }

        if ($request->has('previous_experience')) {
            $data['previous_experience'] = $this->cleanExperiences(
                $request->input('previous_experience', [])
            );
        }

        $userId = $application->user_id;

        foreach (self::FILE_FIELDS as $requestField => $dbColumn) {
            if (! $request->hasFile($requestField)) {
                continue;
            }

            $existing = $application->{$dbColumn};
            if ($existing && Storage::disk('public')->exists($existing)) {
                Storage::disk('public')->delete($existing);
            }

            $data[$dbColumn] = $request->file($requestField)
                ->store('member_applications_documents/'.$userId, 'public');
        }

        $oldStatus = (string) $application->status;
        $newStatus = isset($data['status']) ? (string) $data['status'] : $oldStatus;

        $application->update($data);
        $application->refresh();

        $this->syncUserRoleForActiveMembership($application);

        // إشعار المستخدم عند تغيير الحالة
        if ($oldStatus !== $newStatus && $application->user_id) {
            if ($newStatus === '0') {
                \App\Http\Controllers\PushController::sendToUser(
                    $application->user_id,
                    'طلب عضويتك — بانتظار الدفع',
                    'تمت مراجعة طلبك. يرجى إتمام عملية الدفع ورفع إيصال الدفع.',
                    '/members/my-membership'
                );
            } elseif ($newStatus === '3') {
                \App\Http\Controllers\PushController::sendToUser(
                    $application->user_id,
                    'تم تفعيل عضويتك ✓',
                    'مبروك! تم تفعيل عضويتك بنجاح.',
                    '/members/my-membership'
                );
            }
        }
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

    private function syncUserRoleForActiveMembership(MemberApplication $application): void
    {
        if ((string) $application->status !== '3' || ! $application->user_id) {
            return;
        }

        User::where('id', $application->user_id)->update(['role' => 'عضو']);
    }
}
