<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\ContactMessage;
use App\View\Composers\MemberHeaderComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Settings::getActiveContactInfo();
            $view->with('settings', $settings);
        });

        View::composer(
            ['components.guest-header', 'components.auth-header'],
            MemberHeaderComposer::class
        );

        View::composer('layouts.admin', function ($view) {
            try {
                $adminUnreadMessages = ContactMessage::unread()->count();
            } catch (\Throwable $e) {
                $adminUnreadMessages = 0;
            }
            $view->with('adminUnreadMessages', $adminUnreadMessages);
        });
        
        Paginator::useTailwind();

        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
