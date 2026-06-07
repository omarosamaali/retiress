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

        $allMyTransactions = Transaction::with('event')
            ->where('user_id', $user->id)
            ->whereNotNull('event_id')
            ->orderByDesc('subscribed_at')
            ->get();

        // فعال فقط
        $subscribedTransactions = $allMyTransactions->whereIn('status', ['active']);

        // قيد الانتظار
        $pendingTransactions = $allMyTransactions->whereIn('status', ['pending', 'waiting_for_payment', 'waiting_for_activation']);

        // مرفوض / منتهي
        $rejectedTransactions = $allMyTransactions->whereIn('status', ['rejected', 'expired', 'deactivated']);

        $subscribedEventIds = $allMyTransactions->pluck('event_id')->filter()->unique();

        $availableEvents = Event::publiclyListed($user)
            ->whereNotIn('id', $subscribedEventIds)
            ->latest()
            ->limit(20)
            ->get();

        $recentMessages = Message::where(function ($q) use ($user) {
            $q->where('from_user_id', $user->id)
                ->orWhere('to_user_id', $user->id);
        })
            ->with(['sender', 'receiver'])
            ->latest()
            ->limit(8)
            ->get();

        $panelNotifications = UserNotification::where('user_id', $user->id)
            ->visibleInBell()
            ->with('broadcast')
            ->latest()
            ->limit(10)
            ->get();

        return view('members.panel.index', compact(
            'subscribedTransactions',
            'pendingTransactions',
            'rejectedTransactions',
            'availableEvents',
            'recentMessages',
            'panelNotifications'
        ));
    }
}
