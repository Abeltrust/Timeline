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
        $liveStreams = LiveStream::where('is_live', true)->latest()->get();
        return view('live-streaming.index', compact('liveStreams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:50',
        ]);

        $stream = LiveStream::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('live-stream.index')->with('success', 'Live stream started!');
    }

    public function end(LiveStream $stream)
    {
        $this->authorize('update', $stream); // Only host can end
        $stream->is_live = false;
        $stream->save();

        return redirect()->route('live-stream.index')->with('success', 'Live stream ended.');
    }
}
