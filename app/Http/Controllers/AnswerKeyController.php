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
        
        $registration = EventRegistration::with('event')
            ->where('roll_no', $request->roll_no)
            ->where('dob', $dob)
            ->first();

        if (!$registration) {
            return back()->with('error', 'Invalid Roll Number or Date of Birth. Please try again.');
        }

        // Store registration info in session to allow viewing the answer key
        session(['answer_key_auth' => $registration->id]);

        return redirect()->route('answer-key.view');
    }

    public function view()
    {
        if (!session()->has('answer_key_auth')) {
            return redirect()->route('answer-key.index')->with('error', 'Please verify your details first.');
        }

        $registrationId = session('answer_key_auth');
        $registration = EventRegistration::with('event')->find($registrationId);

        if (!$registration) {
            session()->forget('answer_key_auth');
            return redirect()->route('answer-key.index');
        }

        $answerKeys = AnswerKey::where('event_id', $registration->event_id)
            ->where('is_active', true)
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
