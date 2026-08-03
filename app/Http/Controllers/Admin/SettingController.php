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
            'qr_code_image' => 'required|string',
            'instructions' => 'nullable|string',
        ]);

        $setting->update($validated);

        return redirect()->back()->with('success', 'Payment Settings & QR Code updated successfully!');
    }
}
