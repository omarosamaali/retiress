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

        // إعلانات فعّالة بدون خدمات
        $activeEvents = Event::publiclyListed($user)
            ->whereNotIn('type', ['خدمات', 'مميزات'])
            ->latest()
            ->get();

        // إعلانات منتهية بدون خدمات — مع رابط التفاصيل
        $expiredEvents = Event::published()
            ->visibleToAudience($user)
            ->whereNotIn('type', ['خدمات', 'مميزات'])
            ->where('ends_at', '<', now())
            ->latest()
            ->get();

        return view('members.events.all-events', compact('activeEvents', 'expiredEvents'));
    }

    public function services(): View
    {
        $user = Auth::user();

        // خدمات فعّالة
        $activeServices = Event::publiclyListed($user)
            ->whereIn('type', ['خدمات', 'مميزات'])
            ->latest()
            ->get();

        // خدمات منتهية
        $expiredServices = Event::published()
            ->visibleToAudience($user)
            ->whereIn('type', ['خدمات', 'مميزات'])
            ->where('ends_at', '<', now())
            ->latest()
            ->get();

        return view('members.events.services-events', compact('activeServices', 'expiredServices'));
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
        $canSubscribe = $user && $subscribeBlockReason === null && ! $events->userHasOpenSubscription($user) && ! $events->isExpired();

        return view('members.events.show', compact(
            'events',
            'userSubscription',
            'subscribeBlockReason',
            'canSubscribe'
        ));
    }
}
