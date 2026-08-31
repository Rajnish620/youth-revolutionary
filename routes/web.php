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
    $homeSetting = \App\Models\HomeSetting::getSettings();
    return view('home', compact('homeSetting'));
});

Route::get('/about', function () {
    $setting = \App\Models\AboutUsSetting::getSettings();
    $teamMembers = \App\Models\TeamMember::where('type', 'team')->orderBy('sort_order')->orderBy('id', 'asc')->get();
    $keyLeaders = \App\Models\TeamMember::where('type', 'advisor')->orderBy('sort_order')->orderBy('id', 'asc')->get();
    $realAdvisors = \App\Models\TeamMember::where('type', 'real_advisor')->orderBy('sort_order')->orderBy('id', 'asc')->get();
    return view('about', compact('setting', 'teamMembers', 'keyLeaders', 'realAdvisors'));
});

Route::get('/contact', function () {
    $contactSetting = \App\Models\ContactSetting::getSettings();
    return view('contact', compact('contactSetting'));
});

Route::get('/gallery', function () {
    $galleries = Gallery::with('season')->oldest()->get();
    $seasons = \App\Models\Season::oldest()->get();
    return view('gallery', compact('galleries', 'seasons'));
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
        'father_name' => 'required|string|max:255',
        'school_name' => 'nullable|string|max:255',
        'student_class' => 'required|string|max:100',
        'mobile' => 'required|string|max:20',
        'photo' => 'required_without:live_photo_base64|nullable|image|max:5120',
        'live_photo_base64' => 'nullable|string',
        'payment_screenshot' => 'required|image|max:5120',
        'transaction_id' => 'required|string|unique:event_registrations,transaction_id',
        'dob' => 'required|date',
        'email' => 'nullable|email|max:255',
        'gender' => 'required|string|max:10',
        'category' => 'required|string|max:50',
        'address' => 'required|string|max:500',
    ], [
        'photo.required' => 'Student photo upload is required.',
        'photo.required_without' => 'Student photo is required. Please upload your photo.',
        'photo.image' => 'The student photo must be a valid image file (JPG, PNG, WebP).',
        'photo.max' => 'The student photo size must not exceed 5MB.',
        'payment_screenshot.required' => 'Payment screenshot is required.',
        'payment_screenshot.image' => 'The payment screenshot must be a valid image file.',
        'transaction_id.required' => 'Transaction ID / UTR number is required.',
        'transaction_id.unique' => 'This Transaction ID has already been registered.',
    ]);

    // Handle Photo (File upload OR base64)
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = 'student_' . time() . '_' . uniqid() . '.' . $file->extension();
        $file->move(public_path('uploads/students'), $filename);
        $photoPath = 'uploads/students/' . $filename;
    } elseif ($request->filled('live_photo_base64')) {
        $imgData = $request->input('live_photo_base64');
        if (preg_match('/^data:image\/(\w+);base64,/', $imgData, $type)) {
            $imgData = substr($imgData, strpos($imgData, ',') + 1);
            $type = strtolower($type[1]);
            $imgData = base64_decode($imgData);
            if ($imgData !== false) {
                $filename = 'student_live_' . time() . '_' . uniqid() . '.' . $type;
                $dir = public_path('uploads/students');
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                file_put_contents($dir . '/' . $filename, $imgData);
                $photoPath = 'uploads/students/' . $filename;
            }
        }
    }

    if (!$photoPath) {
        return back()->withErrors(['photo' => 'Student photo is required. Please upload your photo.'])->withInput();
    }
    
    // Handle Payment Screenshot
    $paymentPath = null;
    if ($request->hasFile('payment_screenshot')) {
        $file = $request->file('payment_screenshot');
        $filename = 'payment_' . time() . '_' . uniqid() . '.' . $file->extension();
        $file->move(public_path('uploads/payments'), $filename);
        $paymentPath = 'uploads/payments/' . $filename;
    }

    $validated['photo'] = $photoPath;
    $validated['payment_screenshot'] = $paymentPath;
    unset($validated['live_photo_base64']);

    // Fetch group fee if selected
    $fee = 100.00;
    $rollStart = 1000;
    if ($request->filled('event_group_id')) {
        $group = EventGroup::find($request->event_group_id);
        if ($group) {
            $fee = $group->fee;
            $rollStart = $group->roll_sequence_start ?? 1000;
        }
    }

    // Generate unique Roll No (group-based sequence)
    $latestRoll = EventRegistration::where('event_group_id', $request->event_group_id)
        ->where('roll_no', 'like', 'YR%')
        ->orderByRaw("CAST(RIGHT(roll_no, 4) AS UNSIGNED) DESC")
        ->first();

    if ($latestRoll && preg_match('/^YR-?(\d{4})-?(\d+)$/', $latestRoll->roll_no, $matches)) {
        // $matches[1] = Year (e.g. 2026), $matches[2] = Sequence (e.g. 2026)
        $nextRollNumber = max($rollStart, (int)$matches[2] + 1);
    } elseif ($latestRoll && preg_match('/(\d+)$/', $latestRoll->roll_no, $matches)) {
        $nextRollNumber = max($rollStart, (int)$matches[1] + 1);
    } else {
        $nextRollNumber = $rollStart;
    }
    
    // Safety check: Ensure globally unique roll number across the table
    $candidateRoll = 'YR' . date('Y') . str_pad($nextRollNumber, 4, '0', STR_PAD_LEFT);
    while (EventRegistration::where('roll_no', $candidateRoll)->exists()) {
        $nextRollNumber++;
        $candidateRoll = 'YR' . date('Y') . str_pad($nextRollNumber, 4, '0', STR_PAD_LEFT);
    }
    $validated['roll_no'] = $candidateRoll;

    // Generate unique Registration No per season (Format: YRREG0001)
    $event = Event::find($request->event_id);
    $season = $event ? $event->season : null;

    $latestRegistration = EventRegistration::whereHas('event', function ($q) use ($season) {
        if ($season) {
            $q->where('season', $season);
        } else {
            $q->whereNull('season')->orWhere('season', '');
        }
    })
    ->whereNotNull('registration_no')
    ->where('registration_no', 'like', 'YRREG%')
    ->orderBy('id', 'desc')
    ->first();

    if ($latestRegistration && preg_match('/YRREG(\d+)$/', $latestRegistration->registration_no, $matches)) {
        $nextRegNumber = (int)$matches[1] + 1;
    } else {
        $nextRegNumber = 1;
    }
    
    $validated['registration_no'] = 'YRREG' . str_pad($nextRegNumber, 4, '0', STR_PAD_LEFT);
    $validated['fee_paid'] = $fee;
    $validated['payment_status'] = 'pending';

    $registration = EventRegistration::create($validated);
    $registration->load('event', 'group');

    return redirect()->back()->with('success_registration', $registration);
});

Route::get('/certificate/{roll_no}', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'showCertificate'])->name('certificate.show');

Route::get('/results', function () {
    return view('result');
});

Route::get('/competitions/{slug}', function ($slug) {
    // Find category by slug
    $categories = \App\Models\Category::all();
    $category = $categories->first(function($cat) use ($slug) {
        return strtolower(str_replace(' ', '-', $cat->name)) === $slug;
    });

    if (!$category) {
        abort(404);
    }

    $events = \App\Models\Event::where('category', $category->name)->latest()->get();
    
    return view('competitions.show', compact('category', 'events'));
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

Route::get('/youthadmin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/youthadmin', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\AdmitCardController;
Route::get('/admit-card', [AdmitCardController::class, 'index'])->name('admit-card.index');
Route::post('/admit-card/download', [AdmitCardController::class, 'download'])->name('admit-card.download');

use App\Http\Controllers\AnswerKeyController;
Route::get('/answer-key', [AnswerKeyController::class, 'index'])->name('answer-key.index');
Route::post('/answer-key/authenticate', [AnswerKeyController::class, 'authenticate'])->name('answer-key.authenticate');
Route::get('/answer-key/view', [AnswerKeyController::class, 'view'])->name('answer-key.view');
Route::post('/answer-key/logout', [AnswerKeyController::class, 'logout'])->name('answer-key.logout');

use App\Http\Controllers\Admin\CompetitionController;

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalRegistrations = \App\Models\EventRegistration::count();
        $activeCompetitions = \App\Models\Event::where('status', 'ongoing')->count();
        $upcomingEvents = \App\Models\Event::where('status', 'upcoming')->count();
        $totalCollections = \App\Models\EventRegistration::where('payment_status', 'approved')->sum('fee_paid');

        $recentRegistrations = \App\Models\EventRegistration::with('event')->latest()->take(5)->get();
        $categories = \App\Models\Category::all();
        $seasons = \App\Models\Season::latest()->get();

        return view('admin.dashboard', compact('totalRegistrations', 'activeCompetitions', 'upcomingEvents', 'totalCollections', 'recentRegistrations', 'categories', 'seasons'));
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

    Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class, [
        'names' => 'admin.categories'
    ]);

    Route::resource('admin/seasons', \App\Http\Controllers\Admin\SeasonController::class, [
        'names' => 'admin.seasons'
    ]);

    // Admin Registrations & Payments
    Route::get('admin/registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'index'])->name('admin.registrations.index');
    Route::post('admin/registrations/{registration}/approve', [\App\Http\Controllers\Admin\RegistrationController::class, 'approvePayment'])->name('admin.registrations.approve');
    Route::post('admin/registrations/{registration}/reject', [\App\Http\Controllers\Admin\RegistrationController::class, 'rejectPayment'])->name('admin.registrations.reject');
    Route::post('admin/registrations/{registration}/toggle-admit-card', [\App\Http\Controllers\Admin\RegistrationController::class, 'toggleAdmitCard'])->name('admin.registrations.toggle-admit-card');
    Route::post('admin/registrations/bulk-admit-card', [\App\Http\Controllers\Admin\RegistrationController::class, 'bulkAdmitCardToggle'])->name('admin.registrations.bulk-admit-card');
    Route::delete('admin/registrations/{registration}', [\App\Http\Controllers\Admin\RegistrationController::class, 'destroy'])->name('admin.registrations.destroy');
    Route::get('admin/registrations/signature-sheet', [\App\Http\Controllers\Admin\RegistrationController::class, 'signatureSheet'])->name('admin.registrations.signature-sheet');
    Route::get('admin/registrations/desk-slips', [\App\Http\Controllers\Admin\RegistrationController::class, 'deskSlips'])->name('admin.registrations.desk-slips');
    Route::get('admin/registrations/roll-numbers', [\App\Http\Controllers\Admin\RegistrationController::class, 'rollNumbers'])->name('admin.registrations.roll-numbers');

    // Admin Marks & Certificates
    Route::get('admin/marks', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'index'])->name('admin.marks.index');
    Route::post('admin/marks/{registration}/update', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'updateMarks'])->name('admin.marks.update');
    Route::post('admin/marks/{registration}/toggle-certificate', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'toggleCertificate'])->name('admin.marks.toggle-certificate');
    Route::post('admin/marks/bulk-certificate', [\App\Http\Controllers\Admin\MarksCertificateController::class, 'bulkCertificateToggle'])->name('admin.marks.bulk-certificate');

    // Admin Payment Settings
    Route::get('admin/settings/payment', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.payment.index');
    Route::post('admin/settings/payment', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.payment.update');

    // Admin Contact Settings
    Route::get('admin/settings/contact', [\App\Http\Controllers\Admin\ContactSettingController::class, 'index'])->name('admin.settings.contact.index');
    Route::post('admin/settings/contact', [\App\Http\Controllers\Admin\ContactSettingController::class, 'update'])->name('admin.settings.contact.update');

    // Admin Admit Card Settings
    Route::get('admin/settings/admit-card', [\App\Http\Controllers\Admin\AdmitCardSettingController::class, 'index'])->name('admin.settings.admit-card.index');
    Route::post('admin/settings/admit-card', [\App\Http\Controllers\Admin\AdmitCardSettingController::class, 'update'])->name('admin.settings.admit-card.update');

    // Admin About Us Settings
    Route::get('admin/settings/about-us', [\App\Http\Controllers\Admin\AboutUsSettingController::class, 'index'])->name('admin.settings.about-us.index');
    Route::post('admin/settings/about-us', [\App\Http\Controllers\Admin\AboutUsSettingController::class, 'updateSettings'])->name('admin.settings.about-us.update');
    Route::post('admin/settings/about-us/team', [\App\Http\Controllers\Admin\AboutUsSettingController::class, 'storeTeamMember'])->name('admin.settings.about-us.team.store');
    Route::put('admin/settings/about-us/team/{teamMember}', [\App\Http\Controllers\Admin\AboutUsSettingController::class, 'updateTeamMember'])->name('admin.settings.about-us.team.update');
    Route::delete('admin/settings/about-us/team/{teamMember}', [\App\Http\Controllers\Admin\AboutUsSettingController::class, 'destroyTeamMember'])->name('admin.settings.about-us.team.destroy');

    // Admin Home Settings
    Route::get('admin/settings/home', [\App\Http\Controllers\Admin\HomeSettingController::class, 'index'])->name('admin.settings.home.index');
    Route::post('admin/settings/home', [\App\Http\Controllers\Admin\HomeSettingController::class, 'update'])->name('admin.settings.home.update');

    // Admin Inquiries
    Route::get('admin/inquiries', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.inquiries.index');
    Route::post('admin/inquiries/{message}/read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])->name('admin.inquiries.mark-read');
    Route::delete('admin/inquiries/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.inquiries.destroy');

    // Admin Finance
    Route::get('admin/finance', [\App\Http\Controllers\Admin\FinanceController::class, 'index'])->name('admin.finance.index');
    Route::post('admin/finance/contributions', [\App\Http\Controllers\Admin\FinanceController::class, 'storeContribution'])->name('admin.finance.contributions.store');
    Route::put('admin/finance/contributions/{contribution}', [\App\Http\Controllers\Admin\FinanceController::class, 'updateContribution'])->name('admin.finance.contributions.update');
    Route::delete('admin/finance/contributions/{contribution}', [\App\Http\Controllers\Admin\FinanceController::class, 'destroyContribution'])->name('admin.finance.contributions.destroy');
    // Admin Finance
    Route::get('admin/finance', [\App\Http\Controllers\Admin\FinanceController::class, 'index'])->name('admin.finance.index');
    Route::get('admin/finance/print', [\App\Http\Controllers\Admin\FinanceController::class, 'print'])->name('admin.finance.print');
    Route::post('admin/finance/contributions', [\App\Http\Controllers\Admin\FinanceController::class, 'storeContribution'])->name('admin.finance.contributions.store');
    Route::put('admin/finance/contributions/{contribution}', [\App\Http\Controllers\Admin\FinanceController::class, 'updateContribution'])->name('admin.finance.contributions.update');
    Route::delete('admin/finance/contributions/{contribution}', [\App\Http\Controllers\Admin\FinanceController::class, 'destroyContribution'])->name('admin.finance.contributions.destroy');
    Route::post('admin/finance/expenses', [\App\Http\Controllers\Admin\FinanceController::class, 'storeExpense'])->name('admin.finance.expenses.store');
    Route::put('admin/finance/expenses/{expense}', [\App\Http\Controllers\Admin\FinanceController::class, 'updateExpense'])->name('admin.finance.expenses.update');
    Route::delete('admin/finance/expenses/{expense}', [\App\Http\Controllers\Admin\FinanceController::class, 'destroyExpense'])->name('admin.finance.expenses.destroy');

    // Admin Answer Keys
    Route::get('admin/answer-keys', [\App\Http\Controllers\Admin\AnswerKeyController::class, 'index'])->name('admin.answer-keys.index');
    Route::post('admin/answer-keys', [\App\Http\Controllers\Admin\AnswerKeyController::class, 'store'])->name('admin.answer-keys.store');
    Route::patch('admin/answer-keys/{answerKey}/toggle', [\App\Http\Controllers\Admin\AnswerKeyController::class, 'toggle'])->name('admin.answer-keys.toggle');
    Route::delete('admin/answer-keys/{answerKey}', [\App\Http\Controllers\Admin\AnswerKeyController::class, 'destroy'])->name('admin.answer-keys.destroy');
});
