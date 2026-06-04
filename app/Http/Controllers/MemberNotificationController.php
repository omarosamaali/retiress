<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberNotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        abort_unless($user->isMemberRole(), 403);

        $items = $user->userNotifications()
            ->visibleInBell()
            ->with('broadcast')
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn (UserNotification $n) => [
                'id' => $n->id,
                'title' => $n->broadcast?->title,
                'body' => $n->broadcast?->body,
                'created_at' => $n->created_at?->toIso8601String(),
                'read_at' => $n->read_at?->toIso8601String(),
            ]);

        return response()->json([
            'notifications' => $items,
            'unread_chat' => $user->unreadChatMessagesCount(),
            'total_badge' => $user->headerNotificationCount(),
        ]);
    }

    public function dismiss(UserNotification $userNotification): JsonResponse
    {
        $this->authorizeNotification($userNotification);

        $userNotification->update(['dismissed_at' => now()]);

        return response()->json(['ok' => true]);
    }

    public function read(UserNotification $userNotification): JsonResponse
    {
        $this->authorizeNotification($userNotification);

        $userNotification->update([
            'read_at' => $userNotification->read_at ?? now(),
        ]);

        return response()->json(['ok' => true]);
    }

    protected function authorizeNotification(UserNotification $userNotification): void
    {
        abort_unless(
            Auth::id() === $userNotification->user_id && Auth::user()->isMemberRole(),
            403
        );
    }
}
