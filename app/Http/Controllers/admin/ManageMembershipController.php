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
use App\Services\MemberApplicationUpdater;

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

        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لإكمال هذه العملية.');
        }

        if ($request->filled('email') && ! $request->filled('membership_email')) {
            $request->merge(['membership_email' => $request->input('email')]);
        }

        app(MemberApplicationUpdater::class)->update($request, $memberApplication);

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
