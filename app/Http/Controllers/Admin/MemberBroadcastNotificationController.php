<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMemberNotification;
use App\Http\Controllers\Controller;
use App\Models\MemberBroadcastNotification;
use App\Models\PushSubscription;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class MemberBroadcastNotificationController extends Controller
{
    public function create(): View
    {
        // oldest first so newest appears at the bottom
        $recent  = MemberBroadcastNotification::with('creator')->oldest()->limit(20)->get();
        $members = User::where('role', 'عضو')->orderBy('name')->get(['id', 'name']);

        return view('admin.notifications.create', compact('recent', 'members'));
    }

    public function show(int $id): View
    {
        $notification = MemberBroadcastNotification::with('creator')->findOrFail($id);

        $readRecords = UserNotification::with('user')
            ->where('member_broadcast_notification_id', $id)
            ->whereNotNull('read_at')
            ->latest('read_at')
            ->get();

        $unreadRecords = UserNotification::with('user')
            ->where('member_broadcast_notification_id', $id)
            ->whereNull('read_at')
            ->get();

        return view('admin.notifications.show', compact('notification', 'readRecords', 'unreadRecords'));
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

        // ── Web Push (يصل حتى لو التطبيق مقفول) ──
        $this->sendWebPush(
            title:     $validated['title'],
            body:      $validated['body'],
            sendToAll: $sendToAll,
            userIds:   $sendToAll ? [] : ($validated['user_ids'] ?? [])
        );

        $msg = $sendToAll
            ? 'تم إرسال الإشعار لجميع الأعضاء بنجاح.'
            : 'تم إرسال الإشعار للأعضاء المحددين بنجاح.';

        return redirect()->route('admin.member-notifications.create')->with('success', $msg);
    }

    private function sendWebPush(string $title, string $body, bool $sendToAll, array $userIds = []): void
    {
        $vapidPublic  = config('app.vapid_public');
        $vapidPrivate = config('app.vapid_private');
        $vapidSubject = config('app.vapid_subject', 'mailto:admin@retirees.ae');

        if (!$vapidPublic || !$vapidPrivate) return;

        $webPush = new WebPush([
            'VAPID' => [
                'subject'    => $vapidSubject,
                'publicKey'  => $vapidPublic,
                'privateKey' => $vapidPrivate,
            ],
        ]);

        $subscriptions = $sendToAll
            ? PushSubscription::all()
            : PushSubscription::whereIn('member_id', $userIds)->get();

        if ($subscriptions->isEmpty()) return;

        $payload = json_encode([
            'title' => $title,
            'body'  => $body,
            'icon'  => '/assets/images/new-logo.png',
            'url'   => '/',
        ]);

        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create([
                    'endpoint' => $sub->endpoint,
                    'keys'     => ['p256dh' => $sub->p256dh_key, 'auth' => $sub->auth_token],
                ]),
                $payload
            );
        }

        foreach ($webPush->flush() as $report) {
            if (!$report->isSuccess()) {
                PushSubscription::where('endpoint', $report->getRequest()->getUri()->__toString())->delete();
            }
        }
    }
}
