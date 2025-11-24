<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Key metrics
        $stats = [
            'total_stories' => $user->posts()->count(),
            'taps_received' => $user->posts()->sum('taps_count'),
            'locked_in_connections' => $user->interactions()->where('type', 'lockin')->count(),
            'story_views' => $user->posts()->sum('resonance_count') * 10, // Estimated
            'resonance_points' => $user->posts()->sum('resonance_count'),
            'cultural_contributions' => $user->cultures()->count(),
        ];

        // Top performing stories
        $topStories = $user->posts()
            ->select('id', 'content', 'taps_count', 'resonance_count', 'created_at')
            ->orderBy('taps_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function($post) {
                return [
                    'title' => substr($post->content, 0, 50) . '...',
                    'taps' => $post->taps_count,
                    'resonance' => $post->resonance_count,
                    'views' => $post->resonance_count * 10, // Estimated
                    'date' => $post->created_at->diffForHumans(),
                ];
            });

        // Cultural impact
        $culturalImpact = $user->cultures()
            ->select('name', 'locked_in_count', 'resonance_count')
            ->orderBy('locked_in_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function($culture) {
                return [
                    'culture' => $culture->name,
                    'contributions' => 1, // Each culture is one contribution
                    'resonance' => $culture->resonance_count,
                ];
            });

        // Heritage preservation score (calculated based on various factors)
        $preservationScore = min(100, (
            ($stats['cultural_contributions'] * 10) +
            ($stats['total_stories'] * 0.5) +
            ($stats['resonance_points'] * 0.1)
        ));

        // Monthly engagement data (last 6 months)
        $monthlyData = $user->posts()
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as posts'),
                DB::raw('SUM(taps_count) as taps'),
                DB::raw('SUM(resonance_count) as resonance')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('analytics.index', compact(
            'stats', 
            'topStories', 
            'culturalImpact', 
            'preservationScore',
            'monthlyData'
        ));
    }
}