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
                $q->where('payment_status', 'approved')->where(function ($sub) {
                    $sub->whereNotNull('marks')->orWhereNotNull('is_qualified');
                });
            },
            'registrations as certificates_enabled_count' => function ($q) {
                $q->where('payment_status', 'approved')->where('certificate_enabled', true);
            },
        ])->orderBy('id', 'desc')->get();

        // Distinct non-empty seasons
        $seasons = $events->pluck('season')->filter()->unique()->values();

        // Query Registrations
        $query = EventRegistration::with(['event', 'group'])->where('payment_status', 'approved');

        if ($request->filled('season') && $request->season !== 'All') {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('season', $request->season);
            });
        }

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
                $query->where(function ($q) {
                    $q->whereNotNull('marks')->orWhereNotNull('is_qualified');
                });
            } elseif ($request->status_filter === 'without_marks') {
                $query->whereNull('marks')->whereNull('is_qualified');
            } elseif ($request->status_filter === 'qualified') {
                $query->where(function ($q) {
                    $q->where('is_qualified', true)
                      ->orWhere(function ($sub) {
                          $sub->whereNotNull('marks')
                              ->whereHas('event', function ($eq) {
                                  $eq->whereRaw('event_registrations.marks >= events.cutoff_marks');
                              });
                      });
                });
            } elseif ($request->status_filter === 'not_qualified') {
                $query->where(function ($q) {
                    $q->where('is_qualified', false)
                      ->orWhere(function ($sub) {
                          $sub->whereNotNull('marks')
                              ->whereHas('event', function ($eq) {
                                  $eq->whereRaw('event_registrations.marks < events.cutoff_marks');
                              });
                      });
                });
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

        $setting = AdmitCardSetting::getSettings();

        return view('admin.marks.index', compact(
            'registrations',
            'events',
            'seasons',
            'totalApproved',
            'eventsWithMarks',
            'eventsWithCertificates',
            'totalCertsEnabled',
            'setting'
        ));
    }

    public function updateEventSettings(Request $request, Event $event)
    {
        $validated = $request->validate([
            'show_marks' => 'nullable|boolean',
            'show_certificate' => 'nullable|boolean',
            'evaluation_type' => 'nullable|string|in:marks,qualify_only',
            'total_questions' => 'nullable|integer|min:0|max:1000',
            'marks_per_question' => 'nullable|numeric|min:0|max:1000',
            'negative_marks' => 'nullable|numeric|min:0|max:100',
            'total_marks' => 'nullable|numeric|min:0|max:10000',
            'cutoff_marks' => 'nullable|numeric|min:0|max:10000',
            'marking_scheme_notes' => 'nullable|string|max:2000',
        ]);

        $validated['show_marks'] = $request->boolean('show_marks');
        $validated['show_certificate'] = $request->boolean('show_certificate');
        $validated['evaluation_type'] = $request->input('evaluation_type', 'marks') ?: 'marks';

        $event->update($validated);

        return redirect()->back()->with('success', "Scoring & Publication settings updated for event: {$event->title}!");
    }

    public function updateMarks(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'marks' => 'nullable|numeric|min:0|max:10000',
            'is_qualified' => 'nullable|in:0,1,true,false',
            'rank' => 'nullable|string|max:100',
            'correct_answers' => 'nullable|integer|min:0|max:1000',
            'wrong_answers' => 'nullable|integer|min:0|max:1000',
        ]);

        if ($request->has('is_qualified')) {
            $val = $request->input('is_qualified');
            $validated['is_qualified'] = ($val === '' || $val === null) ? null : (bool)$val;
        }

        // Auto-activate certificate when marks or qualified status is entered
        if ($request->filled('marks') || $request->input('is_qualified') == '1' || $request->input('is_qualified') === true) {
            $validated['certificate_enabled'] = true;
        }

        $registration->update($validated);

        return redirect()->back()->with('success', "Evaluation saved for {$registration->student_name} (Roll: {$registration->roll_no})! Certificate activated.");
    }

    public function toggleQualification(Request $request, EventRegistration $registration)
    {
        // 1. Direct reset or explicit status action
        if ($request->has('action') && $request->input('action') === 'reset') {
            $newStatus = null;
        } elseif ($request->filled('status')) {
            $reqStatus = $request->input('status');
            if ($reqStatus === 'qualified' || $reqStatus === '1') {
                $newStatus = true;
            } elseif ($reqStatus === 'not_qualified' || $reqStatus === '0') {
                $newStatus = false;
            } else {
                $newStatus = null;
            }
        } else {
            // 2. 3-State Cycle: null (Pending / Set Status) -> true (QUALIFIED) -> false (NOT QUALIFIED) -> null (Set Status)
            if ($registration->is_qualified === null) {
                $newStatus = true;
            } elseif ($registration->is_qualified === true) {
                $newStatus = false;
            } else {
                $newStatus = null;
            }
        }

        $data = ['is_qualified' => $newStatus];
        if ($newStatus === true) {
            $data['certificate_enabled'] = true;
        } else {
            // If Not Qualified or reset to Pending (Set Status), disable certificate
            $data['certificate_enabled'] = false;
        }

        $registration->update($data);

        if ($newStatus === true) {
            $statusText = 'QUALIFIED (Certificate Active)';
        } elseif ($newStatus === false) {
            $statusText = 'NOT QUALIFIED';
        } else {
            $statusText = 'SET STATUS (Pending)';
        }

        return redirect()->back()->with('success', "Status updated to {$statusText} for Roll No: {$registration->roll_no} ({$registration->student_name}).");
    }

    public function bulkQualificationToggle(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $eventId = $request->input('event_id');
        $season = $request->input('season');
        $status = $request->input('status'); // 'qualified', 'not_qualified', or 'pending'

        $query = EventRegistration::where('payment_status', 'approved');

        if (!empty($selectedIds)) {
            if (is_string($selectedIds)) {
                $selectedIds = array_filter(explode(',', $selectedIds));
            }
            $query->whereIn('id', (array)$selectedIds);
        } else {
            if ($eventId && $eventId !== 'All') {
                $query->where('event_id', $eventId);
            } elseif ($season && $season !== 'All') {
                $query->whereHas('event', function ($q) use ($season) {
                    $q->where('season', $season);
                });
            }
        }

        $val = null;
        $updateData = [];
        if ($status === 'qualified') {
            $val = true;
            $statusText = 'QUALIFIED';
            $updateData['is_qualified'] = true;
            $updateData['certificate_enabled'] = true;
        } elseif ($status === 'not_qualified') {
            $val = false;
            $statusText = 'NOT QUALIFIED';
            $updateData['is_qualified'] = false;
            $updateData['certificate_enabled'] = false;
        } else {
            $val = null;
            $statusText = 'SET STATUS (PENDING)';
            $updateData['is_qualified'] = null;
            $updateData['certificate_enabled'] = false;
        }

        $count = $query->update($updateData);

        return redirect()->back()->with('success', "Updated {$count} candidate(s) to {$statusText}!");
    }

    public function toggleCertificate(EventRegistration $registration)
    {
        $registration->update([
            'certificate_enabled' => !$registration->certificate_enabled,
        ]);

        $status = $registration->certificate_enabled ? 'ENABLED (ACTIVE)' : 'DISABLED';
        return redirect()->back()->with('success', "Certificate {$status} for Roll No: {$registration->roll_no}.");
    }

    public function toggleStudentLive(EventRegistration $registration)
    {
        $event = $registration->event;
        $currentlyLive = ($event && $event->show_marks && $event->show_certificate && $registration->certificate_enabled);

        if (!$currentlyLive) {
            // Make Live: Ensure event has show_marks & show_certificate = true, and student has certificate_enabled = true
            if ($event) {
                $event->update([
                    'show_marks' => true,
                    'show_certificate' => true,
                ]);
            }
            $registration->update(['certificate_enabled' => true]);
            return redirect()->back()->with('success', "Roll No {$registration->roll_no} ({$registration->student_name}) is now 100% LIVE on website! Marksheet & Certificate can be downloaded.");
        } else {
            // Take Offline
            $registration->update(['certificate_enabled' => false]);
            return redirect()->back()->with('success', "Certificate & Live access for Roll No {$registration->roll_no} set to OFFLINE.");
        }
    }

    public function bulkCertificateToggle(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $eventId = $request->input('event_id');
        $season = $request->input('season');
        $enable = $request->input('enable') == '1';

        $query = EventRegistration::where('payment_status', 'approved');

        if (!empty($selectedIds)) {
            if (is_string($selectedIds)) {
                $selectedIds = array_filter(explode(',', $selectedIds));
            }
            $query->whereIn('id', (array)$selectedIds);
        } else {
            if ($eventId && $eventId !== 'All') {
                $query->where('event_id', $eventId);
            } elseif ($season && $season !== 'All') {
                $query->whereHas('event', function ($q) use ($season) {
                    $q->where('season', $season);
                });
            }
        }

        $count = $query->update(['certificate_enabled' => $enable]);

        // If enabling certificates and making live, also ensure events have show_marks and show_certificate enabled
        if ($enable) {
            $eventQuery = Event::query();
            if (!empty($selectedIds)) {
                $eventIds = EventRegistration::whereIn('id', (array)$selectedIds)->pluck('event_id')->unique();
                $eventQuery->whereIn('id', $eventIds);
            } elseif ($eventId && $eventId !== 'All') {
                $eventQuery->where('id', $eventId);
            } elseif ($season && $season !== 'All') {
                $eventQuery->where('season', $season);
            }
            $eventQuery->update([
                'show_marks' => true,
                'show_certificate' => true,
            ]);
        }

        $status = $enable ? 'ENABLED & LIVE ON WEBSITE' : 'DISABLED';
        return redirect()->back()->with('success', "Certificates {$status} for {$count} participant(s)!");
    }

    public function publishEventLive(Request $request)
    {
        $eventId = $request->input('event_id');
        $season = $request->input('season');
        $isLive = $request->input('is_live', 1) == 1;

        $eventQuery = Event::query();
        if ($eventId && $eventId !== 'All') {
            $eventQuery->where('id', $eventId);
        } elseif ($season && $season !== 'All') {
            $eventQuery->where('season', $season);
        }

        $events = $eventQuery->get();

        if ($events->isEmpty()) {
            return redirect()->back()->with('error', 'Please select a specific Event or Season to publish.');
        }

        foreach ($events as $event) {
            $event->update([
                'show_marks' => $isLive,
                'show_certificate' => $isLive,
            ]);

            if ($isLive) {
                // Auto-enable certificate for all students in this event who have marks or are qualified
                EventRegistration::where('event_id', $event->id)
                    ->where('payment_status', 'approved')
                    ->where(function ($q) {
                        $q->whereNotNull('marks')
                          ->orWhere('is_qualified', true);
                    })
                    ->update(['certificate_enabled' => true]);
            }
        }

        $statusStr = $isLive ? '100% LIVE on Website! Students can now check Result with Roll No & DOB.' : 'OFFLINE (Hidden from Website Search)';
        $eventNames = $events->pluck('title')->implode(', ');

        return redirect()->back()->with('success', "Event [{$eventNames}] is now {$statusStr}");
    }

    public function updateCertificateSettings(Request $request)
    {
        $request->validate([
            'president_name' => 'nullable|string|max:150',
            'president_role' => 'nullable|string|max:100',
            'secretary_name' => 'nullable|string|max:150',
            'secretary_role' => 'nullable|string|max:100',
            'seal' => 'nullable|image|max:2048',
            'remove_seal' => 'nullable',
        ]);

        $setting = AdmitCardSetting::getSettings();
        $setting->president_name = $request->input('president_name');
        $setting->president_role = $request->input('president_role');
        $setting->secretary_name = $request->input('secretary_name');
        $setting->secretary_role = $request->input('secretary_role');

        if ($request->hasFile('seal')) {
            $file = $request->file('seal');
            $filename = 'official_seal_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $setting->seal_path = 'uploads/settings/' . $filename;
        } elseif ($request->boolean('remove_seal') || $request->input('remove_seal') === '1') {
            $setting->seal_path = null;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Marksheet & Certificate settings updated successfully! Stamp and Signatures have been updated.');
    }

    public function showMarksheet($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        // If not logged in admin, enforce event's publication rule
        if (!auth()->check()) {
            if (!$registration->event || !$registration->event->show_marks) {
                abort(403, 'Marksheet has not been published yet for this event by the Administrator.');
            }
            $isQualifyOnly = ($registration->event->evaluation_type ?? 'marks') === 'qualify_only';
            if ($isQualifyOnly) {
                if ($registration->is_qualified === null) {
                    abort(404, 'Evaluation status has not yet been declared for this candidate.');
                }
            } else {
                if ($registration->marks === null) {
                    abort(404, 'Marks have not yet been uploaded for this candidate.');
                }
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
            $isQualifyOnly = ($registration->event->evaluation_type ?? 'marks') === 'qualify_only';
            if ($isQualifyOnly) {
                if ($registration->is_qualified === null) {
                    abort(404, 'Evaluation status has not yet been declared for this candidate.');
                }
            } else {
                if ($registration->marks === null) {
                    abort(404, 'Marks have not yet been uploaded for this candidate.');
                }
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
