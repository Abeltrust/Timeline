@extends('layouts.app')

@section('title', 'Discover - Timeline')

@section('content')
<div class="max-w-6xl mx-auto px-3 sm:px-4 py-4 sm:py-6">
    <!-- Header -->
    <div class="mb-4 sm:mb-6 text-center md:text-left">
        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-stone-800">Discover</h1>
        <p class="text-stone-500 text-xs sm:text-sm md:text-base">
            Explore stories, cultures, people, and places from around the world.
        </p>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('discover.index') }}" class="mb-4 sm:mb-6">
        <div class="relative">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <input type="text" name="search" value="{{ $search }}" 
                class="w-full rounded-xl border border-stone-300 pl-10 sm:pl-12 pr-4 py-2 sm:py-3 placeholder-stone-400 text-stone-700 focus:ring-amber-500 focus:border-amber-500 text-sm sm:text-base"
                placeholder="Search">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-stone-400">
                <i data-lucide="search" class="w-4 sm:w-5 h-4 sm:h-5"></i>
            </span>
            <button type="submit" 
                class="absolute inset-y-0 right-0 px-3 sm:px-4 text-stone-500 hover:text-amber-600">
                <i data-lucide="filter" class="w-4 sm:w-5 h-4 sm:h-5"></i>
            </button>
        </div>
    </form>

    <!-- Tabs -->
    <div class="flex flex-wrap gap-1.5 sm:gap-2 md:gap-3 mb-5 sm:mb-6 justify-center md:justify-start">
        @php
            $tabs = ['stories' => 'Stories', 'cultures' => 'Cultures', 'people' => 'People', 'places' => 'Places'];
        @endphp
        @foreach ($tabs as $key => $label)
            <a href="{{ route('discover.index', ['tab' => $key, 'search' => $search]) }}"
               class="px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200
                      {{ $tab === $key 
                          ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white' 
                          : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- Data Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 md:gap-6">
        @forelse ($data as $item)
            @if ($tab === 'stories')
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm overflow-hidden border border-stone-200">
                    <img src="{{ Storage::url($item->image) }}" class="w-full h-36 sm:h-44 md:h-48 object-cover">
                    <div class="p-3 sm:p-4">
                        <span class="inline-block text-[10px] sm:text-xs font-medium bg-amber-100 text-amber-700 px-2 py-0.5 sm:py-1 rounded-full mb-2">
                            {{ $item->category ?? 'Story' }}
                        </span>
                        <h3 class="font-semibold text-stone-800 text-sm sm:text-base line-clamp-2">{{ $item->title ?? Str::limit($item->content, 60) }}</h3>
                        <p class="text-xs sm:text-sm text-stone-500 line-clamp-2">{{ Str::limit($item->content, 80) }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs sm:text-sm text-stone-500">
                            <div class="flex items-center space-x-2">
                                <span class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center rounded-full bg-amber-500 text-white text-[10px] sm:text-xs">
                                    {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                </span>
                                <span class="truncate max-w-[80px] sm:max-w-[100px]">{{ $item->user->name }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i data-lucide="heart" class="w-3.5 sm:w-4 h-3.5 sm:h-4 text-rose-500"></i>
                                <span>{{ $item->taps_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($tab === 'cultures')
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-stone-200 p-3 sm:p-4">
                    <h3 class="font-semibold text-stone-800 text-sm sm:text-base">{{ $item->name }}</h3>
                    <p class="text-xs sm:text-sm text-stone-500">{{ Str::limit($item->description, 80) }}</p>
                </div>
            @elseif ($tab === 'people')
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-stone-200 p-3 sm:p-4 flex items-center space-x-3">
                    <span class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-amber-500 text-white font-bold text-sm sm:text-base">
                        {{ strtoupper(substr($item->name, 0, 1)) }}
                    </span>
                    <div class="overflow-hidden">
                        <h3 class="font-semibold text-stone-800 truncate text-sm sm:text-base">{{ $item->name }}</h3>
                        <p class="text-xs sm:text-sm text-stone-500 truncate">{{ Str::limit($item->bio, 60) }}</p>
                    </div>
                </div>
            @elseif ($tab === 'places')
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                    <div class="p-3 sm:p-4">
                        <h3 class="font-semibold text-stone-800 text-sm sm:text-base">{{ $item->title }}</h3>
                        <p class="text-xs sm:text-sm text-stone-500">{{ $item->location }}</p>
                        <p class="text-[10px] sm:text-xs text-stone-400">By {{ $item->organizer->name }}</p>
                    </div>
                </div>
            @endif
        @empty
            <p class="col-span-full text-center text-stone-500 text-sm">No results found.</p>
        @endforelse
    </div>

    <!-- Trending Stats -->
    <div class="mt-8 sm:mt-10">
        <h2 class="font-semibold text-stone-800 mb-3 sm:mb-4 text-center md:text-left text-sm sm:text-base">Trending This Week</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
            <div class="bg-rose-50 text-rose-600 rounded-lg sm:rounded-xl p-3 sm:p-4 text-center">
                <i data-lucide="heart" class="w-5 h-5 sm:w-6 sm:h-6 mx-auto mb-1 sm:mb-2"></i>
                <p class="text-lg sm:text-xl font-bold">{{ number_format($trendingStats['taps_this_week']) }}</p>
                <p class="text-xs sm:text-sm">TAPs this week</p>
            </div>
            <div class="bg-blue-50 text-blue-600 rounded-lg sm:rounded-xl p-3 sm:p-4 text-center">
                <i data-lucide="users" class="w-5 h-5 sm:w-6 sm:h-6 mx-auto mb-1 sm:mb-2"></i>
                <p class="text-lg sm:text-xl font-bold">{{ number_format($trendingStats['new_connections']) }}</p>
                <p class="text-xs sm:text-sm">New connections</p>
            </div>
            <div class="bg-green-50 text-green-600 rounded-lg sm:rounded-xl p-3 sm:p-4 text-center">
                <i data-lucide="globe" class="w-5 h-5 sm:w-6 sm:h-6 mx-auto mb-1 sm:mb-2"></i>
                <p class="text-lg sm:text-xl font-bold">{{ number_format($trendingStats['cultures_featured']) }}</p>
                <p class="text-xs sm:text-sm">Cultures featured</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endpush
