<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function memberChat(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            return redirect()->route('admin.chat');
        }

        // الأعضاء يتواصلون مع جميع الموظفين — نختار أول موظف تلقائياً
        $contacts = User::staff()->orderBy('name')->get();

        $autoContact = $contacts->first();

        return view('members.chat.index', [
            'contacts'    => $contacts,
            'autoContact' => $autoContact,
            'chatMode'    => 'member',
            'pageTitle'   => __('app.chat_with_administration'),
        ]);
    }

    public function adminChat(): View|RedirectResponse
    {
        $user = Auth::user();

        if (! $user->isStaff()) {
            return redirect()->route('chat');
        }

        $contacts = $this->memberContactsForStaff();

        return view('admin.chat.index', [
            'contacts' => $contacts,
            'chatMode' => 'admin',
            'pageTitle' => __('app.chat_with_members'),
        ]);
    }

    public function getMessages(int $userId): JsonResponse
    {
        $user = Auth::user();
        $other = User::findOrFail($userId);

        abort_unless($this->canAccessConversation($user, $other), 403);

        $messages = Message::where(function ($query) use ($user, $userId) {
            $query->where('from_user_id', $user->id)->where('to_user_id', $userId)
                ->orWhere('from_user_id', $userId)->where('to_user_id', $user->id);
        })
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderBy('created_at')
            ->get();

        if ($user->isStaff()) {
            Message::where('to_user_id', $user->id)
                ->where('from_user_id', $userId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        } else {
            Message::where('to_user_id', $user->id)
                ->where('from_user_id', $userId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return response()->json($messages);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:2000',
        ]);

        $recipient = User::findOrFail($validated['to_user_id']);

        abort_unless($this->canAccessConversation($user, $recipient), 403);

        $message = Message::create([
            'from_user_id' => $user->id,
            'to_user_id' => $recipient->id,
            'message' => $validated['message'],
        ]);

        $message->load(['sender:id,name', 'receiver:id,name']);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json([
            'status' => 'ok',
            'message' => $message,
        ]);
    }

    /** @deprecated Use memberChat() or adminChat() */
    public function index(): View|RedirectResponse
    {
        return Auth::user()->isStaff()
            ? $this->adminChat()
            : $this->memberChat();
    }

    /** @deprecated Use adminChat() */
    public function adminIndex(): View|RedirectResponse
    {
        return $this->adminChat();
    }

    protected function memberContactsForStaff()
    {
        return User::members()
            ->orderBy('name')
            ->get();
    }

    protected function canAccessConversation(User $viewer, User $other): bool
    {
        if ($viewer->id === $other->id) {
            return false;
        }

        if ($viewer->isStaff() && ! $other->isStaff()) {
            return true;
        }

        if (! $viewer->isStaff() && $other->isStaff()) {
            return true;
        }

        return false;
    }
}
