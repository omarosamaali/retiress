<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RedirectsAfterLogin
{
    public static function url(User $user): string
    {
        if ($user->canAccessAdminPanel()) {
            return route('admin.dashboard', absolute: false);
        }

        if ($user->isMemberRole()) {
            return route('members.panel', absolute: false);
        }

        return url('/');
    }

    public static function intended(User $user, ?string $suffix = null): RedirectResponse
    {
        $url = self::url($user);

        if ($suffix !== null) {
            $url .= $suffix;
        }

        return redirect()->intended($url);
    }
}
