<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdmitCardSetting;

class AdmitCardSettingController extends Controller
{
    public function index()
    {
        $setting = AdmitCardSetting::getSettings();
        return view('admin.settings.admit-card', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'header_title' => 'nullable|string|max:255',
            'header_subtitle' => 'nullable|string|max:255',
            'instructions' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'signature' => 'nullable|image|max:2048',
        ]);

        $setting = AdmitCardSetting::getSettings();
        
        $data = [
            'header_title' => $request->header_title,
            'header_subtitle' => $request->header_subtitle,
            'instructions' => $request->instructions,
        ];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'admit_card_logo_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $data['logo_path'] = 'uploads/settings/' . $filename;
        }

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $filename = 'admit_card_signature_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $data['signature_path'] = 'uploads/settings/' . $filename;
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Admit Card Settings updated successfully.');
    }
}
