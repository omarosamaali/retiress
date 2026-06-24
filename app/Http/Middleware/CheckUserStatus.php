<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    private const DATA_ENTRY_ALLOWED_ROUTES = [
        'admin.dashboard',
        'profile.edit',
        'profile.update',
        'profile.destroy',
        // الرسائل
        'admin.contact-messages',
        'admin.contact-messages.show',
        'admin.contact-messages.destroy',
        'admin.contact-messages.toggle-read',
        'admin.contact-messages.filter',
        'admin.contact-stats',
        'admin.staff-notifications',
        // المعاملات
        'admin.transactions.index',
        'admin.transactions.update-status',
        'admin.transactions.activate',
        'admin.transactions.approve',
        'admin.transactions.confirm_payment',
        'admin.transactions.deactivate',
        'admin.transactions.reject',
        // إشعارات الأعضاء
        'admin.member-notifications.create',
        'admin.member-notifications.store',
        'admin.member-notifications.index',
        'admin.member-notifications.show',
        // الأخبار
        'admin.news.index',
        'admin.news.create',
        'admin.news.store',
        'admin.news.show',
        'admin.news.edit',
        'admin.news.update',
        'admin.news.destroy',
        // الإعلانات والفعاليات
        'admin.event.index',
        'admin.event.create',
        'admin.event.store',
        'admin.event.show',
        'admin.event.edit',
        'admin.event.update',
        'admin.event.destroy',
        // منبر الخبراء
        'admin.magazines.index',
        'admin.magazines.create',
        'admin.magazines.store',
        'admin.magazines.show',
        'admin.magazines.edit',
        'admin.magazines.update',
        'admin.magazines.destroy',
    ];

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

            if ($user->role === 'مدخل بيانات' && ! in_array($currentRoute, self::DATA_ENTRY_ALLOWED_ROUTES, true)) {
                Log::warning('Data entry user tried to access forbidden route', [
                    'user_id' => $user->id,
                    'attempted_route' => $currentRoute,
                ]);

                return redirect()
                    ->route('admin.dashboard')
                    ->with('error', 'ليس لديك صلاحية للوصول لهذه الصفحة.');
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
