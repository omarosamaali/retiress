<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HospController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\CouncilController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MagazineController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\ManageMembershipController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [MessageController::class, 'adminIndex'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'adminShow'])->name('messages.show');
    Route::put('/messages/{id}', [MessageController::class, 'adminUpdate'])->name('messages.update');
    Route::delete('/messages/{id}', [MessageController::class, 'adminDestroy'])->name('messages.destroy');
    Route::post('/messages/{message}/reply', [MessageController::class, 'adminReply'])->name('messages.reply');
    Route::get('/messages/{message}', [MessageController::class, 'adminShowAndReply'])->name('messages.message-show');
    Route::post('/messages/{message}/update-status-and-reply', [MessageController::class, 'adminUpdateStatusAndReply'])->name('messages.update-status-and-reply');
});

Route::middleware(['auth', CheckUserStatus::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('membership', MembershipController::class);
    Route::resource('manageMembership', ManageMembershipController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('event', EventController::class);
    Route::resource('news', NewsController::class);
    Route::resource('magazines', MagazineController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('setting', ServiceController::class);
    Route::resource('about-us', AboutUsController::class);
    Route::resource('member', MemberController::class);
    Route::resource('committee', CommitteeController::class);
    Route::resource('council', CouncilController::class);
    Route::resource('terms', TermsController::class);
    Route::resource('hosp', HospController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('banners', BannerController::class);
});
