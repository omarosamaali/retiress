<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberHeaderComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();

        if (! $user || ! $user->isMemberRole()) {
            $view->with([
                'showMemberHeaderTools' => false,
                'memberApplication' => null,
                'membershipCardPayload' => null,
                'headerNotificationCount' => 0,
                'headerNotifications' => collect(),
                'unreadChatCount' => 0,
            ]);

            return;
        }

        $application = $user->memberApplication;
        $payload = $application?->toMembershipCardPayload() ?? [
            'show_details' => false,
            'status' => [
                'key' => 'pending',
                'label' => __('app.membership_not_active'),
                'days_left' => null,
                'badge_class' => 'membership-status--pending',
            ],
            'full_name' => null,
            'photo_url' => null,
            'job_title' => null,
            'employer' => null,
            'membership_number' => null,
            'expiration_date' => null,
            'renew_url' => route('members.my-membership'),
        ];

        $headerNotifications = $user->userNotifications()
            ->visibleInBell()
            ->with('broadcast')
            ->latest()
            ->limit(10)
            ->get();

        $view->with([
            'showMemberHeaderTools' => true,
            'memberApplication' => $application,
            'membershipCardPayload' => $payload,
            'headerNotificationCount' => $user->headerNotificationCount(),
            'headerNotifications' => $headerNotifications,
            'unreadChatCount' => $user->unreadChatMessagesCount(),
        ]);
    }
}
