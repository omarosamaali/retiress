<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
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
        
        Paginator::useTailwind();

        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
