<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        // 1. Regular Events Query
        $eventQuery = Event::with(['organizer', 'attendees'])
            ->upcoming()
            ->latest('event_date');

        // 2. Fetch Live Streams for the "Live Now" section
        $liveStreams = \App\Models\LiveStream::where('is_live', true)
            ->whereNull('completed_at')
            ->with('host')
            ->latest()
            ->get();

        // 3. Fetch Upcoming Streams for the "Upcoming Events" listing
        $upcomingStreams = \App\Models\LiveStream::whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now())
            ->whereNull('completed_at')
            ->with('host')
            ->latest('scheduled_at')
            ->get();

        switch ($filter) {
            case 'attending':
                if (Auth::check()) {
                    $eventQuery->whereHas('attendees', function ($q) {
                        $q->where('user_id', Auth::id());
                    });
                }
                break;
            case 'hosting':
                if (Auth::check()) {
                    $eventQuery->where('organizer_id', Auth::id());
                }
                break;
            case 'nearby':
                // Location filtering mock
                break;
        }

        $events = $eventQuery->paginate(12);

        return view('events.index', compact('events', 'liveStreams', 'upcomingStreams', 'filter'));
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'attendees']);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'type' => 'required|in:workshop,conference,cultural,exhibition',
            'max_attendees' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_online' => 'boolean',
            'meeting_link' => 'nullable|url',
            'requirements' => 'nullable|array',
            'image' => 'nullable|image|max:10240',
        ]);

        $event = new Event($request->all());
        $event->organizer_id = Auth::id();

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    public function join(Event $event)
    {
        $user = Auth::user();

        if ($event->isFull()) {
            return response()->json(['error' => 'Event is full'], 400);
        }

        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Already registered'], 400);
        }

        $event->attendees()->attach($user->id);
        $event->increment('attendees_count');

        // Create notification for organizer
        if ($event->organizer_id !== $user->id) {
            $event->organizer->notifications()->create([
                'from_user_id' => $user->id,
                'type' => 'event',
                'title' => 'New Event Registration',
                'message' => $user->name . ' registered for ' . $event->title,
                'data' => ['event_id' => $event->id],
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function leave(Event $event)
    {
        $user = Auth::user();

        $event->attendees()->detach($user->id);
        $event->decrement('attendees_count');

        return response()->json(['success' => true]);
    }
}