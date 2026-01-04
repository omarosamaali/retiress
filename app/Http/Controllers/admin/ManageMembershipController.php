<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Don't forget this!
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage; // Don't forget this for file operations!
use Illuminate\Validation\Rule; // Needed for unique validation on update
use Illuminate\Support\Str;

class ManageMembershipController extends Controller
{
    public function index(Request $request)
    {
        $query = MemberApplication::query();

        // البحث بالاسم أو رقم الهاتف
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('full_name', 'like', "%{$search}%")
                ->orWhere('mobile_phone', 'like', "%{$search}%");
        }

        // الفرز حسب الحقول المطلوبة
        if ($request->filled('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortDirection = $request->input('sort_direction', 'desc');

            switch ($sortBy) {
                case 'date':
                    $query->orderBy('created_at', $sortDirection);
                    break;

                case 'emirate':
                    $query->orderBy('emirate', $sortDirection);
                    break;
                case 'gender':
                    $query->orderBy('gender', $sortDirection);
                    break;
                case 'nationality':
                    $query->orderBy('nationality', $sortDirection);
                    break;
                default:
                    $query->latest(); // الترتيب الافتراضي من الأحدث إلى الأقدم
                    break;
            }
        } else {
            $query->latest(); // الترتيب الافتراضي من الأحدث إلى الأقدم
        }

        $membership = $query->paginate(50);

        return view('admin.manageMembership.index', compact('membership'));
    }

    public function edit(Request $request , $id)
    {
        $member = MemberApplication::findOrFail($id);
        return view('admin.manageMembership.edit' , compact('member'));
    }

    public function update(Request $request, $manageMembership)
    {
        $memberApplication = MemberApplication::findOrFail($manageMembership);
        $userId = $memberApplication->user_id;

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لإكمال هذه العملية.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'emirate' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'expiration_date'=> 'nullable|date',
            'national_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('member_applications')->ignore($memberApplication->id),
            ],
            'educational_qualification' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'home_phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'po_box' => 'nullable|string|max:255',
            'retirement_date' => 'nullable|date',
            'contract_type' => 'nullable|string|in:نظامي,مبكر',
            'early_reason' => 'nullable|string|max:500',

            // File uploads are nullable
            'passport_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'front_id' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'back_id' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'national_id_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'personal_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'educational_qualification_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'retirement_card_photo' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'professional_experiences.*.year' => 'nullable|string|max:255',
            'professional_experiences.*.job_title' => 'nullable|string|max:255',
            'professional_experiences.*.employer' => 'nullable|string|max:255',
            'professional_experiences.*.years_of_experience' => 'nullable|integer',
            'previous_experience.*.year' => 'nullable|string|max:255',
            'previous_experience.*.job_title' => 'nullable|string|max:255',
            'previous_experience.*.employer' => 'nullable|string|max:255',
            'previous_experience.*.years_of_experience' => 'nullable|integer',
        ]);

        $data = $request->except([
            'passport_photo',
            'national_id_photo',
            'front_id',
            'back_id',
            'personal_photo',
            'educational_qualification_photo',
            'retirement_card_photo',
            // استبعد هذه الحقول من هنا أيضاً، ولكن **لا** تقم بتعيينها لـ [] بعد ذلك
            'professional_experiences',
            'previous_experience',
            '_token',
            '_method',
        ]);

        // Handle file uploads (delete old file if new one is uploaded)
        $fileFields = [
            // تأكد من أن مفاتيح الـ array هنا هي أسماء الحقول في الـ Request
            // وقيم الـ array هي أسماء الأعمدة في قاعدة البيانات/الـ Model
            'passport_photo' => 'passport_photo', // يجب أن تكون نفس اسم العمود في DB
            'front_id' => 'front_id',
            'back_id' => 'back_id',
            'national_id_photo' => 'national_id_photo', // يجب أن تكون نفس اسم العمود في DB
            'personal_photo' => 'personal_photo', // يجب أن تكون نفس اسم العمود في DB
            'educational_qualification_photo' => 'educational_qualification_photo', // يجب أن تكون نفس اسم العمود في DB
            'retirement_card_photo' => 'retirement_card_photo', // يجب أن تكون نفس اسم العمود في DB
        ];

        foreach ($fileFields as $requestField => $dbField) {
            if ($request->hasFile($requestField)) {
                // Delete old file if it exists
                if ($memberApplication->$dbField && Storage::disk('public')->exists($memberApplication->$dbField)) {
                    Storage::disk('public')->delete($memberApplication->$dbField);
                }
                // Store new file
                $path = $request->file($requestField)->store('member_applications_documents/' . $userId, 'public');
                $data[$dbField] = $path; // Update the path in $data
            }
            // إذا لم يتم رفع ملف جديد، لا تفعل شيئاً هنا.
            // القيمة القديمة ستظل محفوظة في $memberApplication ولن تتغير بواسطة $data.
        }

        if ($request->has('professional_experiences')) { // لاحظ أن اسم الحقل في الـ request هنا يجب أن يكون 'professional_experiences'
            $cleanedExperiences = [];
            foreach ($request->input('professional_experiences') as $experienceData) {
                if (!empty(array_filter($experienceData))) { // Only include non-empty experience rows
                    $cleanedExperiences[] = $experienceData;
                }
            }
            $data['professional_experiences'] = $cleanedExperiences;
        }

        if ($request->has('previous_experience')) {
            $cleanedPreviousExperiences = [];
            foreach ($request->input('previous_experience') as $experienceData) {
                if (!empty(array_filter($experienceData))) { // Only include non-empty experience rows
                    $cleanedPreviousExperiences[] = $experienceData;
                }
            }
            $data['previous_experience'] = $cleanedPreviousExperiences;
        }

        $memberApplication->update($data);
        if($memberApplication->status == 3) {
            User::where('id', $memberApplication->user_id)->update([
                'role' => 'عضو'
            ]);

            // Mail::raw('رائع تم تفعيل طلب العضوية بنجاح انت الان تستمتع بخدماتنا يمكنك الاشتراك في خدماتنا', function ($message) use ($memberApplication) {
            //     $message->to([$memberApplication->email, 'contact@uaeretired.ae'])->subject('تم تفعيل طلب العضوية بنجاح');
            // });
        }
        
        // Redirect with success message
        return redirect()->route('admin.manageMembership.index')->with('success', 'تم تحديث طلب العضوية بنجاح!');
    }

    /**
     * Generate a unique membership number.
     * This method needs to be present in your controller.
     * You can modify its logic as needed.
     */
    protected function generateMembershipNumber()
    {
        // Example: Generate a random string or increment a counter
        // For a more robust solution, consider a sequence or a custom generator
        do {
            $number = 'MEM-' . strtoupper(Str::random(8)); // Requires use Illuminate\Support\Str;
        } while (MemberApplication::where('membership_number', $number)->exists());

        return $number;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ابحث عن العضو المراد حذفه
        $member = MemberApplication::findOrFail($id);

        // احذف الصورة الشخصية إذا كانت موجودة
        if ($member->personal_photo_path && Storage::disk('public')->exists($member->personal_photo_path)) {
            Storage::disk('public')->delete($member->personal_photo_path);
        }

        // يمكنك إضافة المزيد من المنطق هنا لحذف الملفات الأخرى

        // احذف سجل العضوية من قاعدة البيانات
        $member->delete();

        // أعد التوجيه برسالة نجاح
        return redirect()->route('admin.manageMembership.index')->with('success', 'تم حذف طلب العضوية بنجاح.');
    }
}
