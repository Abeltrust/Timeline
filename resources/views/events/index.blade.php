{{-- resources/views/events/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Events</h1>

        {{-- Search --}}
        <form action="{{ route('events.index') }}" method="GET" 
              class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search events..."
                   class="flex-1 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none text-sm sm:text-base">
            <button type="submit" 
                    class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-lg shadow text-sm sm:text-base">
                Search
            </button>
        </form>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @php
            $filters = ['all' => 'All', 'attending' => 'Attending', 'hosting' => 'Hosting', 'nearby' => 'Nearby'];
        @endphp
        @foreach ($filters as $key => $label)
            <a href="{{ route('events.index', array_merge(request()->except('page'), ['filter' => $key])) }}"
               class="px-4 py-2 rounded-full text-xs sm:text-sm font-medium 
                      {{ request('filter','all') === $key 
                        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Events Grid --}}
    @if ($events->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5 flex flex-col justify-between">

                    {{-- Event Info --}}
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $event->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($event->description, 100) }}</p>

                        {{-- Details with Lucide Icons --}}
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>{{ $event->date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                                <span>{{ $event->date->format('h:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span>{{ $event->attendees_count }} attending</span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2">
                        <a href="{{ route('events.show', $event) }}" 
                           class="text-sm font-medium text-center sm:text-left text-gray-600 hover:text-orange-600">
                            View Details
                        </a>

                        @if ($event->attendees->contains(auth()->id()))
                            <form action="{{ route('events.leave', $event) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                                    Leave
                                </button>
                            </form>
                        @else
                            <form action="{{ route('events.join', $event) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow hover:from-amber-600 hover:to-orange-700">
                                    Join
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $events->links() }}
        </div>

    @else
        <p class="text-gray-600 text-center">No events found.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons(); // initialize lucide icons
</script>
@endpush
