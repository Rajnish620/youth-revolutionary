<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    public function index()
    {
        $setting = HomeSetting::getSettings();
        return view('admin.settings.home', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = HomeSetting::getSettings();

        $validated = $request->validate([
            'polaroid_1_text' => 'nullable|string|max:255',
            'polaroid_2_text' => 'nullable|string|max:255',
            'polaroid_3_text' => 'nullable|string|max:255',
            'polaroid_1_image' => 'nullable|image|max:5120',
            'polaroid_2_image' => 'nullable|image|max:5120',
            'polaroid_3_image' => 'nullable|image|max:5120',
        ]);

        $fields = ['polaroid_1_image', 'polaroid_2_image', 'polaroid_3_image'];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                $validated[$field] = 'uploads/settings/' . $filename;
            } else {
                unset($validated[$field]);
            }
        }

        $setting->update($validated);

        return redirect()->back()->with('success', 'Home Page Settings updated successfully!');
    }
}
