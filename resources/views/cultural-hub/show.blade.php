@extends('layouts.app')

@section('title', $culture->name . ' - Cultural Hub')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Breadcrumbs & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-2 text-stone-500 text-sm">
                <a href="{{ route('cultural-hub.index') }}"
                    class="hover:text-amber-600 transition-colors uppercase tracking-widest font-bold text-[10px]">Cultural
                    Hub</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-amber-800 font-bold uppercase tracking-widest text-[10px]">{{ $culture->name }}</span>
            </div>

            <div class="flex items-center space-x-3">
                @if($culture->status === 'pending_review')
                    <span
                        class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest flex items-center shadow-sm border border-amber-200">
                        <i data-lucide="clock" class="w-3.5 h-3.5 mr-2"></i>
                        Pending Review
                    </span>
                @endif

                @auth
                    <button onclick="toggleCultureLockin({{ $culture->id }})" data-culture-lockin="{{ $culture->id }}"
                        class="px-6 py-2 rounded-xl font-bold text-xs transition-all duration-300 {{ auth()->user()->hasLockedIn($culture) ? 'bg-amber-600 text-white shadow-lg' : 'bg-white text-amber-600 border border-amber-200 hover:bg-amber-50' }} flex items-center space-x-2">
                        <i data-lucide="{{ auth()->user()->hasLockedIn($culture) ? 'check' : 'lock' }}" class="w-4 h-4"></i>
                        <span>{{ auth()->user()->hasLockedIn($culture) ? 'Locked-In' : 'Lock-In Presence' }}</span>
                    </button>
                @endauth
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
            <!-- Main Content (Left Column) -->
            <div class="lg:col-span-2 space-y-16">
                <!-- Hero Card -->
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-4 border-amber-100/50 group">
                    @if($culture->image)
                        <img src="{{ Storage::url($culture->image) }}" alt="{{ $culture->name }}"
                            class="w-full h-[450px] sm:h-[550px] object-cover">
                        @if($culture->license_credit)
                            <div
                                class="absolute bottom-6 right-6 backdrop-blur-md bg-stone-900/40 text-white/90 px-4 py-1.5 rounded-xl text-[10px] uppercase tracking-widest font-black border border-white/20">
                                &copy; {{ $culture->license_credit }}
                                @if($culture->license_type) • {{ $culture->license_type }} @endif
                            </div>
                        @endif
                    @else
                        <div
                            class="w-full h-[450px] sm:h-[550px] bg-gradient-to-br from-amber-500/10 to-orange-600/10 flex items-center justify-center">
                            <i data-lucide="globe" class="w-32 h-32 text-amber-600/20"></i>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/90 via-transparent to-transparent"></div>

                    <div class="absolute bottom-10 left-10 right-10 text-white">
                        <span
                            class="inline-block bg-amber-500 text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6 shadow-lg shadow-amber-500/40">
                            {{ $culture->category }}
                        </span>
                        <h1 class="text-5xl sm:text-6xl font-black mb-3 tracking-tighter">{{ $culture->name }}</h1>
                        <div class="flex items-center text-stone-300 font-bold uppercase tracking-widest text-xs">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-amber-500"></i>
                            {{ $culture->region }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose prose-stone prose-lg max-w-none">
                    <div
                        class="flex items-center space-x-2 text-amber-600 mb-8 uppercase tracking-widest text-xs font-black">
                        <i data-lucide="scroll" class="w-5 h-5"></i>
                        <span>Tale of the Ancestors</span>
                    </div>
                    <p
                        class="text-stone-700 dark:text-stone-300 leading-relaxed text-2xl font-black italic mb-10 border-l-8 border-amber-500 pl-8 py-4 bg-amber-50/30 dark:bg-amber-950/10 rounded-r-3xl">
                        "{{ $culture->description }}"
                    </p>
                    <div class="text-stone-600 dark:text-stone-400 space-y-6 leading-loose font-medium">
                        <p>This cultural legacy, rooted in {{ $culture->region }}, serves as a vibrant pulse of identity for
                            its people. It encompasses the wisdom, artistry, and spirituality passed down through centuries,
                            now preserved in this digital vault for global appreciation and future generations.</p>
                    </div>
                </div>

                <!-- Cinematic Visual Gallery -->
                @if($culture->media_files && count($culture->media_files) > 0)
                    <div class="space-y-8" x-data="{ activeImage: '{{ Storage::url($culture->media_files[0]) }}' }">
                        <div class="flex items-center space-x-3 text-amber-600 uppercase tracking-widest text-xs font-black">
                            <i data-lucide="gallery-thumbnails" class="w-5 h-5"></i>
                            <span>Visual Journey Gallery</span>
                        </div>

                        <div
                            class="relative aspect-[16/10] rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-amber-100 group">
                            <img :src="activeImage" class="w-full h-full object-cover transition-all duration-700"
                                id="mainGalleryImage">
                            <div
                                class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-10 opacity-0 group-hover:opacity-100 transition-opacity">
                                <p class="text-white font-bold text-sm">Gallery Preview</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-5 gap-4">
                            @foreach($culture->media_files as $file)
                                <button @click="activeImage = '{{ Storage::url($file) }}'"
                                    class="aspect-square rounded-2xl overflow-hidden border-2 transition-all duration-300 transform hover:scale-105 shadow-sm"
                                    :class="activeImage === '{{ Storage::url($file) }}' ? 'border-amber-500 ring-4 ring-amber-500/20' : 'border-stone-100 hover:border-amber-200'">
                                    <img src="{{ Storage::url($file) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Video highlight: Embedded player -->
                @if($culture->video_url || $culture->video_path)
                    <div class="space-y-8 pt-16 border-t border-amber-100">
                        <div class="flex items-center justify-between">
                            <div
                                class="flex items-center space-x-3 text-amber-600 uppercase tracking-widest text-sm font-black">
                                <i data-lucide="play-circle" class="w-6 h-6"></i>
                                <span>Cinematic Artifact</span>
                            </div>
                        </div>

                        <div
                            class="relative rounded-[2.5rem] overflow-hidden shadow-2xl bg-stone-900 aspect-video border-4 border-amber-500/20 group">
                            @if($culture->video_path)
                                <video controls class="w-full h-full">
                                    <source src="{{ Storage::url($culture->video_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <iframe class="w-full h-full" src="{{ $culture->video_url }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            @endif
                        </div>

                        @if($culture->video_description)
                            <div
                                class="bg-amber-50/50 dark:bg-stone-900/50 p-8 rounded-3xl border border-amber-100 dark:border-stone-800">
                                <p class="text-stone-600 dark:text-stone-400 text-sm leading-relaxed font-bold italic">
                                    <i data-lucide="info" class="w-4 h-4 mb-2 opacity-30"></i>
                                    {{ $culture->video_description }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Audio Archive Section -->
                @if($culture->audio_path || $culture->audio_url)
                    <div class="space-y-8 pt-16 border-t border-amber-100">
                        <div class="flex items-center space-x-3 text-orange-600 uppercase tracking-widest text-sm font-black">
                            <i data-lucide="mic-2" class="w-6 h-6"></i>
                            <span>Audio Archive</span>
                        </div>

                        <div
                            class="rounded-[2.5rem] p-10 bg-gradient-to-br from-stone-900 to-stone-800 shadow-2xl border-4 border-amber-500/20 relative overflow-hidden">
                            <!-- Decorative Waveform -->
                            <div class="absolute bottom-0 left-0 right-0 h-32 opacity-10 flex items-end space-x-1 px-10">
                                @for($i = 0; $i < 40; $i++)
                                    <div class="bg-amber-500 w-full" style="height: {{ rand(20, 100) }}%"></div>
                                @endfor
                            </div>

                            <div
                                class="relative z-10 flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-8">
                                <div
                                    class="w-24 h-24 bg-amber-500 rounded-3xl flex items-center justify-center shadow-2xl shadow-amber-500/40 rotate-6 group-hover:rotate-0 transition-transform duration-500">
                                    <i data-lucide="audio-lines" class="w-12 h-12 text-white animate-pulse"></i>
                                </div>
                                <div class="flex-1 text-center sm:text-left">
                                    <p class="text-white font-black text-2xl tracking-tighter uppercase mb-1">Ancestral Echoes
                                    </p>
                                    <p class="text-amber-500 text-xs uppercase font-black tracking-widest">Digital Preservation
                                        Transmission</p>

                                    <div class="mt-6 flex flex-col space-y-4">
                                        @if($culture->audio_path)
                                            <audio controls class="w-full custom-audio-player">
                                                <source src="{{ Storage::url($culture->audio_path) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <a href="{{ $culture->audio_url }}" target="_blank"
                                                class="inline-block text-center px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white rounded-2xl text-sm font-black transition-all shadow-xl shadow-amber-500/30">
                                                LISTEN TO EXTERNAL SOURCE
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($culture->audio_description)
                            <div
                                class="bg-stone-50 dark:bg-stone-900/50 p-8 rounded-3xl border border-stone-200 dark:border-stone-800">
                                <p class="text-stone-600 dark:text-stone-400 text-sm leading-relaxed font-bold italic">
                                    <i data-lucide="quote" class="w-4 h-4 mb-2 opacity-30"></i>
                                    {{ $culture->audio_description }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="space-y-8">
                <!-- Guardian Info Card -->
                <div
                    class="bg-white dark:bg-stone-900 border-4 border-amber-100 dark:border-stone-800 rounded-[3rem] p-10 shadow-xl shadow-amber-500/5">
                    <div class="text-center">
                        <div class="relative inline-block mb-6">
                            <div
                                class="w-24 h-24 rounded-[2rem] bg-amber-500 flex items-center justify-center text-white shadow-2xl shadow-amber-500/30 rotate-6">
                                <i data-lucide="map" class="w-12 h-12"></i>
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 bg-stone-900 text-white w-10 h-10 rounded-xl flex items-center justify-center border-4 border-white dark:border-stone-900">
                                <i data-lucide="shield-check" class="w-5 h-5 text-amber-500"></i>
                            </div>
                        </div>
                        <h2 class="text-stone-900 dark:text-white font-black text-xl uppercase tracking-tighter mb-1">
                            Cultural Guardian</h2>
                        <p class="text-sm font-black text-amber-600 mb-8 tracking-widest uppercase">
                            {{ $culture->submitter->name ?? 'Timeline Preserver' }}</p>

                        <div class="space-y-6 pt-8 border-t border-stone-100 dark:border-stone-800">
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="text-stone-400 font-black uppercase tracking-widest">Enshrined On</span>
                                <span
                                    class="text-stone-900 dark:text-stone-300 font-black uppercase">{{ $culture->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="text-stone-400 font-black uppercase tracking-widest">Archive ID</span>
                                <span
                                    class="text-amber-600 font-black">#TH-{{ str_pad($culture->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        <div class="mt-10">
                            <a href="{{ route('profile.user', $culture->submitted_by) }}"
                                class="w-full inline-flex items-center justify-center py-4 bg-stone-900 dark:bg-white dark:text-stone-900 text-white rounded-[1.5rem] text-[11px] font-black tracking-widest hover:scale-[1.03] transition-transform shadow-xl">
                                EXPLORE GUARDIAN STORY
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Collective Pulse Section -->
                <div
                    class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-[3rem] p-10 text-white shadow-2xl shadow-amber-500/30">
                    <h3 class="font-black text-xs uppercase tracking-widest mb-8 opacity-80">Collective Pulse</h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="lock" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black tracking-tighter">{{ $culture->locked_in_count }}</p>
                                    <p class="text-[9px] font-black uppercase tracking-widest opacity-70">Presences
                                        Locked-In</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="heart" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black tracking-tighter">{{ $culture->resonance_count }}</p>
                                    <p class="text-[9px] font-black uppercase tracking-widest opacity-70">Human Resonances
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Licensing Block -->
                <div
                    class="bg-stone-50 dark:bg-stone-950/30 rounded-[2.5rem] p-8 border border-stone-200 dark:border-stone-800">
                    <div
                        class="flex items-center space-x-2 text-stone-400 mb-4 uppercase tracking-widest text-[10px] font-black">
                        <i data-lucide="shield-alert" class="w-4 h-4"></i>
                        <span>Digital Rights Archive</span>
                    </div>
                    <p class="text-[11px] font-bold text-stone-600 dark:text-stone-400 leading-relaxed">
                        This content is protected under the <span
                            class="text-amber-600">{{ $culture->license_type ?? 'Standard Timeline' }}</span> license.
                        Credits belong to: <span
                            class="text-stone-900 dark:text-white">{{ $culture->license_credit ?? 'Shared Community' }}</span>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        /* Styling for the audio player to match our theme */
        .custom-audio-player::-webkit-media-controls-panel {
            background-color: #f59e0b;
        }

        .custom-audio-player::-webkit-media-controls-current-time-display,
        .custom-audio-player::-webkit-media-controls-time-remaining-display {
            color: #fff;
            font-weight: 800;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());

        function toggleCultureLockin(id) {
            fetch(`/cultures/${id}/lockin`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.lockedIn !== undefined) {
                        location.reload();
                    }
                });
        }
    </script>
@endpush