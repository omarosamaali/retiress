<?php

namespace App\Http\Controllers;

use App\Models\PushSubscription;
use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint'   => 'required|string',
            'keys.p256dh' => 'required|string',
            'keys.auth'   => 'required|string',
        ]);

        PushSubscription::updateOrCreate(
            ['endpoint' => $request->endpoint],
            [
                'member_id'  => auth()->id() ?? null,
                'p256dh_key' => $request->input('keys.p256dh'),
                'auth_token' => $request->input('keys.auth'),
            ]
        );

        return response()->json(['status' => 'subscribed']);
    }

    public function unsubscribe(Request $request)
    {
        PushSubscription::where('endpoint', $request->endpoint)->delete();
        return response()->json(['status' => 'unsubscribed']);
    }

    public function send(Request $request)
    {
        // نقطة إدارية لإرسال إشعار لكل المشتركين
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string',
            'url'   => 'nullable|string',
        ]);

        $auth = [
            'VAPID' => [
                'subject'    => config('app.vapid_subject', 'mailto:admin@retirees.ae'),
                'publicKey'  => config('app.vapid_public'),
                'privateKey' => config('app.vapid_private'),
            ],
        ];

        $webPush = new WebPush($auth);
        $payload = json_encode([
            'title' => $request->title,
            'body'  => $request->body,
            'url'   => $request->url ?? '/',
            'icon'  => '/assets/images/new-logo.png',
        ]);

        $subscriptions = PushSubscription::all();
        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create([
                    'endpoint'        => $sub->endpoint,
                    'keys' => [
                        'p256dh' => $sub->p256dh_key,
                        'auth'   => $sub->auth_token,
                    ],
                ]),
                $payload
            );
        }

        $results = [];
        foreach ($webPush->flush() as $report) {
            $results[] = [
                'endpoint' => $report->getRequest()->getUri()->__toString(),
                'success'  => $report->isSuccess(),
            ];
            if (!$report->isSuccess()) {
                // إزالة subscriptions منتهية الصلاحية
                PushSubscription::where('endpoint', $report->getRequest()->getUri()->__toString())->delete();
            }
        }

        return response()->json(['sent' => count($results), 'results' => $results]);
    }

    public function vapidPublicKey()
    {
        return response()->json(['key' => config('app.vapid_public')]);
    }

    /**
     * إرسال push notification لجميع الموظفين (مدير، مشرف، موظف استقبال، مدخل بيانات)
     */
    public static function sendToStaff(string $title, string $body, string $url = '/admin/dashboard'): void
    {
        try {
            $staffRoles = ['مدير', 'مشرف', 'موظف استقبال', 'مدخل بيانات'];
            $staffIds = \App\Models\User::whereIn('role', $staffRoles)->pluck('id');
            $subscriptions = PushSubscription::whereIn('member_id', $staffIds)->get();

            if ($subscriptions->isEmpty()) return;

            $auth = [
                'VAPID' => [
                    'subject'    => config('app.vapid_subject', 'mailto:admin@retirees.ae'),
                    'publicKey'  => config('app.vapid_public'),
                    'privateKey' => config('app.vapid_private'),
                ],
            ];

            $webPush = new WebPush($auth);
            $payload = json_encode([
                'title' => $title,
                'body'  => $body,
                'url'   => $url,
                'icon'  => '/assets/images/new-logo.png',
            ]);

            foreach ($subscriptions as $sub) {
                $webPush->queueNotification(
                    Subscription::create([
                        'endpoint' => $sub->endpoint,
                        'keys' => [
                            'p256dh' => $sub->p256dh_key,
                            'auth'   => $sub->auth_token,
                        ],
                    ]),
                    $payload
                );
            }

            foreach ($webPush->flush() as $report) {
                if (!$report->isSuccess()) {
                    PushSubscription::where('endpoint', $report->getRequest()->getUri()->__toString())->delete();
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Staff push notification failed: ' . $e->getMessage());
        }
    }
}
