<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CulturalHubController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');

        $query = Culture::with(['submitter', 'lockIns', 'resonances'])
            ->where(function ($q) {
                $q->where('status', 'approved')
                    ->orWhere('status', 'featured');
                if (Auth::check()) {
                    $q->orWhere('submitted_by', Auth::id());
                }
            })
            ->inRandomOrder();

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $cultures = $query->paginate(12);

        $categories = [
            'all' => 'All Cultures',
            'festivals' => 'Festivals',
            'traditions' => 'Traditions',
            'music' => 'Music & Arts',
            'heritage' => 'Heritage Sites',
            'crafts' => 'Traditional Crafts',
            'language' => 'Language & Literature',
        ];

        return view('cultural-hub.index', compact('cultures', 'categories', 'category'));
    }

    public function show(Culture $culture)
    {
        if ($culture->status !== 'approved' && $culture->status !== 'featured') {
            if (!Auth::check() || $culture->submitted_by !== Auth::id()) {
                abort(404);
            }
        }

        $culture->load(['submitter', 'lockIns', 'resonances']);

        return view('cultural-hub.show', compact('culture'));
    }

    public function create()
    {
        $categories = [
            'Traditional Crafts',
            'Oral Traditions',
            'Music & Dance',
            'Culinary Heritage',
            'Religious Practices',
            'Festivals & Ceremonies',
            'Language & Literature',
            'Architecture & Design',
            'Agricultural Practices',
            'Healing Traditions',
            'Social Customs',
            'Art & Aesthetics',
            'Games & Sports',
            'Clothing & Textiles'
        ];

        $licenses = [
            'Public Domain',
            'CC0 (Creative Commons Zero)',
            'CC BY (Attribution)',
            'CC BY-SA (Attribution-ShareAlike)',
            'CC BY-NC (Attribution-NonCommercial)',
            'CC BY-ND (Attribution-NoDerivs)',
            'All Rights Reserved'
        ];

        return view('cultural-hub.create', compact('categories', 'licenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:51200',
            'video_description' => 'nullable|string|max:1000',
            'audio_url' => 'nullable|url',
            'audio_file' => 'nullable|file|mimes:mp3,wav,aac|max:20480',
            'audio_description' => 'nullable|string|max:1000',
            'license_type' => 'nullable|string',
            'license_credit' => 'nullable|string|max:255',
        ]);

        // Custom word count validation for main description
        $wordCount = str_word_count(strip_tags($request->description));
        if ($wordCount < 20) {
            return back()->withInput()->withErrors(['description' => 'Description must be at least 20 words to ensure quality.']);
        }

        $culture = new Culture($request->except(['video_file', 'audio_file']));
        $culture->submitted_by = Auth::id();
        $culture->status = 'pending_review';

        // Handle Image
        if ($request->hasFile('image')) {
            $culture->image = $request->file('image')->store('cultures', 'public');
        }

        // Handle Video File
        if ($request->hasFile('video_file')) {
            $culture->video_path = $request->file('video_file')->store('cultures/videos', 'public');
        }

        // Handle Audio File
        if ($request->hasFile('audio_file')) {
            $culture->audio_path = $request->file('audio_file')->store('cultures/audios', 'public');
        }

        $culture->save();

        // Update user's cultures contributed count
        Auth::user()->increment('cultures_contributed');

        return redirect()->route('cultural-hub.index')
            ->with('success', 'Culture submitted successfully! It will be reviewed before publication.');
    }

    public function lockin(Culture $culture)
    {
        $user = Auth::user();

        $interaction = $user->interactions()
            ->where('interactable_type', Culture::class)
            ->where('interactable_id', $culture->id)
            ->where('type', 'lockin')
            ->first();

        if ($interaction) {
            $interaction->delete();
            $culture->decrement('locked_in_count');
            $lockedIn = false;
        } else {
            $user->interactions()->create([
                'interactable_type' => Culture::class,
                'interactable_id' => $culture->id,
                'type' => 'lockin',
            ]);
            $culture->increment('locked_in_count');
            $lockedIn = true;

            // Create notification
            if ($culture->submitted_by !== $user->id) {
                $culture->submitter->notifications()->create([
                    'from_user_id' => $user->id,
                    'type' => 'lockin',
                    'title' => 'New Lock-In',
                    'message' => $user->name . ' locked-in to ' . $culture->name,
                    'data' => ['culture_id' => $culture->id],
                ]);
            }
        }

        return response()->json([
            'lockedIn' => $lockedIn,
            'count' => $culture->fresh()->locked_in_count,
        ]);
    }
}