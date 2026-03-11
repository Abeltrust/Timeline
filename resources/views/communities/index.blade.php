@extends('layouts.app')

@section('title', 'Communities')

@section('content')
    <div class="flex flex-col lg:flex-row">
        <main class="flex-1 px-3 sm:px-6 lg:px-8 py-4 sm:py-6 bg-stone-50 dark:bg-stone-950">
            <div class="max-w-6xl mx-auto">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-3 mb-3 sm:mb-6">
                    <div>
                        <h1 class="text-xl sm:text-3xl font-bold text-gray-800 dark:text-stone-100">Communities</h1>
                        <p class="text-gray-600 dark:text-stone-400 text-xs sm:text-sm md:text-base">
                            Connect with like-minded cultural preservationists and heritage enthusiasts.
                        </p>
                    </div>
                    <a href="{{ route('communities.create') }}"
                        class="w-full sm:w-auto text-center px-4 sm:px-5 py-2 sm:py-3 rounded-lg text-sm sm:text-base font-medium bg-gradient-to-r from-amber-500 to-orange-600 text-white hover:from-amber-600 hover:to-orange-700">
                        + Create Community
                    </a>
                </div>

                <!-- Search + Filters -->
                <div class="flex flex-col md:flex-row md:items-center gap-2 sm:gap-3 mt-3 sm:mt-4">
                    <form method="GET" action="{{ route('communities.index') }}" class="flex-1 w-full">
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-stone-400 dark:text-stone-500">
                                <i data-lucide="search" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search communities..."
                                class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 rounded-lg border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-900 text-stone-900 dark:text-stone-100 placeholder-stone-400 dark:placeholder-stone-500 focus:ring-amber-500 focus:border-amber-500 text-sm sm:text-base">
                        </div>
                    </form>

                    <div class="flex flex-wrap gap-1.5 sm:gap-2">
                        <a href="{{ route('communities.index', ['filter' => 'all']) }}"
                            class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium {{ $filter === 'all'
        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white'
        : 'bg-white dark:bg-stone-900 text-stone-600 dark:text-stone-400 border border-stone-200 dark:border-stone-800 hover:border-stone-300 dark:hover:border-stone-700' }}">
                            All
                        </a>
                        <a href="{{ route('communities.index', ['filter' => 'joined']) }}"
                            class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium {{ $filter === 'joined'
        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white'
        : 'bg-white dark:bg-stone-900 text-stone-600 dark:text-stone-400 border border-stone-200 dark:border-stone-800 hover:border-stone-300 dark:hover:border-stone-700' }}">
                            Joined
                        </a>
                        <a href="{{ route('communities.index', ['filter' => 'recommended']) }}"
                            class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium {{ $filter === 'recommended'
        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white'
        : 'bg-white dark:bg-stone-900 text-stone-600 dark:text-stone-400 border border-stone-200 dark:border-stone-800 hover:border-stone-300 dark:hover:border-stone-700' }}">
                            Recommended
                        </a>
                    </div>
                </div>

                <!-- Communities Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5 sm:mt-6">
                    @forelse ($communities as $community)
                        <div
                            class="border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                            <!-- Image -->
                            <div class="h-32 sm:h-40 bg-stone-100 dark:bg-stone-800/50">
                                @if($community->image)
                                    <img src="{{ asset('storage/' . $community->image) }}" alt="{{ $community->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-stone-400 dark:text-stone-600">
                                        <i data-lucide="image" class="w-8 h-8 sm:w-10 sm:h-10"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                                <div class="space-y-1.5 sm:space-y-2">
                                    <h2 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-stone-100">
                                        {{ $community->name }}
                                    </h2>
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-stone-400 line-clamp-2">
                                        {{ $community->description }}
                                    </p>
                                </div>

                                <!-- Stats -->
                                <div
                                    class="mt-3 sm:mt-4 flex flex-wrap items-center justify-between gap-1.5 sm:gap-2 text-[11px] sm:text-sm text-gray-500 dark:text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i> {{ $community->members_count }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                        {{ $community->posts->count() }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        {{ $community->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <!-- Join / Leave / View Buttons -->
                                <div class="mt-3 sm:mt-4 space-y-1.5 sm:space-y-2">
                                    @auth
                                        @if ($community->members->contains(auth()->id()))
                                            <!-- Leave + View -->
                                            <div class="flex gap-1.5 sm:gap-2">
                                                <form action="{{ route('communities.leave', $community) }}" method="POST"
                                                    class="flex-1">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium bg-gradient-to-r from-amber-500 to-orange-600 text-white hover:from-amber-600 hover:to-orange-700">
                                                        Leave
                                                    </button>
                                                </form>

                                                <a href="{{ route('communities.show', $community) }}"
                                                    class="flex-1 px-3 sm:px-4 py-1.5 sm:py-2 text-center rounded-lg text-xs sm:text-sm font-medium border border-amber-500 text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20">
                                                    View
                                                </a>
                                            </div>
                                        @else
                                            <!-- Join -->
                                            <form action="{{ route('communities.join', $community) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium bg-gradient-to-r from-amber-500 to-orange-600 text-white hover:from-amber-600 hover:to-orange-700">
                                                    Join
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm sm:text-base">No communities found.</p>
                    @endforelse
                </div>

                <!-- Trending Communities -->
                <h2 class="text-base sm:text-xl font-bold text-gray-800 dark:text-stone-100 mb-3 sm:mb-4">Recommended for
                    You</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @forelse ($trending as $i => $item)
                        <a href="{{ route('communities.show', $item) }}"
                            class="border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 rounded-lg p-4 sm:p-5 hover:shadow-md transition group">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <span
                                    class="text-lg sm:text-2xl font-bold text-stone-400 dark:text-stone-600 transition-colors group-hover:text-amber-500">#{{ $i + 1 }}</span>
                                <div>
                                    <h3
                                        class="text-sm sm:text-base font-semibold text-gray-800 dark:text-stone-100 group-hover:text-amber-600">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-stone-500">
                                        {{ $item->members_count }} members
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-stone-500 dark:text-stone-500 text-xs sm:text-sm">No trending communities yet.</p>
                    @endforelse
                </div>
            </div>

    </div>
    </main>
    </div>
@endsection