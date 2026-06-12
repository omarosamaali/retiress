<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('members.login'));

        $middleware->web(append: [
            \App\Http\Middleware\Localization::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'push/subscribe',
            'push/unsubscribe',
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('memberships:update-expired')->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
