<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * عرض بيانات التواصل
     */
    public function index()
    {
        $settings = Settings::getActiveContactInfo();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * عرض صفحة إنشاء/تعديل بيانات التواصل
     */
    public function create()
    {
        $contactInfo = Settings::getActiveContactInfo();
        return view('admin.settings.form', compact('contactInfo'));
    }

    /**
     * حفظ/تحديث بيانات التواصل
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string|max:500',
            'office_number' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'work_days' => 'nullable|string',
            'holidays' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',
            'tiktok_url' => 'nullable|url|max:500',
            'ios_url' => 'nullable|url|max:500',
            'android_url' => 'nullable|url|max:500'
        ], [
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
            'facebook_url.url' => 'يجب إدخال رابط فيسبوك صحيح',
            'instagram_url.url' => 'يجب إدخال رابط انستجرام صحيح',
            'youtube_url.url' => 'يجب إدخال رابط يوتيوب صحيح',
            'tiktok_url.url' => 'يجب إدخال رابط تيك توك صحيح',
            'ios_url.url' => 'يجب إدخال رابط iOS صحيح',
            'android_url.url' => 'يجب إدخال رابط Android صحيح'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في البيانات المدخلة',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // تعطيل جميع السجلات السابقة
            Settings::where('is_active', 1)->update(['is_active' => 0]);

            // إنشاء سجل جديد
            $contactInfo = Settings::create([
                'address' => $request->address,
                'office_number' => $request->office_number,
                'whatsapp' => $request->whatsapp,
                'email' => $request->email,
                'work_days' => $request->work_days,
                'holidays' => $request->holidays,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
                'youtube_url' => $request->youtube_url,
                'tiktok_url' => $request->tiktok_url,
                'ios_url' => $request->ios_url,
                'android_url' => $request->android_url,
                'is_active' => 1
            ]);

            return redirect()->route('admin.settings.index')->with('success', 'تم حفظ بيانات التواصل بنجاح');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * الحصول على بيانات التواصل النشطة
     */
    public function getActiveContactInfo()
    {
        try {
            $contactInfo = Settings::getActiveContactInfo();

            if (!$contactInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا توجد بيانات تواصل نشطة'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $contactInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب البيانات: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * تحديث حالة التفعيل
     */
    public function toggleStatus($id)
    {
        try {
            $contactInfo = Settings::findOrFail($id);

            if ($contactInfo->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يمكن إلغاء تفعيل البيانات النشطة'
                ], 400);
            }

            // تعطيل جميع السجلات الأخرى
            Settings::where('is_active', 1)->update(['is_active' => 0]);

            // تفعيل السجل المحدد
            $contactInfo->update(['is_active' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة التفعيل بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الحالة: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * حذف بيانات تواصل
     */
    public function destroy($id)
    {
        try {
            $contactInfo = Settings::findOrFail($id);

            if ($contactInfo->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يمكن حذف البيانات النشطة'
                ], 400);
            }

            $contactInfo->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف البيانات بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف البيانات: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * عرض بيانات التواصل في الموقع العام
     */
    public function showPublic()
    {
        $contactInfo = Settings::getActiveContactInfo();
        return view('/', compact('contactInfo'));
    }
}