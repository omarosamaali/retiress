<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function activate(Transaction $transaction)
    { 
        if ($transaction->status === 'deactivated') {
            $transaction->status = 'active';
            $transaction->save();
            return redirect()->back()->with('success', 'تم تفعيل الخدمة بنجاح.');
        }
        return redirect()->back()->with('error', 'لا يمكن تفعيل هذه الخدمة إلا إذا كانت "ملغاة التفعيل".');
    }

    public function uploadReceipt(Request $request, Transaction $transaction)
    {
        if ($transaction->status !== 'waiting_for_payment' || $transaction->user_id !== Auth::id()) {
            return redirect()->back()->with('error', __('app.cannot_upload_receipt'));
        }

        $request->validate([
            'receipt_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // قواعد التحقق للصورة
        ], [
            'receipt_image.required' => __('validation.receipt_image_required'),
            'receipt_image.image' => __('validation.receipt_image_image'),
            'receipt_image.mimes' => __('validation.receipt_image_mimes'),
            'receipt_image.max' => __('validation.receipt_image_max'),
        ]);
        if ($request->hasFile('receipt_image')) {
            if ($transaction->receipt_image) {
                Storage::disk('public')->delete($transaction->receipt_image);
            }
            $path = $request->file('receipt_image')->store('receipts', 'public');
            $transaction->receipt_image = $path;
            $transaction->status = 'waiting_for_activation';
            $transaction->save();
            return redirect()->back()->with('success', __('app.receipt_uploaded_success'));
        }
        return redirect()->back()->with('error', __('app.failed_to_upload_receipt'));
    }

    public function subscribe(Request $request, Service $service)
    {
        if ($service->membership_required && !Auth::user()->hasActiveMembership()) {
            return redirect()->back()->with('error', __('app.membership_required_to_subscribe'));
        }
        $existingTransaction = Transaction::where('user_id', Auth::id())
            ->where('service_id', $service->id)
            ->whereIn('status', ['pending', 'waiting_for_payment', 'waiting_for_activation', 'active'])
            ->exists();
        if ($existingTransaction) {
            return redirect()->route('members.record')->with('error', __('app.already_subscribed'));
        }
        $initialStatus = 'pending';
        Transaction::create([
            'user_id' => Auth::id(),
            'event_id' => null,
            'service_id' => $service->id,
            'status' => $initialStatus,
            'type' => $request->type,
        ]);
        Mail::raw('رائع تم الإشتراك في ' . $service->name_ar . ' بنجاح', function ($message) use ($service) {
            $message->to([Auth::user()->email, 'contact@uaeretired.ae'])->subject('تم الإشتراك في خدمة  ');
        });
        return redirect()->route('members.record')->with('success', __('app.subscription_success'));
    }

    /**
     * Handle approval of a transaction by an admin.
     * This is the FIRST approval step.
     */
    public function subscribeToEvent(Request $request, Event $event)
    {
        $existingTransaction = Transaction::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->whereIn('status', ['pending', 'waiting_for_payment', 'waiting_for_activation', 'active'])
            ->exists();
        if ($existingTransaction) {
            return redirect()->route('members.record')->with('error', __('app.already_subscribed_to_event'));
        }
        $initialStatus = 'pending';
        Transaction::create([
            'user_id' => Auth::id(),
            'service_id' => null, // أضف هذا السطر
            'event_id' => $event->id,
            'status' => $initialStatus,
            'type' => $request->type,
        ]);
        Mail::raw('رائع تم الاشتراك في ' . $event->title_ar . ' بنجاح', function ($message) use ($event) {
            $message->to([Auth::user()->email, 'contact@uaeretired.ae'])->subject('تم الإشتراك في فعالية ');
        });
        return redirect()->route('members.record')->with('success', __('app.event_subscription_success'));
    }

    public function record()
    {
        $transactions = Transaction::with(['service', 'event', 'user'])
            ->where('user_id', Auth::id())
            ->get();

        return view('members.record', compact('transactions'));
    }

    // تعديل دالة approve
    public function approve(Transaction $transaction)
    {
        if ($transaction->status === 'pending') {
            if ($transaction->service) {
                if ($transaction->service->price > 0 && $transaction->service->is_payed) {
                    $transaction->status = 'waiting_for_payment';
                    $message = 'تمت الموافقة على طلب الخدمة المدفوعة بنجاح. بانتظار إتمام المستخدم عملية الدفع.';
                } else {
                    $transaction->status = 'active';
                    $message = 'تمت الموافقة وتفعيل الخدمة بنجاح.';
                    Mail::raw('رائع تم تفعيل ' . $transaction->service->name_ar . ' بنجاح يمكنك استخدام الخدمة', function ($message) use ($transaction) {
                        $message->to([$transaction->user->email, 'contact@uaeretired.ae'])->subject('تم تفعيل فعالية ');
                    });
                }
            } elseif ($transaction->event) {
                if ($transaction->event->price > 0) {
                    $transaction->status = 'waiting_for_payment';
                    $message = 'تمت الموافقة على طلب الفعالية المدفوعة بنجاح. بانتظار إتمام المستخدم عملية الدفع.';
                } else {
                    $transaction->status = 'active';
                    $message = 'تمت الموافقة وتفعيل الفعالية بنجاح.';
                    Mail::raw('رائع تم تفعيل ' . $transaction->event->title_ar . ' بنجاح يمكنك استخدام الخدمة', function ($message) use ($transaction) {
                        $message->to([$transaction->user->email, 'contact@uaeretired.ae'])->subject('تم تفعيل فعالية ');
                    });
                }
            } else {
                return redirect()->back()->with('error', 'لا يمكن تحديد نوع المعاملة.');
            }
            $transaction->save();
            return redirect()->back()->with('success', $message);
        }
        return redirect()->back()->with('error', 'لا يمكن الموافقة على هذه المعاملة في حالتها الحالية.');
    }

    public function confirmPayment(Transaction $transaction)
    {
        if ($transaction->status === 'waiting_for_payment' || $transaction->status === 'waiting_for_activation') {
            $transaction->status = 'active'; // التفعيل النهائي بعد تأكيد الأدمن للدفع
            $transaction->save();
            return redirect()->back()->with('success', 'تم تأكيد الدفع وتفعيل الخدمة بنجاح.');
        }
        return redirect()->back()->with('error', 'لا يمكن تأكيد الدفع لهذه المعاملة إلا إذا كانت "بانتظار الدفع" أو "بانتظار التفعيل".');
    }

    public function reject(Transaction $transaction)
    {
        if ($transaction->status !== 'rejected' && $transaction->status !== 'expired' && $transaction->status !== 'deactivated') {
            $transaction->status = 'rejected';
            $transaction->save();
            return redirect()->back()->with('success', 'تم رفض الطلب بنجاح.');
        }

        return redirect()->back()->with('error', 'لا يمكن رفض هذه المعاملة في حالتها الحالية.');
    }

    /**
     * Handle deactivation of an active transaction by an admin.
     */
    public function deactivate(Transaction $transaction)
    {
        // Add authorization check if needed
        if ($transaction->status === 'active') {
            $transaction->status = 'deactivated';
            $transaction->save();
            return redirect()->back()->with('success', 'تم إلغاء تفعيل الخدمة بنجاح.');
        }

        return redirect()->back()->with('error', 'لا يمكن إلغاء تفعيل هذه الخدمة إلا إذا كانت "فعالة".');
    }
}
