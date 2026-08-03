<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventGroup;
use App\Models\EventRegistration;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/gallery', function () {
    $galleries = Gallery::latest()->get();
    return view('gallery', compact('galleries'));
});

Route::get('/events', function () {
    $events = Event::latest()->get();
    $featuredEvent = Event::where('is_featured', true)->first() ?? Event::first();
    return view('events', compact('events', 'featuredEvent'));
});

Route::get('/register', function (Request $request) {
    $events = Event::with('groups')->get();
    $paymentSetting = PaymentSetting::getSettings();
    return view('register', compact('events', 'paymentSetting'));
});

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'event_group_id' => 'nullable|exists:event_groups,id',
        'student_name' => 'required|string|max:255',
        'father_name' => 'nullable|string|max:255',
        'school_name' => 'nullable|string|max:255',
        'student_class' => 'required|string|max:100',
        'mobile' => 'required|string|max:20',
        'photo' => 'nullable|string',
        'payment_screenshot' => 'nullable|string',
    ]);

    // Fetch group fee if selected
    $fee = 100.00;
    if ($request->filled('event_group_id')) {
        $group = EventGroup::find($request->event_group_id);
        if ($group) {
            $fee = $group->fee;
        }
    }

    // Generate unique Roll No
    $nextId = (EventRegistration::max('id') ?? 0) + 1;
    $validated['roll_no'] = 'YR-' . date('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    $validated['fee_paid'] = $fee;
    $validated['payment_status'] = 'pending';

    $registration = EventRegistration::create($validated);

    return redirect()->back()->with('success_registration', $registration);
});

Route::get('/certificate/{roll_no}', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'showCertificate'])->name('certificate.show');

Route::get('/results', function () {
    return view('result');
});

Route::get('/competitions/education', function () {
    return view('competitions.education');
});

Route::get('/competitions/sports', function () {
    return view('competitions.sports');
});

Route::get('/competitions/cultural', function () {
    return view('competitions.cultural');
});

Route::get('/educationlearn', function () {
    return view('learn.education');
});

Route::get('/sportslearn', function () {
    return view('learn.sports');
});

Route::get('/culturallearn', function () {
    return view('learn.cultural');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\CompetitionController;

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('admin/competitions', CompetitionController::class, [
        'names' => 'admin.competitions'
    ]);

    Route::resource('admin/gallery', \App\Http\Controllers\Admin\GalleryController::class, [
        'names' => 'admin.gallery'
    ]);

    Route::resource('admin/events', \App\Http\Controllers\Admin\EventController::class, [
        'names' => 'admin.events'
    ]);

    Route::resource('admin/groups', \App\Http\Controllers\Admin\EventGroupController::class, [
        'names' => 'admin.groups'
    ]);

    // Admin Registrations & Payments
    Route::get('admin/registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'index'])->name('admin.registrations.index');
    Route::post('admin/registrations/{registration}/approve', [\App\Http\Controllers\Admin\RegistrationController::class, 'approvePayment'])->name('admin.registrations.approve');
    Route::post('admin/registrations/{registration}/reject', [\App\Http\Controllers\Admin\RegistrationController::class, 'rejectPayment'])->name('admin.registrations.reject');
    Route::delete('admin/registrations/{registration}', [\App\Http\Controllers\Admin\RegistrationController::class, 'destroy'])->name('admin.registrations.destroy');
    Route::get('admin/registrations/signature-sheet', [\App\Http\Controllers\Admin\RegistrationController::class, 'signatureSheet'])->name('admin.registrations.signature-sheet');
    Route::get('admin/registrations/desk-slips', [\App\Http\Controllers\Admin\RegistrationController::class, 'deskSlips'])->name('admin.registrations.desk-slips');

    // Admin Marks & Certificates
    Route::get('admin/marks', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'index'])->name('admin.marks.index');
    Route::post('admin/marks/{registration}/update', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'updateMarks'])->name('admin.marks.update');
    Route::post('admin/marks/{registration}/toggle-certificate', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'toggleCertificate'])->name('admin.marks.toggle-certificate');
    Route::post('admin/marks/bulk-certificate', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'bulkCertificateToggle'])->name('admin.marks.bulk-certificate');

    // Admin Payment QR Settings
    Route::get('admin/settings/payment', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.payment.index');
    Route::post('admin/settings/payment', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.payment.update');
});
