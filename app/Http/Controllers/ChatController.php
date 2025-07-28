<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'مدير') {
            $users = User::where('id', '!=', Auth::id())->get();
            return view('admin.chat', compact('users'));
        } else {
            // عرض المديرين فقط للمستخدم العادي
            $contacts = User::where('role', 'مدير')
                ->where('id', '!=', Auth::id())
                ->get();
            return view('user.chat', compact('contacts'));
        }
    }
public function adminIndex()
{
    if (!(Auth::user()->role === 'مدير')) {
        abort(403, 'Unauthorized');
    }
    $users = User::where('id', '!=', Auth::id())->get();
    return view('admin.chat', compact('users'));
}
    public function getMessages($userId)
    {
        $user = Auth::user();
        if ($user->is_admin) {
            // الأدمن يرى جميع الرسائل مع المستخدم المحدد
            $messages = Message::where(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->orWhere('to_user_id', $userId);
            })->with(['sender', 'receiver'])->get();
        } else {
            // المستخدم يرى الرسائل الخاصة به فقط
            $messages = Message::where(function ($query) use ($user, $userId) {
                $query->where('from_user_id', $user->id)->where('to_user_id', $userId)
                    ->orWhere('from_user_id', $userId)->where('to_user_id', $user->id);
            })->with(['sender', 'receiver'])->get();
        }

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent(Auth::user(), $message))->toOthers();

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }
}