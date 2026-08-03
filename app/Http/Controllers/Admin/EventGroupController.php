<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGroup;
use Illuminate\Http\Request;

class EventGroupController extends Controller
{
    public function index(Request $request)
    {
        $query = EventGroup::with('event');

        if ($request->filled('event_id') && $request->event_id !== 'All') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $query->where('group_name', 'like', '%' . $request->search . '%')
                  ->orWhere('class_range', 'like', '%' . $request->search . '%');
        }

        $groups = $query->latest()->paginate(15);
        $events = Event::all();

        return view('admin.groups.index', compact('groups', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'group_name' => 'required|string|max:255',
            'class_range' => 'nullable|string|max:255',
            'fee' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        EventGroup::create($validated);

        return redirect()->back()->with('success', 'New Event Group & Fee Tier created successfully!');
    }

    public function update(Request $request, EventGroup $group)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'group_name' => 'required|string|max:255',
            'class_range' => 'nullable|string|max:255',
            'fee' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $group->update($validated);

        return redirect()->back()->with('success', 'Event Group updated successfully!');
    }

    public function destroy(EventGroup $group)
    {
        $group->delete();

        return redirect()->back()->with('success', 'Event Group deleted successfully!');
    }
}
