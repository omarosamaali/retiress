<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $excludedRoutes = [
            'login',
            'register',
            'password.request',
            'password.reset',
            'verification.notice',
            'verification.verify',
            'verification.send',
        ];

        $currentRoute = $request->route() ? $request->route()->getName() : null;

        if (in_array($currentRoute, $excludedRoutes, true)) {
            return $next($request);
        }

        if (! Auth::check()) {
            if ($this->isAdminRequest($request, $currentRoute)) {
                return redirect()->route('login');
            }

            return $next($request);
        }

        $user = Auth::user();

        if ($this->isAccountInactive($user)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors([
                'email' => 'حسابك غير فعال حالياً. يرجى التواصل مع الإدارة.',
            ]);
        }

        if ($this->isAdminRequest($request, $currentRoute)) {
            if (! $user->canAccessAdminPanel()) {
                Log::warning('Non-staff user tried to access admin panel', [
                    'user_id' => $user->id,
                    'user_role' => $user->role,
                    'attempted_route' => $currentRoute,
                ]);

                return redirect('/')->with('error', 'ليس لديك صلاحية للوصول إلى لوحة الإدارة.');
            }

        }

        return $next($request);
    }

    private function isAdminRequest(Request $request, ?string $routeName): bool
    {
        if ($routeName !== null) {
            if (str_starts_with($routeName, 'admin.')) {
                return true;
            }

            if (in_array($routeName, ['sliders.index', 'sliders.create', 'sliders.store', 'sliders.edit', 'sliders.update', 'sliders.destroy', 'admin.settings.index', 'admin.settings.create', 'admin.settings.store', 'admin.settings.toggle-status', 'admin.settings.destroy'], true)) {
                return true;
            }
        }

        return $request->is('admin', 'admin/*');
    }

    private function isAccountInactive($user): bool
    {
        $status = $user->status;

        if (in_array($status, ['غير فعال', 'بانتظار التفعيل', 'بإنتظار إستكمال البيانات'], true)) {
            return true;
        }

        // قيم رقمية قديمة: 1 = غير فعال
        if ($status === 1 || $status === '1') {
            return true;
        }

        return false;
    }
}
