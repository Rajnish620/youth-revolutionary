<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGroup;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = EventRegistration::with(['event', 'group']);

        if ($request->filled('season') && $request->season !== 'All') {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('season', $request->season);
            });
        }

        if ($request->filled('event_id') && $request->event_id !== 'All') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('roll_no', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('school_name', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(15);
        
        $seasons = \App\Models\Season::oldest()->get();
        $eventsQuery = Event::query();
        if ($request->filled('season') && $request->season !== 'All') {
            $eventsQuery->where('season', $request->season);
        }
        $events = $eventsQuery->get();

        return view('admin.registrations.index', compact('registrations', 'events', 'seasons'));
    }

    public function approvePayment(EventRegistration $registration)
    {
        $registration->update(['payment_status' => 'approved']);

        return redirect()->back()->with('success', "Payment approved for Roll No: {$registration->roll_no}!");
    }

    public function rejectPayment(EventRegistration $registration)
    {
        $registration->update(['payment_status' => 'rejected']);

        return redirect()->back()->with('success', "Payment rejected for Roll No: {$registration->roll_no}.");
    }

    public function destroy(EventRegistration $registration)
    {
        $registration->delete();

        return redirect()->back()->with('success', 'Student registration deleted successfully.');
    }

    public function signatureSheet(Request $request)
    {
        $eventId = $request->get('event_id');
        $query = EventRegistration::with(['event', 'group'])->where('payment_status', 'approved');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $registrations = $query->orderBy('roll_no', 'asc')->get();
        $event = $eventId ? Event::find($eventId) : null;

        return view('admin.registrations.signature-sheet', compact('registrations', 'event'));
    }

    public function deskSlips(Request $request)
    {
        $eventId = $request->get('event_id');
        $query = EventRegistration::with(['event', 'group'])->where('payment_status', 'approved');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $registrations = $query->orderBy('roll_no', 'asc')->get();
        $event = $eventId ? Event::find($eventId) : null;

        return view('admin.registrations.desk-slips', compact('registrations', 'event'));
    }
}
