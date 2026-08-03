<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class MarksCertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = EventRegistration::with(['event', 'group'])->where('payment_status', 'approved');

        if ($request->filled('event_id') && $request->event_id !== 'All') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('roll_no', 'like', "%{$search}%");
            });
        }

        $registrations = $query->orderBy('roll_no', 'asc')->paginate(20);
        $events = Event::all();

        return view('admin.marks.index', compact('registrations', 'events'));
    }

    public function updateMarks(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'marks' => 'nullable|numeric|min:0|max:1000',
            'rank' => 'nullable|string|max:100',
        ]);

        $registration->update($validated);

        return redirect()->back()->with('success', "Marks updated for Roll No: {$registration->roll_no}!");
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

    public function showCertificate($roll_no)
    {
        $registration = EventRegistration::with(['event', 'group'])->where('roll_no', $roll_no)->firstOrFail();

        if (!$registration->certificate_enabled && !auth()->check()) {
            abort(403, 'Certificate has not been released yet for this participant by the Admin.');
        }

        return view('certificate.show', compact('registration'));
    }
}
