<?php

// app/Http/Controllers/LiveStreamController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveStream;
use Illuminate\Support\Facades\Auth;

class LiveStreamController extends Controller
{
    public function index()
    {
        $liveStreams = LiveStream::where('is_live', true)
            ->whereNull('completed_at')
            ->latest()
            ->get();

        $endedStreams = LiveStream::where('is_live', false)
            ->whereNotNull('completed_at')
            ->where('completed_at', '>=', now()->subHours(12))
            ->latest('completed_at')
            ->get();

        $upcomingStreams = LiveStream::whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now())
            ->whereNull('completed_at')
            ->latest('scheduled_at')
            ->get();

        return view('live-streaming.index', compact('liveStreams', 'upcomingStreams', 'endedStreams'));
    }

    public function show(LiveStream $stream)
    {
        // Viewers enter the room. 
        // A full implementation would check authorization, handle recording, etc.
        return view('live-streaming.show', compact('stream'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:50',
            'thumbnail' => 'nullable|image|max:2048',
            'scheduled_at' => 'nullable|date|after_or_equal:now',
        ]);

        $isScheduled = $request->filled('scheduled_at');

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('stream-thumbnails', 'public');
        }

        $stream = LiveStream::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => Auth::id(),
            'thumbnail' => $thumbnailPath,
            'scheduled_at' => $request->scheduled_at,
            'is_live' => !$isScheduled, // If scheduled, it's not live yet.
        ]);

        if ($isScheduled) {
            return redirect()->route('live-stream.index')->with('success', 'Live stream scheduled successfully!');
        }

        return redirect()->route('live-stream.show', $stream)->with('success', 'You are now live!');
    }

    public function end(LiveStream $stream)
    {
        if ($stream->user_id !== Auth::id()) {
            abort(403);
        }
        $stream->is_live = false;
        $stream->completed_at = now();
        $stream->save();

        return redirect()->route('live-stream.index')->with('success', 'Live stream ended.');
    }

    /**
     * End stream via AJAX/Beacon when user leaves page
     */
    public function ajaxEnd(LiveStream $stream)
    {
        if ($stream->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($stream->is_live) {
            $stream->is_live = false;
            $stream->completed_at = now();
            $stream->save();
        }

        return response()->json(['success' => true]);
    }
}
