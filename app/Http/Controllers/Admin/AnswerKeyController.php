<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnswerKey;
use App\Models\Event;
use App\Models\EventGroup;
use App\Models\Season;
use Illuminate\Support\Str;

class AnswerKeyController extends Controller
{
    public function index(Request $request)
    {
        $query = AnswerKey::with(['event', 'group'])->latest();

        // Filter by Season
        if ($request->filled('season') && $request->season !== 'All') {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('season', $request->season);
            });
        }

        // Filter by Event
        if ($request->filled('event_id') && $request->event_id !== 'All') {
            $query->where('event_id', $request->event_id);
        }

        // Filter by Group
        if ($request->filled('event_group_id') && $request->event_group_id !== 'All') {
            $query->where('event_group_id', $request->event_group_id);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('event', function ($eq) use ($search) {
                      $eq->where('title', 'like', "%{$search}%");
                  })
                  ->orWhereHas('group', function ($gq) use ($search) {
                      $gq->where('group_name', 'like', "%{$search}%");
                  });
            });
        }

        $answerKeys = $query->paginate(15)->withQueryString();

        // Get unique seasons from Season model and Event model
        $seasonModelNames = Season::pluck('name');
        $eventSeasonNames = Event::whereNotNull('season')->where('season', '!=', '')->pluck('season');
        $seasons = $seasonModelNames->merge($eventSeasonNames)->filter()->unique()->values();

        // Events with groups for dynamic chaining
        $events = Event::with('groups')->latest()->get();
        $allGroups = EventGroup::with('event')->get();

        return view('admin.answer-keys.index', compact('answerKeys', 'events', 'seasons', 'allGroups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'season' => 'nullable|string|max:100',
            'event_id' => 'required|exists:events,id',
            'event_group_id' => 'nullable|exists:event_groups,id',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:15360', // 15MB max
            'is_active' => 'nullable|boolean',
        ]);

        $uploadDir = public_path('uploads/answer_keys');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = $request->file('file');
        $filename = 'answerkey_' . time() . '_' . Str::random(6) . '.' . $file->extension();
        $file->move($uploadDir, $filename);

        AnswerKey::create([
            'event_id' => $validated['event_id'],
            'event_group_id' => !empty($validated['event_group_id']) ? $validated['event_group_id'] : null,
            'title' => $validated['title'],
            'file_path' => 'uploads/answer_keys/' . $filename,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Answer Key uploaded successfully.');
    }

    public function toggle(AnswerKey $answerKey)
    {
        $answerKey->update(['is_active' => !$answerKey->is_active]);
        return back()->with('success', 'Answer Key status updated.');
    }

    public function destroy(AnswerKey $answerKey)
    {
        $filePath = public_path($answerKey->file_path);
        if (!empty($answerKey->file_path) && file_exists($filePath)) {
            @unlink($filePath);
        }
        $answerKey->delete();
        return back()->with('success', 'Answer Key deleted successfully.');
    }
}
