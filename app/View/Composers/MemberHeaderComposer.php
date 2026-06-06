<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberHeaderComposer
{
    public function compose(View $view): void
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Safe defaults — always set regardless of what happens below
        $defaults = [
            'headerNotificationCount' => 0,
            'headerNotifications'     => collect(),
            'unreadChatCount'         => 0,
        ];

        if (! $user || ! $user->isMemberRole()) {
            $view->with($defaults);
            return;
        }

        try {
            $headerNotifications = $user->userNotifications()
                ->visibleInBell()
                ->with('broadcast')
                ->latest()
                ->limit(10)
                ->get();

            $view->with([
                'headerNotificationCount' => $user->headerNotificationCount(),
                'headerNotifications'     => $headerNotifications,
                'unreadChatCount'         => $user->unreadChatMessagesCount(),
            ]);
        } catch (\Throwable $e) {
            $view->with($defaults);
        }
    }
}
