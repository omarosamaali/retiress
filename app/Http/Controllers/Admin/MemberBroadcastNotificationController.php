<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMemberNotification;
use App\Http\Controllers\Controller;
use App\Models\MemberBroadcastNotification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MemberBroadcastNotificationController extends Controller
{
    public function create(): View
    {
        $recent  = MemberBroadcastNotification::with('creator')->latest()->limit(10)->get();
        $members = User::where('role', 'عضو')->orderBy('name')->get(['id', 'name']);

        return view('admin.notifications.create', compact('recent', 'members'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'required|string|max:5000',
            'audience'   => 'required|in:all,specific',
            'user_ids'   => 'required_if:audience,specific|nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $sendToAll = $validated['audience'] === 'all';

        DB::transaction(function () use ($validated, $sendToAll) {
            $broadcast = MemberBroadcastNotification::create([
                'title'      => $validated['title'],
                'body'       => $validated['body'],
                'created_by' => Auth::id(),
                'sent_at'    => now(),
            ]);

            $userIds = $sendToAll
                ? User::where('role', 'عضو')->pluck('id')
                : collect($validated['user_ids'] ?? []);

            foreach ($userIds as $userId) {
                $userNotif = UserNotification::create([
                    'member_broadcast_notification_id' => $broadcast->id,
                    'user_id' => $userId,
                ]);

                try {
                    broadcast(new NewMemberNotification(
                        userId:         (int) $userId,
                        notificationId: $userNotif->id,
                        title:          $broadcast->title,
                        body:           $broadcast->body,
                    ));
                } catch (\Throwable) {
                    // لو Pusher مش متاح، الـ polling يكمّل
                }
            }
        });

        $msg = $sendToAll
            ? 'تم إرسال الإشعار لجميع الأعضاء بنجاح.'
            : 'تم إرسال الإشعار للأعضاء المحددين بنجاح.';

        return redirect()->route('admin.member-notifications.create')->with('success', $msg);
    }
}
