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
use App\Models\Council;
use App\Http\Controllers\Auth\RegisterControllerUser;
use App\Http\Controllers\Auth\LoginControllerUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\MemberApplicationsController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ChatController;

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
})->name('members.committee_members_list'); // غيرنا اسم الـ route لاسم أفضل


Route::middleware('auth')->group(function () {
    Route::get('/members/recordEvents', function () {
        return view('members.sidebar.recordEvents');
    })->name('members.recordEvents');
    Route::get('/members/record', function(){
        return view('members.sidebar.record');
    })->name('members.record');
    Route::get('/members/profile', [GuestProfileController::class, 'edit'])->name('members.profile');
    Route::get('/members/profile', [GuestProfileController::class, 'edit'])->name('members.profile');
    Route::put('/members/profile', [GuestProfileController::class, 'update'])->name('members.profile.update');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/admin/chat', [ChatController::class, 'adminIndex'])->name('admin.chat'); // أضف هذا السطر
    Route::get('/messages/{userId}', [ChatController::class, 'getMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
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

    if (!$filePath || !Storage::disk('public')->exists($filePath)) { // Assuming 'public' disk
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

Route::get('/members/membership-show', function () {
    return view('members.sidebar.membership-show');
})->name('members.membership-show');

Route::get('/members/membership', function () {
    $sections = Membership::all();
    return view('members.sidebar.membership', compact('sections')); 
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

Route::get('/magazines/all-magazines', function () {
    $magazines = Magazine::all();
    return view('members.magazines.all-magazines', compact('magazines'));
})->name('magazines.all-magazines');

Route::get('/services/show/{id}', function ($id) {
    $services = Service::find($id);
    return view('members.services.show', compact('services'));
})->name('services.show');

Route::get('/services/all-services', function () {
    $services = Service::all();
    return view('members.services.all-services', compact('services'));
})->name('services.all-services');

Route::get('/events/show/{id}', function ($id) {
    $events = Event::find($id);
    return view('members.events.show', compact('events'));
})->name('events.show');

Route::get('/events/all-events', function () {
    $events = Event::all();
    return view('members.events.all-events', compact('events'));
})->name('events.all-events');

Route::get('/news/show/{id}', function ($id) {
    $news = News::find($id);
    return view('members.news.show', compact('news'));
})->name('news.show');

Route::get('/news/all-news', function () {
    $news = News::all();
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
    $events = Event::latest()->get();
    $services = Service::latest()->limit(3)->get();
    $magazines = Magazine::latest()->first();
    return view('dashboard', compact('banner', 'news', 'events', 'services', 'magazines'));
})->name('dashboard');

Route::get('/', function () {
    $banner = Banner::where('display_location', 'website')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $news = News::latest()->limit(3)->get();
    $events = Event::latest()->get();
    $services = Service::latest()->limit(3)->get();
    $magazines = Magazine::latest()->first();
    return view('welcome', compact('banner', 'news', 'events', 'services', 'magazines'));
})->name('/');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin_routes.php';
