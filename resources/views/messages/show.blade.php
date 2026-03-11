@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-screen bg-gray-100 dark:bg-stone-950">

        @php
            $otherUser = $selectedConversation->participants
                ->where('id', '!=', auth()->id())
                ->first();
        @endphp

        <!-- CHAT HEADER (fixed) -->
        <header
            class="flex items-center justify-between p-2 md:p-4 border-b border-gray-200 dark:border-stone-800 bg-white/90 dark:bg-stone-900/90 backdrop-blur-xl sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-2 md:gap-4">
                <a href="{{ route('messages.index') }}"
                    class="p-2 hover:bg-gray-100 dark:hover:bg-stone-800 rounded-full flex items-center justify-center transition-colors">
                    <i data-lucide="chevron-left" class="w-5 h-5 md:w-6 md:h-6 text-gray-600 dark:text-stone-400"></i>
                </a>

                <div class="relative">
                    <img src="{{ $otherUser->profile_photo_url }}"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-xl object-cover shadow-inner">
                    <span class="absolute -bottom-1 -right-1 w-2.5 h-2.5 md:w-3.5 md:h-3.5 rounded-full border-2 border-white dark:border-stone-900
                            {{ $otherUser->is_online ? 'bg-green-500' : 'bg-gray-400 dark:bg-stone-600' }}"></span>
                </div>

                <div class="truncate max-w-[120px] md:max-w-xs">
                    <h2 class="font-extrabold text-sm md:text-lg truncate dark:text-stone-100">
                        {{ $otherUser->name ?? 'Unknown' }}</h2>
                    <span
                        class="text-[10px] md:text-[11px] font-medium text-gray-500 dark:text-stone-400 uppercase tracking-tighter truncate">
                        {{ $otherUser->is_online ? 'Active Now' : ($otherUser->last_seen ? 'Last seen ' . $otherUser->last_seen->diffForHumans() : 'Offline') }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-1 md:gap-2">
                <button
                    class="p-2 hover:bg-gray-100 dark:hover:bg-stone-800 rounded-2xl text-gray-500 dark:text-stone-400 transition-all active:scale-95">
                    <i data-lucide="phone" class="w-4 h-4 md:w-5 md:h-5"></i>
                </button>
                <button
                    class="p-2 hover:bg-gray-100 dark:hover:bg-stone-800 rounded-2xl text-gray-500 dark:text-stone-400 transition-all active:scale-95">
                    <i data-lucide="video" class="w-4 h-4 md:w-5 md:h-5"></i>
                </button>
                <button
                    class="p-2 hover:bg-gray-100 dark:hover:bg-stone-800 rounded-2xl text-gray-500 dark:text-stone-400 transition-all active:scale-95">
                    <i data-lucide="more-vertical" class="w-4 h-4 md:w-5 md:h-5"></i>
                </button>
            </div>
        </header>

        <!-- CHAT MESSAGES (scrollable) -->
        <div id="chat-messages"
            class="flex-1 overflow-y-auto p-2 md:p-6 space-y-4 custom-scrollbar bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] bg-opacity-5 dark:bg-opacity-[0.02]">
            @forelse($messages as $msg)
                <div class="flex {{ $msg->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="flex flex-col {{ $msg->user_id == auth()->id() ? 'items-end' : 'items-start' }} max-w-[80%] md:max-w-[70%]">
                        <div
                            class="relative px-3 py-2 md:px-5 md:py-3 rounded-2xl shadow-sm text-sm md:text-[15px] leading-snug
                                        {{ $msg->user_id == auth()->id() ? 'bg-amber-500 text-white rounded-br-none' : 'bg-white dark:bg-stone-800 text-gray-800 dark:text-stone-100 rounded-bl-none border border-gray-100 dark:border-stone-700' }}">
                            <p class="break-words">{{ Str::limit($msg->content, 200) }}</p>
                        </div>
                        <div class="mt-1 flex items-center gap-1 px-1 md:px-2">
                            <span class="text-[9px] md:text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                            @if($msg->user_id == auth()->id())
                                <div class="opacity-80">
                                    @if($msg->status == 'sent')
                                        <i data-lucide="check" class="w-3 h-3 text-gray-400"></i>
                                    @elseif($msg->status == 'read')
                                        <i data-lucide="check-check" class="w-3 h-3 text-amber-600"></i>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center opacity-30 text-gray-400 space-y-4 py-12">
                    <i data-lucide="sparkles" class="w-12 h-12 md:w-16 md:h-16"></i>
                    <p class="font-medium text-sm md:text-base">No messages yet. Say hi!</p>
                </div>
            @endforelse
        </div>

        <!-- CHAT INPUT (fixed at bottom) -->
        <div
            class="p-2 md:p-4 bg-white dark:bg-stone-900 border-t border-gray-100 dark:border-stone-800 sticky bottom-0 z-20">
            <form id="chat-form" action="{{ route('messages.store', $selectedConversation->id) }}" method="POST"
                class="flex flex-wrap gap-2">
                @csrf
                <button type="button"
                    class="p-2 text-gray-400 dark:text-stone-500 hover:text-amber-500 dark:hover:text-amber-400 transition-colors">
                    <i data-lucide="plus-circle" class="w-5 h-5 md:w-6 md:h-6"></i>
                </button>
                <input type="text" name="content" autocomplete="off" placeholder="Type a message..."
                    class="flex-1 min-w-[60%] bg-gray-50 dark:bg-stone-800 border border-gray-200 dark:border-stone-700 rounded-full px-4 py-2 text-sm md:text-base text-gray-900 dark:text-stone-100 placeholder-gray-400 dark:placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-amber-500 break-words">
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-white rounded-full p-2.5 md:p-2 shadow transition-all hover:scale-105 active:scale-95 flex-shrink-0">
                    <i data-lucide="send" class="w-5 h-5 md:w-6 md:h-6"></i>
                </button>
            </form>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    </script>
@endsection