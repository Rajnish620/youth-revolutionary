<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Season;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::orderBy('name', 'asc')->paginate(15);
        return view('admin.seasons.index', compact('seasons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:seasons,name',
        ]);

        Season::create($validated);
        return redirect()->back()->with('success', 'Season created successfully!');
    }

    public function update(Request $request, Season $season)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:seasons,name,' . $season->id,
        ]);

        $season->update($validated);
        return redirect()->back()->with('success', 'Season updated successfully!');
    }

    public function destroy(Season $season)
    {
        $season->delete();
        return redirect()->back()->with('success', 'Season deleted successfully!');
    }
}
