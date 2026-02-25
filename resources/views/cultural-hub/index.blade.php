@extends('layouts.app')

@section('title', 'Cultural Hub - Explore Global Heritage')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
        <div
            class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 text-center sm:text-left">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Cultural Hub
                </h2>
                <p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-2xl">
                    Discover, preserve, and celebrate the rich tapestry of global cultures.
                    Every tradition has a story, every heritage deserves preservation.
                </p>
            </div>
            @auth
                <div class="flex-shrink-0">
                    <a href="{{ route('cultural-hub.create') }}"
                        class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        <span>Share Your Culture</span>
                    </a>
                </div>
            @endauth
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center space-x-3">
                    <i data-lucide="check-circle" class="w-5 h-5 transition-colors"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
        </div>

        <!-- Category Filter -->
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-wrap gap-2 sm:gap-3 justify-center sm:justify-start">
                @foreach($categories as $key => $label)
                    <a href="{{ route('cultural-hub.index', ['category' => $key]) }}"
                        class="flex items-center space-x-1.5 sm:space-x-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium transition-all duration-200 {{ $category === $key ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300 hover:shadow-sm' }}">
                        @if($key === 'all')
                            <i data-lucide="globe" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @elseif($key === 'festivals')
                            <i data-lucide="calendar" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @elseif($key === 'traditions')
                            <i data-lucide="book-open" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @elseif($key === 'music')
                            <i data-lucide="music" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @elseif($key === 'heritage')
                            <i data-lucide="map-pin" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @else
                            <i data-lucide="globe" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                        @endif
                        <span>{{ $label }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Cultures Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-10 sm:mb-12">
            @forelse($cultures as $culture)
                <div
                    class="bg-white dark:bg-stone-900 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-stone-100 dark:border-stone-800 flex flex-col h-full transform hover:-translate-y-2">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <!-- Category Badge Over Image -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="backdrop-blur-md bg-stone-900/40 text-white px-3 py-1 rounded-full text-[10px] uppercase tracking-widest font-bold border border-white/20">
                                {{ $culture->category }}
                            </span>
                        </div>

                        @if($culture->image)
                            <img src="{{ Storage::url($culture->image) }}" alt="{{ $culture->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-amber-500/10 to-orange-600/10 flex items-center justify-center">
                                <i data-lucide="globe" class="w-12 h-12 text-amber-600/30"></i>
                            </div>
                        @endif
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="mb-4">
                            <div class="flex items-center space-x-2 text-amber-600 mb-2 uppercase tracking-tighter text-[10px] font-black">
                                <i data-lucide="sparkles" class="w-3 h-3"></i>
                                <span>Cultural Highlight</span>
                            </div>
                            
                            <h3 class="font-extrabold text-stone-900 dark:text-white text-xl mb-2 flex items-center flex-wrap gap-2">
                                {{ $culture->name }}
                                @if($culture->status === 'pending_review')
                                    <span class="text-[9px] bg-amber-500 text-white px-2 py-0.5 rounded-full font-black uppercase tracking-widest animate-pulse">Pending</span>
                                @endif
                            </h3>
                            
                            <div class="flex items-center text-stone-500 dark:text-stone-400 text-xs font-semibold">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 mr-1.5 text-amber-500"></i>
                                {{ $culture->region }}
                            </div>
                        </div>

                        <p class="text-stone-600 dark:text-stone-300 text-sm leading-relaxed mb-6 line-clamp-2 italic flex-1">
                            "{{ $culture->description }}"
                        </p>

                        <div class="pt-6 border-t border-stone-100 dark:border-stone-800 space-y-4">
                            <!-- Guardian Info -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center">
                                         <i data-lucide="user" class="w-3 h-3 text-amber-600"></i>
                                    </div>
                                    <span class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">
                                        {{ $culture->submitter->name ?? 'Guardian' }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3 text-[10px] font-bold text-stone-400 uppercase tracking-widest">
                                    <span class="flex items-center">
                                        <i data-lucide="heart" class="w-3 h-3 mr-1"></i>
                                        {{ $culture->resonance_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <i data-lucide="lock" class="w-3 h-3 mr-1"></i>
                                        {{ $culture->locked_in_count }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-between gap-3">
                                @auth
                                    <button onclick="toggleCultureLockin({{ $culture->id }})" data-culture-lockin="{{ $culture->id }}"
                                        class="flex-1 flex items-center justify-center space-x-2 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 {{ auth()->user()->hasLockedIn($culture) ? 'bg-amber-600 text-white shadow-md' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                                        <i data-lucide="{{ auth()->user()->hasLockedIn($culture) ? 'check' : 'lock' }}" class="w-3.5 h-3.5"></i>
                                        <span>{{ auth()->user()->hasLockedIn($culture) ? 'Locked-In' : 'Lock-In' }}</span>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="flex-1 flex items-center justify-center space-x-2 py-2.5 rounded-xl font-bold text-xs bg-stone-100 text-stone-600 hover:bg-stone-200 transition-all duration-200">
                                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                        <span>Lock-In</span>
                                    </a>
                                @endauth

                                <a href="{{ route('cultural-hub.show', $culture->id) }}" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-sm hover:shadow-lg transition-all duration-200 group/btn">
                                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 sm:py-12">
                    <i data-lucide="globe" class="w-12 h-12 sm:w-16 sm:h-16 text-amber-600 mx-auto mb-3 sm:mb-4"></i>
                    <h3 class="text-base sm:text-lg font-semibold text-stone-600 mb-1 sm:mb-2">No cultures found</h3>
                    <p class="text-stone-500 text-sm sm:text-base mb-3 sm:mb-4">Be the first to share a culture in this
                        category!</p>
                    @auth
                        <a href="{{ route('cultural-hub.create') }}"
                            class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                            Share Your Culture
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                            Join Timeline
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($cultures->hasPages())
            <div class="mb-10 sm:mb-12">
                {{ $cultures->links() }}
            </div>
        @endif

        @guest
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 sm:p-8 mt-4 sm:mt-0">
                <div class="text-center">
                    <i data-lucide="globe" class="w-10 h-10 sm:w-12 sm:h-12 text-amber-600 mx-auto mb-3 sm:mb-4"></i>
                    <h3 class="text-lg sm:text-xl font-bold text-stone-800 mb-1 sm:mb-2">Preserve Your Heritage</h3>
                    <p class="text-stone-600 text-sm sm:text-base mb-5 sm:mb-6">
                        Share your cultural traditions, stories, and practices to help preserve them for future generations.
                    </p>
                    <a href="{{ route('register') }}"
                        class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-sm hover:shadow-md">
                        Join Timeline
                    </a>
                </div>
            </div>
        @endguest
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
@endpush