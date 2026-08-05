<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = PaymentSetting::getSettings();
        return view('admin.settings.payment', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = PaymentSetting::getSettings();

        $validated = $request->validate([
            'upi_id' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'qr_code_image' => 'nullable|image|max:5120',
            'instructions' => 'nullable|string',
        ]);

        if ($request->hasFile('qr_code_image')) {
            $file = $request->file('qr_code_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $validated['qr_code_image'] = 'uploads/settings/' . $filename;
        } else {
            // Remove qr_code_image from validated array to keep existing if not uploaded
            unset($validated['qr_code_image']);
        }

        $setting->update($validated);

        return redirect()->back()->with('success', 'Payment Settings & QR Code updated successfully!');
    }
}
