<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessageNotification;


class ContactMessageController extends Controller
{
    public function index()
    {
        return view('contact-us');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'type' => 'required|in:complaint,suggestion,other',
            'message' => 'required|string|max:1000'
        ], [
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحاً',
            'type.required' => 'نوع الرسالة مطلوب',
            'message.required' => 'الرسالة مطلوبة'
        ]);

        try {
            // حفظ الرسالة في قاعدة البيانات
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'message' => $request->message,
            ]);

            // إرسال إيميل للإدارة (اختياري)
            // $this->sendNotificationEmail($contactMessage);

            return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
            
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.');
        }
    }

    // لوحة الإدارة - عرض جميع الرسائل
    public function admin()
    {
        $messages = ContactMessage::latest()->paginate(15);
        $unreadCount = ContactMessage::unread()->count();
        
        return view('admin.contact-messages', compact('messages', 'unreadCount'));
    }

    // عرض رسالة واحدة
    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return view('admin.contact-message-show', compact('contactMessage'));
    }

    // حذف رسالة
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages')->with('success', 'تم حذف الرسالة بنجاح');
    }

    // تحديث حالة القراءة
    public function toggleRead(ContactMessage $contactMessage)
    {
        if ($contactMessage->is_read) {
            $contactMessage->markAsUnread();
        } else {
            $contactMessage->markAsRead();
        }

        return back()->with('success', 'تم تحديث حالة الرسالة');
    }

    // فلترة الرسائل
    public function filter(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->type && $request->type !== 'all') {
            $query->byType($request->type);
        }

        if ($request->status === 'read') {
            $query->where('is_read', true);
        } elseif ($request->status === 'unread') {
            $query->unread();
        }

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $messages = $query->latest()->paginate(15);
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.contact-messages', compact('messages', 'unreadCount'));
    }

    // إحصائيات
    public function stats()
    {
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'complaints' => ContactMessage::byType('complaint')->count(),
            'suggestions' => ContactMessage::byType('suggestion')->count(),
            'others' => ContactMessage::byType('other')->count(),
            'this_month' => ContactMessage::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }

    // دالة إرسال إيميل للإدارة (اختيارية)
    private function sendNotificationEmail($contactMessage)
    {
        // Mail::to('admin@yoursite.com')->send(new ContactMessageNotification($contactMessage));
    }
}
