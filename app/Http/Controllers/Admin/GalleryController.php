<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->latest()->paginate(12);

        // Fetch distinct seasons dynamically from database
        $dbSeasons = Gallery::distinct()->pluck('category')->filter()->values()->toArray();
        $defaultSeasons = ['Season 1', 'Season 2', 'Season 3', 'Season 4'];
        $categories = array_unique(array_merge($defaultSeasons, $dbSeasons));

        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'New photo added to gallery successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photo deleted successfully!');
    }
}
