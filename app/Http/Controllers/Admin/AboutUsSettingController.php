<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSetting;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutUsSettingController extends Controller
{
    public function index()
    {
        $setting = AboutUsSetting::getSettings();
        $teamMembers = TeamMember::where('type', 'team')->orderBy('sort_order')->orderBy('id', 'asc')->get();
        $advisors = TeamMember::where('type', 'advisor')->orderBy('sort_order')->orderBy('id', 'asc')->get();
        return view('admin.settings.about-us', compact('setting', 'teamMembers', 'advisors'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'who_we_are_title' => 'required|string|max:255',
            'who_we_are_description' => 'nullable|string',
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'nullable|string',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'nullable|string',
            'stat_1_count' => 'nullable|string|max:50',
            'stat_1_label' => 'nullable|string|max:100',
            'stat_2_count' => 'nullable|string|max:50',
            'stat_2_label' => 'nullable|string|max:100',
            'stat_3_count' => 'nullable|string|max:50',
            'stat_3_label' => 'nullable|string|max:100',
            'stat_4_count' => 'nullable|string|max:50',
            'stat_4_label' => 'nullable|string|max:100',
            'hero_bg_image' => 'nullable|image|max:5120',
            'who_we_are_image' => 'nullable|image|max:5120',
        ]);

        $setting = AboutUsSetting::getSettings();

        if ($request->hasFile('hero_bg_image')) {
            $file = $request->file('hero_bg_image');
            $filename = 'about_hero_bg_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $validated['hero_bg_image'] = 'uploads/settings/' . $filename;
        }

        if ($request->hasFile('who_we_are_image')) {
            $file = $request->file('who_we_are_image');
            $filename = 'about_who_we_are_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/settings'), $filename);
            $validated['who_we_are_image'] = 'uploads/settings/' . $filename;
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.about-us.index')->with('success', 'About Us settings updated successfully!');
    }

    public function storeTeamMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'type' => 'nullable|string|in:team,advisor',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['type'] = $request->input('type', 'team');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'team_' . time() . '_' . rand(100, 999) . '.' . $file->extension();
            $file->move(public_path('uploads/team'), $filename);
            $validated['image'] = 'uploads/team/' . $filename;
        }

        TeamMember::create($validated);

        $msg = $validated['type'] === 'advisor' ? 'Key Leader / Advisor added successfully!' : 'Team member added successfully!';
        return redirect()->route('admin.settings.about-us.index')->with('success', $msg);
    }

    public function updateTeamMember(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'type' => 'nullable|string|in:team,advisor',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['type'] = $request->input('type', $teamMember->type);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'team_' . time() . '_' . rand(100, 999) . '.' . $file->extension();
            $file->move(public_path('uploads/team'), $filename);
            $validated['image'] = 'uploads/team/' . $filename;
        }

        $teamMember->update($validated);

        $msg = $validated['type'] === 'advisor' ? 'Key Leader / Advisor updated successfully!' : 'Team member updated successfully!';
        return redirect()->route('admin.settings.about-us.index')->with('success', $msg);
    }

    public function destroyTeamMember(TeamMember $teamMember)
    {
        $type = $teamMember->type;
        $teamMember->delete();
        $msg = $type === 'advisor' ? 'Key Leader / Advisor deleted successfully!' : 'Team member deleted successfully!';
        return redirect()->route('admin.settings.about-us.index')->with('success', $msg);
    }
}
