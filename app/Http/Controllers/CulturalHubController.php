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
            ->approved()
            ->latest();

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
        $culture->load(['submitter', 'lockIns', 'resonances']);
        
        return view('cultural-hub.show', compact('culture'));
    }

    public function create()
    {
        $categories = [
            'Traditional Crafts', 'Oral Traditions', 'Music & Dance', 'Culinary Heritage',
            'Religious Practices', 'Festivals & Ceremonies', 'Language & Literature',
            'Architecture & Design', 'Agricultural Practices', 'Healing Traditions',
            'Social Customs', 'Art & Aesthetics', 'Games & Sports', 'Clothing & Textiles'
        ];

        $endangermentLevels = [
            'Thriving - Actively practiced by many',
            'Stable - Regularly practiced by community',
            'Vulnerable - Practiced by fewer people',
            'Endangered - Few practitioners remain',
            'Critically Endangered - Very few practitioners',
            'Extinct - No longer practiced'
        ];

        return view('cultural-hub.create', compact('categories', 'endangermentLevels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'language' => 'nullable|string',
            'historical_period' => 'nullable|string',
            'significance' => 'nullable|string',
            'rituals' => 'nullable|string',
            'community_role' => 'nullable|string',
            'endangerment_level' => 'nullable|string',
            'current_practitioners' => 'nullable|string',
            'transmission_methods' => 'nullable|string',
            'preservation_efforts' => 'nullable|string',
            'challenges' => 'nullable|string',
            'future_vision' => 'nullable|string',
            'contributors' => 'nullable|array',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|max:10240',
        ]);

        $culture = new Culture($request->all());
        $culture->submitted_by = Auth::id();
        $culture->status = 'pending_review';

        if ($request->hasFile('image')) {
            $culture->image = $request->file('image')->store('cultures', 'public');
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