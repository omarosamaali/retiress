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
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ManageMembershipController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SliderController;

Route::get('/admin/magazines', [MagazineController::class, 'index'])->name('admin.magazines.index');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/transactions/{transaction}/activate', [TransactionController::class, 'activate'])->name('transactions.activate');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index'); // افتراضًا عندك كنترولر منفصل للأدمن
    Route::post('transactions/{transaction}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('transactions/{transaction}/confirm-payment', [TransactionController::class, 'confirmPayment'])->name('transactions.confirm_payment');
    Route::post('transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');
    Route::post('transactions/{transaction}/deactivate', [TransactionController::class, 'deactivate'])->name('transactions.deactivate');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('/settings/store', [SettingsController::class, 'store'])->name('settings.store');
    Route::put('/settings/{id}/toggle-status', [SettingsController::class, 'toggleStatus'])
    ->name('settings.toggle-status');
    Route::delete('/settings/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/messages', [MessageController::class, 'adminIndex'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'adminShow'])->name('messages.show');
    Route::put('/messages/{id}', [MessageController::class, 'adminUpdate'])->name('messages.update');
    Route::delete('/messages/{id}', [MessageController::class, 'adminDestroy'])->name('messages.destroy');
    Route::post('/messages/{message}/reply', [MessageController::class, 'adminReply'])->name('messages.reply');
    Route::get('/messages/{message}', [MessageController::class, 'adminShowAndReply'])->name('messages.message-show');
    Route::post('/messages/{message}/update-status-and-reply', [MessageController::class, 'adminUpdateStatusAndReply'])->name('messages.update-status-and-reply');
});

Route::middleware(['auth', CheckUserStatus::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');    Route::resource('users', UserController::class);
    Route::resource('membership', MembershipController::class);
    Route::resource('manageMembership', ManageMembershipController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('event', EventController::class);
    Route::resource('news', NewsController::class);
    Route::resource('magazines', MagazineController::class);
    Route::resource('feature', FeatureController::class);
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
