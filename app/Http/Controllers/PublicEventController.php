<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PublicEventController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // إعلانات فعّالة (غير منتهية)
        $activeEvents = Event::publiclyListed($user)->latest()->get();

        // إعلانات منتهية — مرئية للزوار لكن بدون رابط تفاصيل
        $expiredEvents = Event::published()
            ->visibleToAudience($user)
            ->where('ends_at', '<', now())
            ->latest()
            ->get();

        return view('members.events.all-events', compact('activeEvents', 'expiredEvents'));
    }

    public function show(Request $request, int $id): View
    {
        $events = Event::published()->findOrFail($id);

        if (! $events->isVisibleTo(Auth::user())) {
            abort(403, __('app.announcement_members_only'));
        }

        $user = Auth::user();
        $userSubscription = $events->latestSubscriptionFor($user);
        $subscribeBlockReason = $user?->getSubscribeToEventBlockReason($events);
        $canSubscribe = $user && $subscribeBlockReason === null && ! $events->userHasOpenSubscription($user);

        return view('members.events.show', compact(
            'events',
            'userSubscription',
            'subscribeBlockReason',
            'canSubscribe'
        ));
    }
}
