{{-- resources/views/live-streaming.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 space-y-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-stone-100">Live Events</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-stone-400">Host and discover real-time cultural
                    experiences.</p>
            </div>
        </div>

        {{-- Start/Schedule Live Stream --}}
        <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-md p-6 sm:p-8 space-y-6 border border-stone-100 dark:border-stone-800"
            x-data="{ mode: 'now' }">

            <!-- Toggle Tabs -->
            <div class="flex items-center gap-4 border-b border-stone-200 dark:border-stone-700 pb-4">
                <button @click="mode = 'now'"
                    :class="mode === 'now' ? 'text-amber-600 dark:text-amber-500 font-bold border-b-2 border-amber-600 dark:border-amber-500 pb-4 -mb-[18px]' : 'text-stone-500 dark:text-stone-400 font-medium hover:text-stone-700 dark:hover:text-stone-300 pb-4 -mb-[18px] transition-colors'">
                    Go Live Now
                </button>
                <button @click="mode = 'schedule'"
                    :class="mode === 'schedule' ? 'text-amber-600 dark:text-amber-500 font-bold border-b-2 border-amber-600 dark:border-amber-500 pb-4 -mb-[18px]' : 'text-stone-500 dark:text-stone-400 font-medium hover:text-stone-700 dark:hover:text-stone-300 pb-4 -mb-[18px] transition-colors'">
                    Schedule for Later
                </button>
            </div>

            <form action="{{ route('live-stream.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1">Event
                                    Title</label>
                                <input type="text" name="title" placeholder="E.g., Traditional Pottery Workshop"
                                    class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 placeholder-stone-400 dark:placeholder-stone-500 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1">Description
                                    (Optional)</label>
                                <textarea name="description" rows="3" placeholder="Tell viewers what to expect..."
                                    class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 placeholder-stone-400 dark:placeholder-stone-500 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none"></textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1">Cover Image (Optional)</label>
                                <div class="relative group cursor-pointer" onclick="document.getElementById('thumbnail-input').click()">
                                    <div class="w-full h-32 border-2 border-dashed border-stone-300 dark:border-stone-700 rounded-xl flex flex-col items-center justify-center bg-stone-50 dark:bg-stone-800/50 group-hover:border-amber-500 transition-colors overflow-hidden">
                                        <div id="thumbnail-preview" class="hidden absolute inset-0">
                                            <img src="" class="w-full h-full object-cover">
                                        </div>
                                        <i data-lucide="image" class="w-8 h-8 text-stone-400 mb-1"></i>
                                        <span class="text-xs text-stone-500">Tap to upload thumbnail</span>
                                    </div>
                                    <input type="file" name="thumbnail" id="thumbnail-input" class="hidden" accept="image/*" 
                                           onchange="const preview = document.getElementById('thumbnail-preview'); const img = preview.querySelector('img'); const reader = new FileReader(); reader.onload = (e) => { img.src = e.target.result; preview.classList.remove('hidden'); }; reader.readAsDataURL(this.files[0]);">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1">Category</label>
                                    <input type="text" name="category" placeholder="E.g., Heritage"
                                        class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                                </div>

                                <div x-show="mode === 'schedule'" x-transition>
                                    <label class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1">Date & Time</label>
                                    <input type="datetime-local" name="scheduled_at"
                                        class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none"
                                        :required="mode === 'schedule'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white font-medium rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                        <i data-lucide="video" class="w-5 h-5"></i>
                        <span x-text="mode === 'now' ? 'Start Broadcast' : 'Schedule Event'"></span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Live Now --}}
        @if($liveStreams->count() > 0)
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-stone-100 mb-4 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                    Live Now
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($liveStreams as $stream)
                        <a href="{{ route('live-stream.show', $stream) }}"
                            class="group block bg-white dark:bg-stone-900 rounded-2xl shadow-sm hover:shadow-md overflow-hidden border border-stone-200 dark:border-stone-800 transition-all duration-200">
                            <div class="relative">
                                @if($stream->thumbnail)
                                    <img src="{{ Storage::url($stream->thumbnail) }}" alt="Stream Thumbnail"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-stone-800 to-black flex items-center justify-center p-6 text-center">
                                        <span class="text-stone-400 font-bold text-lg leading-tight uppercase tracking-widest opacity-40">{{ $stream->title }}</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <span
                                    class="absolute top-3 left-3 bg-red-500 text-white font-bold px-2.5 py-1 rounded-md text-[10px] tracking-wider uppercase flex items-center gap-1.5 shadow-sm">
                                    <i data-lucide="radio" class="w-3 h-3 animate-pulse"></i> LIVE
                                </span>
                                <span
                                    class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm text-white font-medium px-2 py-1 rounded-md text-xs flex items-center gap-1.5">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i> {{ $stream->viewers_count }}
                                </span>
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <h3
                                        class="font-bold text-lg leading-tight line-clamp-1 group-hover:text-amber-400 transition-colors">
                                        {{ $stream->title }}</h3>
                                    <p class="text-xs text-stone-300 mt-1 line-clamp-1">{{ $stream->host->name }}</p>
                                </div>
                            </div>
                        @if($stream->category || $stream->description)
                            <div class="p-4">
                                @if($stream->category)
                                    <span
                                        class="inline-block bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-400 text-xs font-semibold px-2.5 py-1 rounded-md mb-2">{{ $stream->category }}</span>
                                @endif
                                <p class="text-sm text-stone-600 dark:text-stone-400 line-clamp-1">{{ $stream->description }}</p>
                            </div>
                        @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Upcoming Streams --}}
        @if($upcomingStreams->count() > 0)
            <div class="pt-4 border-t border-stone-200 dark:border-stone-800">
                <h2 class="text-xl font-bold text-gray-800 dark:text-stone-100 mb-4 flex items-center gap-2">
                    <i data-lucide="calendar-clock" class="w-5 h-5 text-amber-500"></i>
                    Upcoming Events
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($upcomingStreams as $stream)
                        <div
                            class="flex flex-col sm:flex-row gap-4 bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-stone-200 dark:border-stone-800 p-4 hover:shadow-md transition-all">
                            <div
                                class="w-full sm:w-32 h-32 sm:h-auto rounded-xl overflow-hidden shrink-0 bg-stone-100 dark:bg-stone-800">
                                @if($stream->thumbnail)
                                    <img src="{{ Storage::url($stream->thumbnail) }}" alt="Stream Thumbnail"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center p-2 text-center bg-stone-50 dark:bg-stone-800/50">
                                        <span class="text-[10px] text-stone-400 font-bold uppercase tracking-tighter">{{ $stream->title }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 flex flex-col justify-center">
                                <div class="flex justify-between items-start gap-2 mb-1">
                                    <h3 class="font-bold text-gray-800 dark:text-stone-100 text-lg leading-tight">
                                        {{ $stream->title }}</h3>
                                    <span
                                        class="shrink-0 bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-400 px-2.5 py-1 text-xs font-semibold rounded-md border border-stone-200 dark:border-stone-700">
                                        {{ $stream->scheduled_at->format('M d, g:i A') }}
                                    </span>
                                </div>
                                <p class="text-sm text-stone-500 dark:text-stone-400 mb-2">Hosted by <span
                                        class="font-medium text-stone-700 dark:text-stone-300">{{ $stream->host->name }}</span></p>
                                <p class="text-sm text-stone-600 dark:text-stone-300 line-clamp-2 mb-3">{{ $stream->description }}
                                </p>
                                @if($stream->category)
                                    <div class="mt-auto">
                                        <span
                                            class="inline-block bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-400 text-[11px] font-semibold px-2 py-0.5 rounded">{{ $stream->category }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Empty State --}}
        @if($liveStreams->count() === 0 && $upcomingStreams->count() === 0)
            <div class="text-center py-12 px-4 border rounded-2xl border-dashed border-stone-300 dark:border-stone-700">
                <div
                    class="w-16 h-16 bg-stone-100 dark:bg-stone-800 rounded-full flex items-center justify-center mx-auto mb-4 text-stone-400 dark:text-stone-500">
                    <i data-lucide="video-off" class="w-8 h-8"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-stone-100 mb-1">No Events Found</h3>
                <p class="text-stone-500 dark:text-stone-400 text-sm max-w-sm mx-auto">There are no live broadcasts or scheduled
                    events right now. Be the first to start one!</p>
            </div>
        @endif
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => { lucide.createIcons() });
    </script>
@endsection