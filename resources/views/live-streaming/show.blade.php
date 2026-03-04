{{-- resources/views/live-streaming/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div id="live-stream-root" class="h-[calc(100vh-4rem)] bg-stone-950 flex flex-col md:flex-row overflow-hidden relative"
        x-data="chatComponent()">

        {{-- Main Video Area --}}
        <div class="flex-1 flex flex-col relative transition-all duration-300 h-[60vh] md:h-full">

            {{-- Video Player / Camera Feed --}}
            <div class="w-full h-full bg-black relative flex items-center justify-center overflow-hidden">
                @if(auth()->id() === $stream->user_id && $stream->is_live)
                    <video id="host-video" autoplay playsinline muted class="w-full h-full object-cover"></video>
                @else
                    <img src="{{ $stream->thumbnail ?? 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=1200' }}"
                        class="w-full h-full object-cover opacity-80" alt="Video Feed">
                @endif

                {{-- Pulse Overlay Effect --}}
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50 mix-blend-multiply pointer-events-none">
                </div>

                {{-- Top Controls Overlay --}}
                <div
                    class="absolute top-0 left-0 right-0 p-4 md:p-6 flex justify-between items-start bg-gradient-to-b from-black/80 to-transparent">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('live-stream.index') }}"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </a>
                        <div>
                            <h1 class="text-white font-bold text-lg md:text-sm drop-shadow-md flex items-center gap-2">
                                {{ $stream->title }}
                                @if(auth()->id() === $stream->user_id && $stream->is_live)
                                    <span
                                        class="bg-red-600 text-white text-[10px] uppercase font-black px-2 py-0.5 rounded shadow-lg flex items-center gap-1">
                                        <span class="w-1 h-1 bg-white rounded-full animate-pulse"></span>
                                        You're Live
                                    </span>
                                @elseif($stream->is_live)
                                    <span
                                        class="bg-red-600 text-white text-[10px] uppercase font-black px-2 py-0.5 rounded shadow-lg flex items-center gap-1">
                                        <span class="w-1 h-1 bg-white rounded-full animate-pulse"></span>
                                        Live
                                    </span>
                                @else
                                    <span
                                        class="bg-stone-600 text-white text-[10px] uppercase font-black px-2 py-0.5 rounded shadow-lg">Ended</span>
                                @endif
                            </h1>
                            <a href="{{ route('profile.user', $stream->host) }}" class="text-stone-300 text-sm flex items-center gap-2 hover:text-amber-500 transition-colors group">
                                <img src="{{ $stream->host->profile_photo_url }}"
                                    class="w-5 h-5 rounded-full border border-white/20 group-hover:border-amber-500/50">
                                {{ $stream->host->name }}
                                <i data-lucide="external-link" class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div
                            class="bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-lg flex items-center gap-2 text-white text-xs font-semibold border border-white/10">
                            <i data-lucide="eye" class="w-4 h-4 text-stone-300"></i> {{ $stream->viewers_count }}
                        </div>
                        <button @click="showChat = !showChat"
                            class="md:hidden w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition">
                            <i data-lucide="message-square" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                {{-- Bottom Controls Overlay (Host only) --}}
                @if(auth()->id() === $stream->user_id && $stream->is_live)
                    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex items-center gap-4 bg-black/60 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10"
                        x-data="{ micOn: true, camOn: true }">
                        <button @click="toggleMicGlobal(); micOn = !micOn"
                            :class="micOn ? 'bg-white/10 hover:bg-white/20' : 'bg-red-500/80 hover:bg-red-600/80'"
                            class="w-12 h-12 rounded-full text-white flex items-center justify-center transition"
                            title="Toggle Microphone">
                            <i :data-lucide="micOn ? 'mic' : 'mic-off'" class="w-5 h-5"></i>
                        </button>
                        <button @click="toggleCamGlobal(); camOn = !camOn"
                            :class="camOn ? 'bg-white/10 hover:bg-white/20' : 'bg-red-500/80 hover:bg-red-600/80'"
                            class="w-12 h-12 rounded-full text-white flex items-center justify-center transition"
                            title="Toggle Camera">
                            <i :data-lucide="camOn ? 'video' : 'video-off'" class="w-5 h-5"></i>
                        </button>
                        <form action="{{ route('live-stream.end', $stream) }}" method="POST" class="inline"
                            id="end-stream-form">
                            @csrf
                            <button type="submit" @click="stopStreamGlobal()"
                                class="h-12 px-6 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-sm tracking-wide transition flex items-center gap-2">
                                <i data-lucide="phone-off" class="w-4 h-4"></i> End Stream
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        {{-- Chat Sidebar --}}
        <div :class="showChat ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0 absolute pointer-events-none'"
            class="w-full md:w-80 lg:w-96 bg-stone-900 border-t md:border-t-0 md:border-l border-stone-800 flex flex-col h-[40vh] md:h-full md:translate-y-0 md:opacity-100 md:static transition-all duration-300 z-10 shrink-0">

            <div
                class="p-4 border-b border-stone-800 flex items-center justify-between bg-stone-900/95 backdrop-blur-sm z-10">
                <h3 class="text-stone-100 font-bold flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-5 h-5 text-amber-500"></i> Live Chat
                </h3>
                <button @click="showChat = false" class="md:hidden text-stone-400 hover:text-white transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 scrollbar-thin scrollbar-thumb-stone-700">
                <div class="bg-black/20 rounded-lg p-3 text-center border border-stone-800 mb-6">
                    <p class="text-xs text-stone-500">Welcome to the live chat! Keep the community clean and respectful.</p>
                </div>

                <div class="text-sm">
                    <span class="text-blue-400 font-bold">System</span>
                    <span class="text-stone-300 ml-1">Connected to cultural hub.</span>
                </div>
            </div>

            {{-- Reaction Floating Container --}}
            <div id="reaction-container"
                class="absolute bottom-24 right-4 w-20 h-64 pointer-events-none z-20 overflow-hidden"></div>

            {{-- Reply Preview --}}
            <div x-show="replyingTo" x-cloak
                class="px-4 py-2 bg-stone-800 border-t border-stone-700 flex items-center justify-between animate-in slide-in-from-bottom-2 duration-200">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Replying to</span>
                    <span class="text-xs text-stone-300 truncate max-w-[200px]" x-text="replyAuthor"></span>
                </div>
                <button @click="cancelReply" class="text-stone-500 hover:text-white transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="p-3 bg-stone-900 border-t border-stone-800 mt-auto flex items-center gap-2">
                @if($stream->is_live)
                    <form @submit.prevent="sendMessage" class="relative flex-1">
                        <input type="text" id="chat-input" placeholder="Send a message..." x-model="messageBody"
                            class="w-full bg-stone-950 border border-stone-800 text-stone-100 rounded-full pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-amber-600 hover:bg-amber-500 text-white rounded-full transition">
                            <i data-lucide="send" class="w-4 h-4 ml-0.5"></i>
                        </button>
                    </form>

                    {{-- Reaction Button --}}
                    <button @click="sendReaction"
                        class="w-10 h-10 rounded-full bg-stone-800 hover:bg-stone-700 flex items-center justify-center text-amber-500 border border-stone-700 transition active:scale-90"
                        title="Send Love">
                        <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                    </button>
                @else
                    <div class="text-center py-2 text-stone-500 text-sm flex-1">Stream has ended.</div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        let localStream = null;

        async function initCamera() {
            @if(auth()->id() === $stream->user_id && $stream->is_live)
                try {
                    localStream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'user', width: { ideal: 1280 }, height: { ideal: 720 } },
                        audio: true
                    });
                    const videoElement = document.getElementById('host-video');
                    if (videoElement) {
                        videoElement.srcObject = localStream;
                    }
                } catch (err) {
                    console.error("Error accessing media devices.", err);
                    alert("Could not access your camera or microphone. Please check permissions.");
                }
            @endif
            lucide.createIcons();
        }

        // Global camera controls for host
        window.toggleMicGlobal = () => {
            if (localStream) {
                const audioTrack = localStream.getAudioTracks()[0];
                if (audioTrack) {
                    audioTrack.enabled = !audioTrack.enabled;
                    lucide.createIcons();
                }
            }
        };

        window.toggleCamGlobal = () => {
            if (localStream) {
                const videoTrack = localStream.getVideoTracks()[0];
                if (videoTrack) {
                    videoTrack.enabled = !videoTrack.enabled;
                    lucide.createIcons();
                }
            }
        };

        window.stopStreamGlobal = () => {
            if (localStream) {
                localStream.getTracks().forEach(track => track.stop());
            }
        };

        document.addEventListener('alpine:init', () => {
            Alpine.data('chatComponent', () => ({
                showChat: true,
                replyingTo: null,
                replyAuthor: '',
                messageBody: '',

                init() {
                    initCamera();
                    
                    // Immediately end stream if host leaves
                    @if(auth()->id() === $stream->user_id && $stream->is_live)
                    window.addEventListener('visibilitychange', () => {
                        if (document.visibilityState === 'hidden') {
                            this.endStreamBeacon();
                        }
                    });
                    window.addEventListener('pagehide', () => this.endStreamBeacon());
                    @endif

                    // Expose vibe function globally for onclick inside dynamic HTML
                    window.vibeMessage = (btn) => this.vibeMessage(btn);
                    window.initiateReplyFromGlobal = (author) => this.initiateReply(author);
                },

                endStreamBeacon() {
                    const url = "{{ route('live-stream.ajax-end', $stream) }}";
                    const data = new FormData();
                    data.append('_token', "{{ csrf_token() }}");
                    navigator.sendBeacon(url, data);
                    stopStreamGlobal();
                },

                sendMessage() {
                    if (!this.messageBody.trim()) return;

                    const message = this.messageBody.trim();
                    const isReply = this.replyingTo !== null;
                    const targetAuthor = this.replyAuthor;

                    const chatContainer = document.getElementById('chat-messages');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'group flex flex-col mb-4 opacity-0 transform translate-y-2 transition-all duration-300';

                    let replyHTML = '';
                    if (isReply) {
                        replyHTML = `
                                    <div class="mb-1 text-[10px] text-stone-500 flex items-center gap-1">
                                        <i data-lucide="corner-down-right" class="w-2.5 h-2.5"></i>
                                        Replying to ${targetAuthor}
                                    </div>
                                `;
                    }

                    messageDiv.innerHTML = `
                                ${replyHTML}
                                <div class="flex items-start gap-2">
                                    <div class="flex-1 bg-white/5 rounded-2xl rounded-tl-none p-3 border border-white/5">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-amber-500 font-bold text-xs">{{ auth()->user()->name }}</span>
                                            <span class="text-[9px] text-stone-500">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                                        </div>
                                        <p class="text-stone-200 text-sm whitespace-pre-wrap">${message}</p>
                                    </div>

                                    <div class="flex flex-col gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="vibeMessage(this)" class="p-1.5 rounded-lg hover:bg-white/10 text-stone-500 hover:text-red-500 transition active:scale-90" title="Vibe">
                                            <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button onclick="initiateReplyFromGlobal('${'{{ auth()->user()->name }}'}')" class="p-1.5 rounded-lg hover:bg-white/10 text-stone-500 hover:text-amber-500 transition" title="Reply">
                                            <i data-lucide="reply" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                </div>
                            `;

                    chatContainer.appendChild(messageDiv);

                    // Delay icon creation to avoid DOM jank during message rendering
                    setTimeout(() => lucide.createIcons(), 50);

                    // Animation
                    setTimeout(() => {
                        messageDiv.classList.remove('opacity-0', 'translate-y-2');
                    }, 10);

                    // Reset State
                    this.messageBody = '';
                    this.replyingTo = null;
                    this.replyAuthor = '';
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                },

                initiateReply(author) {
                    this.replyAuthor = author;
                    this.replyingTo = Date.now();
                    document.getElementById('chat-input').focus();
                },

                cancelReply() {
                    this.replyingTo = null;
                    this.replyAuthor = '';
                },

                vibeMessage(btn) {
                    const icon = btn.querySelector('i, svg');
                    icon.classList.toggle('text-red-500');
                    if (icon.classList.contains('text-red-500')) {
                        icon.classList.add('fill-red-500');
                    } else {
                        icon.classList.remove('fill-red-500');
                    }

                    // Floating effect
                    const rect = btn.getBoundingClientRect();
                    const vibeHeart = document.createElement('div');
                    vibeHeart.className = 'fixed pointer-events-none transition-all duration-700 ease-out z-[100]';
                    vibeHeart.style.left = `${rect.left + rect.width / 2}px`;
                    vibeHeart.style.top = `${rect.top}px`;
                    vibeHeart.innerHTML = '⚡';
                    vibeHeart.style.fontSize = '20px';
                    document.body.appendChild(vibeHeart);

                    setTimeout(() => {
                        vibeHeart.style.opacity = '0';
                        vibeHeart.style.transform = 'translateY(-40px) scale(1.5)';
                    }, 50);

                    setTimeout(() => vibeHeart.remove(), 700);
                },

                sendReaction() {
                    const container = document.getElementById('reaction-container');
                    const heart = document.createElement('div');
                    const size = Math.random() * 20 + 20;
                    const left = Math.random() * 100;

                    heart.className = 'absolute bottom-0 text-red-500 transition-all duration-1000 ease-out pointer-events-none animate-bounce';
                    heart.style.left = `${left}%`;
                    heart.style.fontSize = `${size}px`;

                    heart.innerHTML = '<i data-lucide="heart" class="fill-current"></i>';
                    setTimeout(() => lucide.createIcons(), 5);

                    container.appendChild(heart);

                    setTimeout(() => {
                        heart.style.bottom = '100%';
                        heart.style.opacity = '0';
                        heart.style.transform = `scale(${Math.random() * 2 + 1}) rotate(${Math.random() * 360}deg)`;
                    }, 50);

                    setTimeout(() => heart.remove(), 1000);
                }
            }));
        });
    </script>
@endsection