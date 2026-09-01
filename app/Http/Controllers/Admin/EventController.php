<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }
        
        if ($request->filled('season') && $request->season !== 'All') {
            $query->where('season', $request->season);
        }

        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::oldest()->get();
        $seasons = Season::oldest()->get();

        return view('admin.events.index', compact('events', 'categories', 'seasons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'season' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'reporting_time' => 'nullable|string|max:100',
            'exam_time' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'New event created successfully!');
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'season' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'reporting_time' => 'nullable|string|max:100',
            'exam_time' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        if ($event->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        }
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        } elseif ($request->has('existing_image') && !$request->hasFile('image')) {
            $validated['image'] = $request->existing_image;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }
}
