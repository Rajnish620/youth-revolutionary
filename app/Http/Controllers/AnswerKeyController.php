<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\AnswerKey;
use Carbon\Carbon;

class AnswerKeyController extends Controller
{
    public function index()
    {
        return view('answer-key.index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'roll_no' => 'required|string',
            'dob' => 'required|date',
        ]);

        $dob = Carbon::parse($request->dob)->format('Y-m-d');
        $rollNo = trim($request->roll_no);
        
        $registration = EventRegistration::with(['event', 'group'])
            ->where('roll_no', $rollNo)
            ->where('dob', $dob)
            ->first();

        if (!$registration) {
            return back()->withInput()->with('error', 'Invalid Roll Number or Date of Birth. Please verify and try again.');
        }

        // Store registration info in session to allow viewing the answer key
        session(['answer_key_auth' => $registration->id]);

        return redirect()->route('answer-key.view');
    }

    public function view()
    {
        if (!session()->has('answer_key_auth')) {
            return redirect()->route('answer-key.index')->with('error', 'Please verify your Roll Number and DOB first.');
        }

        $registrationId = session('answer_key_auth');
        $registration = EventRegistration::with(['event', 'group'])->find($registrationId);

        if (!$registration) {
            session()->forget('answer_key_auth');
            return redirect()->route('answer-key.index');
        }

        // Fetch answer keys specifically for this event and group (or common/all groups)
        $groupId = $registration->event_group_id;
        $answerKeys = AnswerKey::with(['event', 'group'])
            ->where('event_id', $registration->event_id)
            ->where('is_active', true)
            ->where(function ($q) use ($groupId) {
                if ($groupId) {
                    $q->where('event_group_id', $groupId)
                      ->orWhereNull('event_group_id');
                } else {
                    $q->whereNull('event_group_id');
                }
            })
            ->orderByRaw('CASE WHEN event_group_id IS NOT NULL THEN 0 ELSE 1 END')
            ->latest()
            ->get();

        return view('answer-key.view', compact('registration', 'answerKeys'));
    }

    public function logout()
    {
        session()->forget('answer_key_auth');
        return redirect()->route('answer-key.index');
    }
}
