<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use App\Models\Transaction;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberPanelController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();

        abort_unless($user->isMemberRole(), 403);

        // ── كل المعاملات الخاصة بالمستخدم ──
        $allMyTransactions = Transaction::with('event')
            ->where('user_id', $user->id)
            ->whereNotNull('event_id')
            ->orderByDesc('subscribed_at')
            ->get();

        $subscribedTransactions = $allMyTransactions->whereIn('status', ['active']);
        $pendingTransactions    = $allMyTransactions->whereIn('status', ['pending', 'waiting_for_payment', 'waiting_for_activation']);
        $rejectedTransactions   = $allMyTransactions->whereIn('status', ['rejected']);
        $expiredTransactions    = $allMyTransactions->whereIn('status', ['expired', 'deactivated']);
        $invoiceTransactions    = $allMyTransactions->filter(
            fn($t) => $t->receipt_image || ($t->event && $t->event->price > 0)
        )->values();

        $subscribedEventIds = $allMyTransactions->pluck('event_id')->filter()->unique();

        // ── إعلانات متاحة للاشتراك (لم تنتهِ بعد) ──
        $availableEvents = Event::published()
            ->visibleToAudience($user)
            ->where(function ($q) {
                $q->where('ends_at', '>=', now())
                  ->orWhere(function ($s) {
                      $s->whereNull('ends_at')->where('starts_at', '>=', now());
                  });
            })
            ->whereNotIn('id', $subscribedEventIds)
            ->latest()
            ->limit(20)
            ->get();

        // ── إعلانات انتهت ولم يشترك بها ──
        $missedEvents = Event::published()
            ->visibleToAudience($user)
            ->where('ends_at', '<', now())
            ->whereNotIn('id', $subscribedEventIds)
            ->latest()
            ->limit(20)
            ->get();

        // ── الرسائل ──
        $recentMessages = Message::where(function ($q) use ($user) {
            $q->where('from_user_id', $user->id)
                ->orWhere('to_user_id', $user->id);
        })
            ->with(['sender', 'receiver'])
            ->latest()
            ->limit(8)
            ->get();

        // ── الإشعارات — استثناء المُتجاهَلة ──
        $allNotifications    = UserNotification::where('user_id', $user->id)
            ->whereNull('dismissed_at')
            ->with('broadcast')->latest()->get();
        $unreadNotifications = $allNotifications->whereNull('read_at');
        $readNotifications   = $allNotifications->whereNotNull('read_at');
        $panelNotifications  = $allNotifications->take(10);

        // ── إحصائيات للكروت ──
        $stats = [
            'subscribed'   => $subscribedTransactions->count(),
            'pending'      => $pendingTransactions->count(),
            'available'    => $availableEvents->count(),
            'rejected'     => $rejectedTransactions->count(),
            'expired_tx'   => $expiredTransactions->count(),
            'missed'       => $missedEvents->count(),
            'notif_read'   => $readNotifications->count(),
            'notif_unread' => $unreadNotifications->count(),
            'notif_total'  => $allNotifications->count(),
            'invoices'     => $invoiceTransactions->count(),
        ];

        return view('members.panel.index', compact(
            'subscribedTransactions',
            'pendingTransactions',
            'rejectedTransactions',
            'expiredTransactions',
            'invoiceTransactions',
            'availableEvents',
            'missedEvents',
            'recentMessages',
            'panelNotifications',
            'unreadNotifications',
            'readNotifications',
            'stats'
        ));
    }

    public function invoices(): View
    {
        $user = Auth::user();
        abort_unless($user->isMemberRole() || $user->memberApplication, 403);

        // العضوية — تحتاج دفع إذا status=0، أو يمكن تجديدها إذا status=3/4
        $membershipApp = $user->memberApplication;

        // معاملات بانتظار الدفع (إعلانات أو خدمات)
        $pendingPaymentTransactions = Transaction::with(['event', 'service'])
            ->where('user_id', $user->id)
            ->where('status', 'waiting_for_payment')
            ->orderByDesc('subscribed_at')
            ->get();

        // كل المعاملات (للتاريخ)
        $allTransactions = Transaction::with(['event', 'service'])
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['waiting_for_payment'])
            ->orderByDesc('subscribed_at')
            ->get();

        return view('members.panel.invoices', compact(
            'membershipApp',
            'pendingPaymentTransactions',
            'allTransactions'
        ));
    }
}
