<?php

use App\Models\AboutUs;
use Illuminate\Support\Facades\Route;
use App\Models\Banner;
use App\Models\News;
use App\Models\Event;
use App\Models\Service;
use App\Models\Magazine;
use App\Models\Member;
use App\Models\Committee;
use App\Models\Settings;
use App\Models\Council;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\MemberApplicationsController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ChatController;
use App\Models\MemberApplication;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\Feature;
use App\Models\Faq;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PublicEventController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

// Broadcasting auth (required for private channels)
\Illuminate\Support\Facades\Broadcast::routes(['middleware' => ['auth']]);

Route::get('contact-us', [ContactMessageController::class, 'index'])->name('contact-us');
Route::post('contact-us', [ContactMessageController::class, 'store'])->name('contact-us.store');

Route::prefix('admin')->name('admin.')->middleware(['auth', CheckUserStatus::class])->group(function () {
    Route::get('transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::patch('transactions/{transaction}/status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.update-status');

    Route::get('contact-messages', [ContactMessageController::class, 'admin'])->name('contact-messages');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    Route::patch('contact-messages/{contactMessage}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('contact-messages.toggle-read');
    Route::get('contact-messages-filter', [ContactMessageController::class, 'filter'])->name('contact-messages.filter');
    Route::get('contact-stats', [ContactMessageController::class, 'stats'])->name('contact-stats');
});


Route::get('faq', function () {
    $faqs = Faq::all();
    return view('faq',  compact('faqs'));
})->name('faq');

Route::get('/member/records', [TransactionController::class, 'record'])->name('members.record');

Route::middleware(['auth'])->name('members.')->group(function () {
    Route::get('/my-transactions', [TransactionController::class, 'record'])->name('record');
    Route::post('/subscribe/{service}', [TransactionController::class, 'subscribe'])->name('subscribe');
    // المسار الجديد لرفع الإيصال
    Route::post('/transactions/{transaction}/upload-receipt', [TransactionController::class, 'uploadReceipt'])->name('upload_receipt');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/events/{event}/subscribe', [TransactionController::class, 'subscribeToEvent'])->name('events.subscribe');
    Route::post('/services/{service}/subscribe', [TransactionController::class, 'subscribe'])->name('services.subscribe');
});

Route::get('/lang/{locale}', [LocalizationController::class, 'setLang'])
    ->name('set.locale');

Route::get('/members/councils_members_list/{id}', function ($id) {
$council = Council::find($id);
    $members = Member::where([
        'status' => 1,
        'council_id' => $id, 
        'committee_id' => null
    ])->get();
    return view('members.sidebar.members_counclis_list', compact('members', 'council'));
})->name('members.councils_members_list');

Route::get('/members/committee-members/{id}', function ($id) {
    $committee = Committee::find($id);
    $members = Member::where([
        'status' => 1,
        'committee_id' => null,
        'council_id' => $id
    ])->get();

    return view('members.sidebar.members_committees_list', compact('members', 'committee'));
})->name('members.committee_members_list');


Route::middleware('auth')->group(function () {
    Route::get('/members/panel', [\App\Http\Controllers\MemberPanelController::class, 'index'])->name('members.panel');
    Route::get('/members/panel/invoices', [\App\Http\Controllers\MemberPanelController::class, 'invoices'])->name('members.panel.invoices');
    Route::get('/members/notifications', [\App\Http\Controllers\MemberNotificationController::class, 'index'])->name('members.notifications.index');
    Route::post('/members/notifications/{userNotification}/dismiss', [\App\Http\Controllers\MemberNotificationController::class, 'dismiss'])->name('members.notifications.dismiss');
    Route::post('/members/notifications/{userNotification}/read', [\App\Http\Controllers\MemberNotificationController::class, 'read'])->name('members.notifications.read');

    Route::get('/members/recordEvents', function () {
        return view('members.sidebar.recordEvents');
    })->name('members.recordEvents');
    Route::get('/members/record', function () {
        $transactions = Transaction::with(['service', 'event'])
            ->where('user_id', Auth::id())
            ->orderByDesc('subscribed_at')
            ->get();
        $memberships = MemberApplication::where('user_id', Auth::id())->get();

        return view('members.sidebar.record', compact('transactions', 'memberships'));
    })->name('members.record');

    Route::get('/members/profile', [GuestProfileController::class, 'edit'])->name('members.profile');
    Route::get('/members/profile', [GuestProfileController::class, 'edit'])->name('members.profile');
    Route::put('/members/profile', [GuestProfileController::class, 'update'])->name('members.profile.update');
    Route::get('/chat', [ChatController::class, 'memberChat'])->name('chat');
    Route::get('/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::get('/download-document/{documentType}/{memberApplicationId}', function ($documentType, $memberApplicationId) {
    $application = App\Models\MemberApplication::find($memberApplicationId);
    if (!$application) {
        abort(404, 'Application not found.');
    }
    $filePath = null;
    $fileName = null;
    switch ($documentType) {
        case 'passport':
            $filePath = $application->passport_photo_path;
            $fileName = 'passport_photo.jpg';
            break;
        case 'national_id':
            $filePath = $application->national_id_photo_path;
            $fileName = 'national_id_photo.jpg';
            break;
        case 'personal_photo':
            $filePath = $application->personal_photo_path;
            $fileName = 'personal_photo.jpg';
            break;
        case 'educational_qualification':
            $filePath = $application->educational_qualification_photo_path;
            $fileName = 'educational_qualification.jpg';
            break;
        case 'retirement_card':
            $filePath = $application->retirement_card_photo_path;
            $fileName = 'retirement_card.jpg';
            break;
        default:
            abort(404, 'Invalid document type.');
    }

    if (!$filePath || !Storage::disk('public')->exists($filePath)) {
        abort(404, 'File not found.');
    }
    return Storage::disk('public')->download($filePath, $fileName);
})->name('download.document');

Route::get('/members/my-membership', [MemberApplicationsController::class, 'showRequirements'])->name('members.my-membership');

Route::get('/members/changepassword', [RegisterControllerUser::class, 'changepassword'])->name('members.changepassword');
Route::get('/members/otp', [RegisterControllerUser::class, 'otp'])->name('members.otp');
Route::get('/members/forgetpassword', [RegisterControllerUser::class, 'forgetpassword'])->name('members.forgetpassword');

// Route to handle sending the OTP email (from forgetpassword form)
Route::post('/members/send-otp', [RegisterControllerUser::class, 'sendOtp'])->name('members.send_otp');

// Route to handle verifying the OTP
Route::post('/members/verify-otp', [RegisterControllerUser::class, 'verifyOtp'])->name('members.verify_otp');

// Route to handle updating the password
Route::post('/members/update-password', [RegisterControllerUser::class, 'updatePassword'])->name('members.update_password');
Route::get('/members/register', [RegisterControllerUser::class, 'showRegistrationForm'])->name('members.register');
Route::post('/members/register', [RegisterControllerUser::class, 'register'])->name('members.register.store');
Route::get('/members/login', [LoginControllerUser::class, 'showLoginForm'])->name('members.login');
Route::post('/members/login', [LoginControllerUser::class, 'login'])->name('members.login.store');
Route::post('/members/logout', function () {
    Auth::logout();
    return redirect()->route('members.login');
})->name('members.logout');

Route::get('/members/membership-show', [MemberApplicationsController::class, 'showForm'])->name('members.membership-show');
Route::post('/members/application', [MemberApplicationsController::class, 'store'])->name('members.application.store');
Route::post('/members/renewal', [MemberApplicationsController::class, 'renew'])->name('members.renewal');
Route::middleware('auth')->group(function () {
    Route::get('/members/application/edit', [MemberApplicationsController::class, 'editApplication'])->name('members.application.edit');
    Route::post('/members/application/update', [MemberApplicationsController::class, 'updateApplication'])->name('members.application.update');
});

Route::get('/members/membership', function () {
    $sections = Membership::all();
    $user = Auth::user();

if (!$user) {
    // المستخدم مش عامل لوج إن
    return redirect('/login');
}
    $memberApplication = MemberApplication::where('user_id', Auth::user()->id)->first();
    $membership = $memberApplication;
    return view('members.sidebar.membership', compact('sections', 'membership')); 
})->name('members.membership');

Route::get('/members/committees', function () {
    $committees = Committee::all();
    $councils = Council::all();
    return view('members.sidebar.committees', compact('committees', 'councils'));
})->name('members.committees');

Route::get('/members/vision2', function () {
    $vision = AboutUs::where('key', 'our_vision')->first();
    $company_message = AboutUs::where('key', 'company_message')->first();
    $values = AboutUs::where('key', 'our_values')->first();
    $goals = AboutUs::where('key', 'our_goals')->first();
    return view('members.sidebar.vision2', compact('vision', 'company_message', 'values', 'goals'));
})->name('members.vision2');
Route::get('/members/vision', function () {
    $vision = AboutUs::where('key', 'our_vision')->first();
    $company_message = AboutUs::where('key', 'company_message')->first();
    $values = AboutUs::where('key', 'our_values')->first();
    $goals = AboutUs::where('key', 'our_goals')->first();
    return view('members.sidebar.vision', compact('vision', 'company_message', 'values', 'goals'));
})->name('members.vision');

Route::get('/members/members-list', function () {
    $members = Member::where([
        'status' => 1,
        'committee_id' => null,
        'council_id' => null
    ])->get();
    return view('members.sidebar.members-list', compact('members'));
})->name('members.members-list');

Route::get('/members/leader', function () {
    $about = AboutUs::where('key', 'admin_message')->first();
    return view('members.sidebar.leader', compact('about'));
})->name('members.leader');

Route::get('/members/about', function () {
    $about = AboutUs::where('key', 'about_us')->first();
    return view('members.sidebar.about', compact('about'));
})->name('members.about');

Route::get('/magazines/show/{id}', function ($id) {
    $magazines = Magazine::find($id);
    return view('members.magazines.show', compact('magazines'));
})->name('magazines.show');

Route::get('/feature/show/{id}', function ($id) {
    $magazines = Feature::find($id);
    return view('members.magazines.show', compact('magazines'));
})->name('feature.show');

Route::get('/magazines/all-magazines', function () {
    $magazines = Magazine::latest()->get();
    return view('members.magazines.all-magazines', compact('magazines'));
})->name('magazines.all-magazines');

Route::get('/magazines/feature', function () {
    $magazines = Feature::all();
    return view('members.feature.index', compact('magazines'));
})->name('magazines.feature');

Route::get('/services/show/{id}', function ($id) {
    $services = Service::find($id);
    return view('members.services.show', compact('services'));
})->name('services.show');

Route::get('/services/all-services', function () {
    $services = Service::all();
    $serviceEvents = \App\Models\Event::where('type', 'خدمات')->latest()->get();
    return view('members.services.all-services', compact('services', 'serviceEvents'));
})->name('services.all-services');

Route::get('/events/show/{id}', [PublicEventController::class, 'show'])->name('events.show');

Route::get('/events/all-events', [PublicEventController::class, 'index'])->name('events.all-events');
Route::get('/events/services', [PublicEventController::class, 'services'])->name('events.services');

Route::get('/news/show/{id}', function ($id) {
    $news = News::find($id);
    return view('members.news.show', compact('news'));
})->name('news.show');

Route::get('/news/all-news', function () {
    $news = News::latest()->get();
    return view('members.news.all-news', compact('news'));
})->name('news.all-news');
Route::get('/dashboard', function () {
    $banner = Banner::where('display_location', 'website')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $news = News::latest()->limit(3)->get();
    $events = Event::publiclyListed()->latest()->get();
    $magazines = Magazine::latest()->first();
    return view('dashboard', compact('banner', 'news', 'events', 'magazines'));
})->name('dashboard');

Route::get('/', function () {
    $banner = Banner::where('display_location', 'website')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $news = News::latest()->limit(5)->get();
    $allEvents       = Event::publiclyListed()->latest()->get();
    $events          = $allEvents->whereNotIn('type', ['خدمات', 'مميزات'])->values();
    $serviceEvents   = $allEvents->where('type', 'خدمات')->values();
    $services = Service::latest()->limit(3)->get();
    $magazines = Magazine::latest()->limit(5)->get();

    $settings = Settings::getActiveContactInfo();
    return view('welcome', compact('banner', 'news', 'events', 'allEvents', 'serviceEvents', 'services', 'magazines', 'settings'));
})->name('/');

// تأكد إن sw.js مش محفوظ في HTTP cache
Route::get('/sw.js', function () {
    $path = public_path('sw.js');
    return response(file_get_contents($path), 200)
        ->header('Content-Type', 'application/javascript; charset=utf-8')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Service-Worker-Allowed', '/');
});

// Push Notifications
Route::post('/push/subscribe',   [App\Http\Controllers\PushController::class, 'subscribe'])->name('push.subscribe');
Route::post('/push/unsubscribe', [App\Http\Controllers\PushController::class, 'unsubscribe'])->name('push.unsubscribe');
Route::get('/push/vapid-public', [App\Http\Controllers\PushController::class, 'vapidPublicKey'])->name('push.vapid');
Route::post('/push/send',        [App\Http\Controllers\PushController::class, 'send'])->middleware('auth')->name('push.send');

// ── تشخيص مؤقت — احذفه بعد الاختبار ──
Route::get('/push/debug', function () {
    $results = [];

    // 1. VAPID keys
    $results['vapid_public']  = config('app.vapid_public')  ? 'OK (' . strlen(config('app.vapid_public'))  . ' chars)' : 'MISSING';
    $results['vapid_private'] = config('app.vapid_private') ? 'OK (' . strlen(config('app.vapid_private')) . ' chars)' : 'MISSING';

    // 2. Extensions
    $results['ext_gmp']     = extension_loaded('gmp')     ? 'loaded' : 'MISSING';
    $results['ext_openssl'] = extension_loaded('openssl') ? 'loaded' : 'MISSING';
    $results['ext_curl']    = extension_loaded('curl')    ? 'loaded' : 'MISSING';

    // 3. Subscriptions
    $subs = \App\Models\PushSubscription::all();
    $results['subscriptions_count'] = $subs->count();
    $results['subscriptions'] = $subs->map(fn($s) => [
        'id'        => $s->id,
        'member_id' => $s->member_id,
        'endpoint'  => substr($s->endpoint, 0, 50) . '...',
        'created'   => $s->created_at,
    ]);

    // 4. Try sending a real push to first subscription
    if ($subs->isNotEmpty()) {
        try {
            $sub = $subs->first();
            $webPush = new \Minishlink\WebPush\WebPush(['VAPID' => [
                'subject'    => config('app.vapid_subject'),
                'publicKey'  => config('app.vapid_public'),
                'privateKey' => config('app.vapid_private'),
            ]]);
            $webPush->queueNotification(
                \Minishlink\WebPush\Subscription::create([
                    'endpoint' => $sub->endpoint,
                    'keys'     => ['p256dh' => $sub->p256dh_key, 'auth' => $sub->auth_token],
                ]),
                json_encode(['title' => 'اختبار تشخيص', 'body' => 'وصل الإشعار ✓', 'url' => '/'])
            );
            foreach ($webPush->flush() as $report) {
                $results['push_send'] = $report->isSuccess()
                    ? 'SUCCESS ✓'
                    : 'FAILED: ' . $report->getReason();
            }
        } catch (\Throwable $e) {
            $results['push_send'] = 'EXCEPTION: ' . $e->getMessage();
        }
    } else {
        $results['push_send'] = 'SKIPPED (no subscriptions)';
    }

    return response()->json($results, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin_routes.php';
