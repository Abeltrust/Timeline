<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EducationalHubController extends Controller
{
    public function index(Request $request)
    {
        $educationalTypes = ['class', 'training', 'ritual', 'wedding', 'ceremony', 'workshop'];

        $query = Event::with('organizer', 'attendees')
            ->whereIn('type', $educationalTypes)
            ->upcoming()
            ->latest('event_date');

        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        $events = $query->paginate(12);

        // Featured experts/hosts (those with most events or attendees)
        $experts = \App\Models\User::whereHas('events', function($q) use ($educationalTypes) {
            $q->whereIn('type', $educationalTypes);
        })->withCount('events')->orderBy('events_count', 'desc')->take(5)->get();

        return view('education.index', compact('events', 'experts'));
    }
}
