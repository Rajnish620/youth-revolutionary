<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\AdmitCardSetting;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class MarksCertificateController extends Controller
{
    public function index(Request $request)
    {
        // Load Events with registration counts
        $events = Event::withCount([
            'registrations as approved_registrations_count' => function ($q) {
                $q->where('payment_status', 'approved');
            },
            'registrations as marks_entered_count' => function ($q) {
                $q->where('payment_status', 'approved')->whereNotNull('marks');
            },
            'registrations as certificates_enabled_count' => function ($q) {
                $q->where('payment_status', 'approved')->where('certificate_enabled', true);
            },
        ])->orderBy('id', 'desc')->get();

        // Query Registrations
        $query = EventRegistration::with(['event', 'group'])->where('payment_status', 'approved');

        if ($request->filled('event_id') && $request->event_id !== 'All') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('roll_no', 'like', "%{$search}%")
                  ->orWhere('registration_no', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status_filter')) {
            if ($request->status_filter === 'with_marks') {
                $query->whereNotNull('marks');
            } elseif ($request->status_filter === 'without_marks') {
                $query->whereNull('marks');
            } elseif ($request->status_filter === 'cert_enabled') {
                $query->where('certificate_enabled', true);
            } elseif ($request->status_filter === 'cert_disabled') {
                $query->where('certificate_enabled', false);
            }
        }

        $registrations = $query->orderBy('roll_no', 'asc')->paginate(25)->withQueryString();

        // Summary Statistics
        $totalApproved = EventRegistration::where('payment_status', 'approved')->count();
        $eventsWithMarks = Event::where('show_marks', true)->count();
        $eventsWithCertificates = Event::where('show_certificate', true)->count();
        $totalCertsEnabled = EventRegistration::where('payment_status', 'approved')->where('certificate_enabled', true)->count();

        return view('admin.marks.index', compact(
            'registrations',
            'events',
            'totalApproved',
            'eventsWithMarks',
            'eventsWithCertificates',
            'totalCertsEnabled'
        ));
    }

    public function updateEventSettings(Request $request, Event $event)
    {
        $validated = $request->validate([
            'show_marks' => 'nullable|boolean',
            'show_certificate' => 'nullable|boolean',
            'total_questions' => 'nullable|integer|min:0|max:1000',
            'marks_per_question' => 'nullable|numeric|min:0|max:1000',
            'negative_marks' => 'nullable|numeric|min:0|max:100',
            'total_marks' => 'nullable|numeric|min:0|max:10000',
            'cutoff_marks' => 'nullable|numeric|min:0|max:10000',
            'marking_scheme_notes' => 'nullable|string|max:2000',
        ]);

        $validated['show_marks'] = $request->boolean('show_marks');
        $validated['show_certificate'] = $request->boolean('show_certificate');

        $event->update($validated);

        return redirect()->back()->with('success', "Scoring & Publication settings updated for event: {$event->title}!");
    }

    public function updateMarks(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'marks' => 'nullable|numeric|min:0|max:10000',
            'rank' => 'nullable|string|max:100',
            'correct_answers' => 'nullable|integer|min:0|max:1000',
            'wrong_answers' => 'nullable|integer|min:0|max:1000',
        ]);

        $registration->update($validated);

        return redirect()->back()->with('success', "Marks updated for {$registration->student_name} (Roll: {$registration->roll_no})!");
    }

    public function toggleCertificate(EventRegistration $registration)
    {
        $registration->update([
            'certificate_enabled' => !$registration->certificate_enabled,
        ]);

        $status = $registration->certificate_enabled ? 'ENABLED' : 'DISABLED';
        return redirect()->back()->with('success', "Certificate {$status} for Roll No: {$registration->roll_no}.");
    }

    public function bulkCertificateToggle(Request $request)
    {
        $eventId = $request->input('event_id');
        $enable = $request->input('enable') == '1';

        $query = EventRegistration::where('payment_status', 'approved');
        if ($eventId && $eventId !== 'All') {
            $query->where('event_id', $eventId);
        }

        $query->update(['certificate_enabled' => $enable]);

        $status = $enable ? 'ENABLED' : 'DISABLED';
        return redirect()->back()->with('success', "Certificates {$status} for selected participants!");
    }

    public function showMarksheet($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        // If not logged in admin, enforce event's publication rule
        if (!auth()->check()) {
            if (!$registration->event || !$registration->event->show_marks) {
                abort(403, 'Marksheet has not been published yet for this event by the Administrator.');
            }
            if ($registration->marks === null) {
                abort(404, 'Marks have not yet been uploaded for this candidate.');
            }
        }

        $setting = AdmitCardSetting::getSettings();

        return view('marksheet.show', compact('registration', 'setting'));
    }

    public function downloadMarksheet($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        if (!auth()->check()) {
            if (!$registration->event || !$registration->event->show_marks) {
                abort(403, 'Marksheet has not been published yet for this event by the Administrator.');
            }
            if ($registration->marks === null) {
                abort(404, 'Marks have not yet been uploaded for this candidate.');
            }
        }

        $setting = AdmitCardSetting::getSettings();
        $html = view('pdf.marksheet', compact('registration', 'setting'))->render();

        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_left' => 6,
            'margin_right' => 6,
            'margin_top' => 6,
            'margin_bottom' => 6,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        ini_set('pcre.backtrack_limit', '5000000');
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Marksheet_' . $registration->roll_no . '.pdf"',
        ]);
    }

    public function showCertificate($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        if (!auth()->check()) {
            if (!$registration->event || !$registration->event->show_certificate) {
                abort(403, 'Certificates have not been published for this event yet.');
            }
            if (!$registration->certificate_enabled) {
                abort(403, 'Certificate has not been released yet for this participant by the Administrator.');
            }
        }

        $setting = AdmitCardSetting::getSettings();

        return view('certificate.show', compact('registration', 'setting'));
    }

    public function downloadCertificate($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        if (!auth()->check()) {
            if (!$registration->event || !$registration->event->show_certificate) {
                abort(403, 'Certificates have not been published for this event yet.');
            }
            if (!$registration->certificate_enabled) {
                abort(403, 'Certificate has not been released yet for this participant by the Administrator.');
            }
        }

        $setting = AdmitCardSetting::getSettings();
        $html = view('pdf.certificate', compact('registration', 'setting'))->render();

        $mpdf = new Mpdf([
            'format' => 'A4-L',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        ini_set('pcre.backtrack_limit', '5000000');
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Certificate_' . $registration->roll_no . '.pdf"',
        ]);
    }

    public function publicResultSearch(Request $request)
    {
        $searchedStudent = null;
        $searchPerformed = false;
        $errorMessage = null;

        if ($request->filled('query_string') || $request->filled('reg_no') || $request->filled('roll_no')) {
            $searchPerformed = true;
            $searchKey = trim($request->input('query_string') ?? $request->input('reg_no') ?? $request->input('roll_no'));
            $dob = $request->input('dob');

            $dbQuery = EventRegistration::with(['event', 'group'])
                ->where('payment_status', 'approved')
                ->where(function ($q) use ($searchKey) {
                    $q->where('registration_no', $searchKey)
                      ->orWhere('roll_no', $searchKey);
                });

            if (!empty($dob)) {
                $dbQuery->where('dob', $dob);
            }

            $searchedStudent = $dbQuery->first();

            if (!$searchedStudent) {
                $errorMessage = 'No approved record found matching this Registration / Roll Number. Please ensure your details match your Admit Card.';
            }
        }

        // Top qualifiers for leaderboard / highlights
        $topWinners = EventRegistration::with(['event', 'group'])
            ->where('payment_status', 'approved')
            ->whereNotNull('marks')
            ->whereNotNull('rank')
            ->orderByRaw("CAST(rank AS UNSIGNED) ASC, marks DESC")
            ->take(3)
            ->get();

        return view('result', compact('searchedStudent', 'searchPerformed', 'errorMessage', 'topWinners'));
    }
}
