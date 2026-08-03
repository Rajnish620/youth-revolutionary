<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $competitions = $query->latest()->paginate(10);

        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        return view('admin.competitions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:education,sports,cultural',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'registration_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,upcoming,completed',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);

        Competition::create($validated);

        return redirect()->route('admin.competitions.index')->with('success', 'Competition created successfully!');
    }

    public function edit(Competition $competition)
    {
        return view('admin.competitions.edit', compact('competition'));
    }

    public function update(Request $request, Competition $competition)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:education,sports,cultural',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'registration_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,upcoming,completed',
        ]);

        if ($competition->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        }

        $competition->update($validated);

        return redirect()->route('admin.competitions.index')->with('success', 'Competition updated successfully!');
    }

    public function destroy(Competition $competition)
    {
        $competition->delete();

        return redirect()->route('admin.competitions.index')->with('success', 'Competition deleted successfully!');
    }
}
