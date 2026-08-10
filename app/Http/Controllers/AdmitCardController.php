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

        $html = view('pdf.admit-card', compact('registration', 'setting'))->render();

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Admit_Card_' . $registration->roll_no . '.pdf"'
        ]);
    }
}
