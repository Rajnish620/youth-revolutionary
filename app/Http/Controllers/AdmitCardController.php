<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\AdmitCardSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmitCardController extends Controller
{
    public function index()
    {
        return view('admit-card');
    }

    public function download(Request $request)
    {
        $request->validate([
            'registration_no' => 'required|string',
            'dob' => 'required|date',
        ]);

        $registration = EventRegistration::with(['event', 'group'])
            ->where('registration_no', $request->registration_no)
            ->where('dob', $request->dob)
            ->first();

        if (!$registration) {
            return back()->with('error', 'No registration found with this Registration Number and Date of Birth.');
        }

        if ($registration->payment_status !== 'approved') {
            return back()->with('error', 'Your registration is not yet approved. Please try again later.');
        }

        if (!$registration->is_admit_card_allowed) {
            return back()->with('error', 'Admit card generation is not yet allowed for your registration. Please check back later.');
        }

        $setting = AdmitCardSetting::first();
        if (!$setting) {
            return back()->with('error', 'Admit card settings have not been configured by the admin yet.');
        }

        $pdf = Pdf::setOptions(['isRemoteEnabled' => true])->loadView('pdf.admit-card', compact('registration', 'setting'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Admit_Card_' . $registration->roll_no . '.pdf');
    }
}
