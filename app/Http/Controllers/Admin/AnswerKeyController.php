<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnswerKey;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnswerKeyController extends Controller
{
    public function index()
    {
        $answerKeys = AnswerKey::with('event')->latest()->get();
        $events = Event::latest()->get();
        return view('admin.answer-keys.index', compact('answerKeys', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            'is_active' => 'boolean',
        ]);

        $file = $request->file('file');
        $filename = 'answerkey_' . time() . '_' . Str::random(5) . '.' . $file->extension();
        $file->move(public_path('uploads/answer_keys'), $filename);

        AnswerKey::create([
            'event_id' => $validated['event_id'],
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
        if (file_exists(public_path($answerKey->file_path))) {
            unlink(public_path($answerKey->file_path));
        }
        $answerKey->delete();
        return back()->with('success', 'Answer Key deleted successfully.');
    }
}
