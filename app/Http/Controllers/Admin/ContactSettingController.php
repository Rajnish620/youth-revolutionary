<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactSetting;

class ContactSettingController extends Controller
{
    public function index()
    {
        $setting = ContactSetting::getSettings();
        return view('admin.settings.contact', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = ContactSetting::getSettings();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string',
        ]);

        $setting->update($validated);

        return redirect()->back()->with('success', 'Contact settings updated successfully.');
    }
}
