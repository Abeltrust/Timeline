{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-0 sm:p-4 space-y-6">

    {{-- Profile Avatar Centered --}}
    <div class="flex flex-col items-center pt-8">
        <div class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                     alt="Profile Photo" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-2xl sm:text-3xl font-bold text-orange-500 bg-white">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            {{-- Upload Profile Photo --}}
            @auth
            @if(auth()->id() === $user->id)
            <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data" 
                  class="absolute bottom-0 right-0">
                @csrf
                <label class="cursor-pointer bg-white p-1 rounded-full shadow hover:bg-gray-100 transition">
                    <input type="file" name="profile_photo" class="hidden" onchange="this.form.submit()">
                    <i data-lucide="camera" class="w-4 h-4 text-orange-500"></i>
                </label>
            </form>
            @endif
            @endauth
        </div>

        {{-- User Info --}}
        <div class="text-center mt-4">
            <h1 class="text-lg sm:text-xl font-semibold text-stone-800">{{ $user->name }}</h1>
            <p class="text-xs sm:text-sm text-stone-500 mt-1 max-w-md mx-auto leading-snug">
                {{ $user->bio ?? 'Software Architect & Cultural Preservationist | Building bridges between tech & heritage' }}
            </p>

            {{-- Edit Button --}}
            @auth
            @if(auth()->id() === $user->id)
            <a href="{{ route('profile.edit') }}" 
               class="inline-flex items-center mt-3 px-3 py-1.5 bg-orange-500 text-white rounded-lg text-xs sm:text-sm hover:bg-orange-600 transition">
                Edit Profile
            </a>
            @endif
            @endauth
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center px-3">
        <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
            <p class="text-md font-semibold text-stone-800">{{ $user->stories_count ?? 0 }}</p>
            <p class="text-xs text-stone-500 mt-1">Stories</p>
        </div>
        <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
            <p class="text-md font-semibold text-stone-800">{{ $user->locked_in_count ?? 0 }}</p>
            <p class="text-xs text-stone-500 mt-1">Locked-In</p>
        </div>
        <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
            <p class="text-md font-semibold text-stone-800">{{ $user->taps_count ?? 0 }}</p>
            <p class="text-xs text-stone-500 mt-1">TAPs</p>
        </div>
        <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
            <p class="text-md font-semibold text-stone-800">{{ $user->life_chapters_count ?? 0 }}</p>
            <p class="text-xs text-stone-500 mt-1">Chapters</p>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="bg-white rounded-2xl shadow p-4 border border-stone-100 mx-3 sm:mx-0">
        <div class="flex gap-4 border-b border-stone-200 mb-3 overflow-x-auto scrollbar-hide">
            <button class="text-sm font-medium pb-2 border-b-2 border-orange-500 flex-shrink-0">Life Story</button>
            <button class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Cultural Identity</button>
            <button class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Achievements</button>
            <button class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Private Vault</button>
        </div>

        {{-- Life Chapters --}}
        <div class="space-y-3">
            @foreach($user->lifeChapters as $chapter)
            <div class="bg-stone-50 p-3 rounded-xl border border-stone-100 flex flex-col sm:flex-row justify-between items-start gap-3">
                <div class="flex gap-3 items-start flex-1">
                    <div class="p-2 bg-orange-400 rounded-lg text-white flex-shrink-0">
                        <i data-lucide="book" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-stone-800 text-sm sm:text-base">{{ $chapter->title }}</h3>
                        <p class="text-stone-600 text-xs sm:text-sm mt-0.5">{{ $chapter->description }}</p>
                        <p class="text-xs text-stone-400 mt-1">{{ $chapter->location ?? 'Jos, Nigeria' }} • {{ $chapter->stories_count ?? 0 }} Stories</p>
                    </div>
                </div>
                <span class="text-xs text-stone-400 mt-1 sm:mt-0">{{ $chapter->start_year }} - {{ $chapter->end_year ?? 'Present' }}</span>
            </div>
            @endforeach

            {{-- Add Chapter --}}
            @auth
            @if(auth()->id() === $user->id)
            <a href="" class="inline-flex items-center gap-2 px-3 py-1.5 text-orange-500 border border-orange-300 rounded-lg hover:bg-orange-50 transition text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Add Chapter
            </a>
            @endif
            @endauth
        </div>
    </div>
</div>

{{-- Lucide Icons --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => { lucide.createIcons() });
</script>
@endsection
