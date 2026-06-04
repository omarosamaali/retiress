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

        $subscribedTransactions = Transaction::with('event')
            ->where('user_id', $user->id)
            ->whereNotNull('event_id')
            ->whereIn('status', Transaction::OPEN_STATUSES)
            ->orderByDesc('subscribed_at')
            ->get();

        $subscribedEventIds = $subscribedTransactions->pluck('event_id')->filter()->unique();

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
            'availableEvents',
            'recentMessages',
            'panelNotifications'
        ));
    }
}
