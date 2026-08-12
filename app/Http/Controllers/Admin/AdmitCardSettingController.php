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
        $categories = \App\Models\Category::all();
        return view('admin.settings.admit-card', compact('setting', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'header_title' => 'nullable|string|max:255',
            'header_subtitle' => 'nullable|string|max:255',
            'instructions' => 'nullable|string',
            'category_instructions' => 'nullable|array',
            'category_instructions.*' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'signature' => 'nullable|image|max:2048',
        ]);

        $setting = AdmitCardSetting::getSettings();
        
        $data = [
            'header_title' => $request->header_title,
            'header_subtitle' => $request->header_subtitle,
            'instructions' => $request->instructions,
        ];

        // Save category-specific instructions
        if ($request->has('category_instructions')) {
            foreach ($request->category_instructions as $categoryId => $instructionText) {
                \App\Models\Category::where('id', $categoryId)->update([
                    'instructions' => $instructionText
                ]);
            }
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'admit_card_logo_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $data['logo_path'] = 'uploads/settings/' . $filename;
        } elseif ($request->has('remove_logo')) {
            $data['logo_path'] = null;
        }

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $filename = 'admit_card_signature_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $data['signature_path'] = 'uploads/settings/' . $filename;
        } elseif ($request->has('remove_signature')) {
            $data['signature_path'] = null;
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Admit Card Settings updated successfully.');
    }
}
