<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::with('season');

        if ($request->filled('season_id') && $request->season_id !== 'All') {
            $query->where('season_id', $request->season_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->latest()->paginate(12);

        // Fetch seasons from database
        $seasons = \App\Models\Season::oldest()->get();

        return view('admin.gallery.index', compact('galleries', 'seasons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'season_id' => 'required|exists:seasons,id',
            'image' => 'required|image|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path('uploads/galleries'), $filename);
            $validated['image'] = 'uploads/galleries/' . $filename;
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'New photo added to gallery successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photo deleted successfully!');
    }
}
