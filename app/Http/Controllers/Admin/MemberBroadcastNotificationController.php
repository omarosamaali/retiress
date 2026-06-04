<?php

namespace App\Http\Controllers\Admin;

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
        $recent = MemberBroadcastNotification::with('creator')->latest()->limit(10)->get();

        return view('admin.notifications.create', compact('recent'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        DB::transaction(function () use ($validated) {
            $broadcast = MemberBroadcastNotification::create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'created_by' => Auth::id(),
                'sent_at' => now(),
            ]);

            $memberIds = User::where('role', 'عضو')->pluck('id');

            foreach ($memberIds as $userId) {
                UserNotification::create([
                    'member_broadcast_notification_id' => $broadcast->id,
                    'user_id' => $userId,
                ]);
            }
        });

        return redirect()
            ->route('admin.member-notifications.create')
            ->with('success', 'تم إرسال الإشعار لجميع الأعضاء بنجاح.');
    }
}
