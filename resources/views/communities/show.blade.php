{{-- resources/views/communities/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left Column: Post Form + Feed --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Post Form --}}
            @auth
                <div class="bg-white rounded-2xl shadow-md p-6 border border-stone-100">
                    <form id="community-post-form" action="{{ route('communities.posts.store', $community->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="community_id" value="{{ $community->id }}">
                        <textarea name="content" rows="5"
                            class="w-full p-4 border border-stone-300 rounded-2xl resize-none focus:ring-2 focus:ring-amber-300 text-sm sm:text-base placeholder-stone-400"
                            placeholder="Share something with {{ $community->name }}..."></textarea>

                        <div class="flex items-center justify-between gap-3 flex-wrap">
                            <div class="flex items-center gap-3 text-stone-600">
                                <label title="Add image" class="cursor-pointer p-2 rounded-md hover:bg-stone-50 transition">
                                    <i data-lucide="image" class="w-6 h-6"></i>
                                    <input id="community-image-input" type="file" name="image" accept="image/*" class="hidden"
                                        onchange="previewImage(event,'image-preview')">
                                </label>
                                <label title="Add video" class="cursor-pointer p-2 rounded-md hover:bg-stone-50 transition">
                                    <i data-lucide="video" class="w-6 h-6"></i>
                                    <input type="file" name="video" accept="video/*" class="hidden">
                                </label>
                                <label title="Add audio" class="cursor-pointer p-2 rounded-md hover:bg-stone-50 transition">
                                    <i data-lucide="mic" class="w-6 h-6"></i>
                                    <input type="file" name="audio" accept="audio/*" class="hidden">
                                </label>
                            </div>

                            <button type="submit"
                                class="px-5 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-sm sm:text-base shadow-sm hover:from-amber-600 hover:to-orange-700 transition">
                                Post
                            </button>
                        </div>

                        <div id="image-preview" class="hidden mt-3">
                            <img id="image-preview-img" src=""
                                class="max-h-72 sm:max-h-96 rounded-lg object-contain border w-full" alt="Preview">
                            <div class="mt-2 text-xs text-stone-500">Preview — image will upload with the post</div>
                        </div>
                    </form>
                </div>
            @endauth

            {{-- Posts Feed --}}
            <div class="space-y-6" id="posts-feed">
                @forelse($posts as $post)
                    <div class="bg-white rounded-2xl shadow-md border border-stone-100 p-5 post-card" id="post-{{ $post->id }}">

                        {{-- User Info --}}
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-sm sm:text-base text-stone-800">{{ $post->user->name }}</p>
                                <p class="text-xs sm:text-sm text-stone-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        {{-- Post Content --}}
                        <p class="mt-2 text-sm sm:text-base text-stone-700 leading-relaxed whitespace-pre-wrap">
                            {{ $post->content }}</p>

                        {{-- Media --}}
                        <div class="mt-3 flex flex-col gap-4">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="rounded-xl w-full object-cover max-h-96 sm:max-h-[28rem]" alt="post image">
                            @endif
                            @if($post->video)
                                <video controls class="rounded-xl w-full max-h-96 sm:max-h-[28rem]">
                                    <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                </video>
                            @endif
                            @if($post->audio)
                                <audio controls class="w-full">
                                    <source src="{{ asset('storage/' . $post->audio) }}" type="audio/mpeg">
                                </audio>
                            @endif
                        </div>

                        {{-- Interaction Icons (Single Line, Centered) --}}
                        <div class="flex items-center justify-center gap-6 mt-4 border-t border-stone-100 pt-3 flex-wrap">
                            @auth
                                <button title="Tap" data-tap-post="{{ $post->id }}"
                                    onclick="toggleCommunityTap({{ $post->id }}, this)"
                                    class="flex items-center gap-2 px-3 py-1 rounded-full text-sm transition {{ $post->taps()->where('user_id', auth()->id())->exists() ? 'bg-red-50 text-red-600' : 'text-stone-600 hover:bg-stone-50' }}">
                                    <i data-lucide="heart"
                                        class="w-5 h-5 {{ $post->taps()->where('user_id', auth()->id())->exists() ? 'fill-current' : '' }}"></i>
                                    <span id="tap-count-{{ $post->id }}"
                                        class="text-sm font-medium">{{ $post->taps()->count() }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-400 hover:text-amber-600 transition">
                                    <i data-lucide="heart" class="w-5 h-5"></i>
                                    <span class="text-sm font-medium">{{ $post->taps()->count() }}</span>
                                </a>
                            @endauth

                            <button title="Comments" onclick="toggleCommentsBox({{ $post->id }})"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 hover:bg-stone-50 transition">
                                <i data-lucide="message-square" class="w-5 h-5"></i>
                                <span id="comment-count-{{ $post->id }}"
                                    class="text-sm font-medium">{{ $post->comments()->count() }}</span>
                            </button>

                            <button title="Save"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 hover:bg-stone-50 transition">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                                <span class="text-sm"></span>
                            </button>

                            <button title="Share"
                                onclick="openShareModal('{{ url('/communities/' . $community->id . '?post=' . $post->id) }}', '{{ addslashes(Str::limit($post->content ?? '', 120)) }}')"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 hover:bg-stone-50 transition">
                                <i data-lucide="share-2" class="w-5 h-5"></i>
                                <span class="text-sm"></span>
                            </button>
                        </div>

                        {{-- Comments Box --}}
                        <div id="comments-box-{{ $post->id }}" class="hidden mt-3 space-y-3">
                            @foreach($post->comments()->latest()->limit(50)->get() as $comment)
                                <div class="flex gap-3 items-start">
                                    <img src="{{ $comment->user->profile_photo_url }}" class="w-9 h-9 rounded-full object-cover">
                                    <div class="bg-stone-50 rounded-2xl p-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-stone-800">{{ $comment->user->name }}</p>
                                                <p class="text-xs text-stone-400">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-sm text-stone-700">{{ $comment->content }}</p>
                                        <div class="mt-2 text-xs text-stone-500 flex gap-3">
                                            <button onclick="replyComment({{ $comment->id }})"
                                                class="hover:text-amber-600">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @auth
                                <form onsubmit="submitComment(event, {{ $post->id }})" class="mt-3 flex items-center gap-3">
                                    @csrf
                                    <input id="comment-input-{{ $post->id }}" name="content" type="text"
                                        placeholder="Write a comment..."
                                        class="flex-1 px-4 py-3 rounded-full border border-stone-300 text-sm sm:text-base focus:ring-2 focus:ring-amber-300">
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-full text-sm sm:text-base">
                                        <i data-lucide="send" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            @else
                                <div class="mt-3 text-xs sm:text-sm text-stone-500">
                                    <a href="{{ route('login') }}" class="text-amber-600">Log in</a> to comment.
                                </div>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i data-lucide="box" class="w-14 h-14 text-stone-300 mx-auto mb-3"></i>
                        <p class="text-sm sm:text-base text-stone-600">No posts yet. Be the first to post!</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Right Column: Community Info + Members --}}
        <div class="space-y-6">

            {{-- Community Info --}}
            <div class="bg-white rounded-2xl shadow-md border border-stone-100">
                {{-- Community Image --}}
                <div class="relative h-56 sm:h-64 lg:h-72 rounded-t-2xl overflow-hidden">
                    <img src="{{ $community->image ? asset('storage/' . $community->image) : asset('images/community-default.jpg') }}"
                        class="w-full h-full object-cover" alt="{{ $community->name }}">
                </div>

                {{-- Community Info --}}
                <div class="p-5">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-800">{{ $community->name }}</h2>
                    <p class="text-xs sm:text-sm text-stone-500 mt-1">{{ $community->members()->count() }} members •
                        {{ $posts->total() ?? $community->communityPosts()->count() }} posts</p>
                    <p class="text-sm sm:text-base text-stone-600 mt-2">{{ $community->description }}</p>

                    {{-- Action Buttons --}}
                    <div class="mt-4 flex flex-col gap-2">
                        <a href=""
                            class="w-full px-4 py-2 rounded-lg border border-stone-200 text-stone-800 text-sm sm:text-base hover:bg-stone-50 text-center transition">View
                            Activity / Settings</a>

                        @auth
                            @if($community->members->contains(auth()->id()))
                                <form action="{{ route('communities.leave', $community) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg border border-red-400 text-red-600 text-sm sm:text-base hover:bg-red-50 transition">
                                        Leave Community
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('communities.join', $community) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition">
                                        Join Community
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Members --}}
            <div class="bg-white rounded-2xl shadow-md border border-stone-100 p-5">
                <h3 class="font-semibold text-stone-800 mb-3">Members</h3>
                <div class="grid grid-cols-4 gap-3">
                    @foreach($community->members->take(8) as $member)
                        <img src="{{ $member->profile_photo_url }}"
                            class="w-14 h-14 rounded-full mx-auto object-cover border border-stone-100">
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => { lucide.createIcons() });
        const csrfToken = '{{ csrf_token() }}';

        function toggleCommentsBox(postId) { document.getElementById(`comments-box-${postId}`).classList.toggle("hidden"); }

        function toggleCommunityTap(postId, btn) {
            btn.disabled = true;
            fetch(`/community-posts/${postId}/tap`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
                .then(res => res.json()).then(data => {
                    const countEl = document.getElementById(`tap-count-${postId}`);
                    if (countEl) countEl.textContent = data.count;
                    if (data.tapped) { btn.classList.add('bg-red-50', 'text-red-600'); btn.querySelector('i').classList.add('fill-current'); }
                    else { btn.classList.remove('bg-red-50', 'text-red-600'); btn.querySelector('i').classList.remove('fill-current'); }
                }).finally(() => btn.disabled = false);
        }

        function submitComment(e, postId) {
            e.preventDefault();
            const input = document.getElementById(`comment-input-${postId}`);
            const content = input.value.trim();
            if (!content) return;
            input.disabled = true;

            fetch(`/community-posts/${postId}/comment`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ content })
            }).then(res => res.json()).then(data => {
                const commentsBox = document.getElementById(`comments-box-${postId}`);
                const newComment = document.createElement('div');
                newComment.className = 'flex gap-3 items-start';
                newComment.innerHTML = `
                <img src="${data.user.profile_photo_url || '/images/default-avatar.png'}" class="w-8 h-8 rounded-full">
                <div class="bg-stone-50 rounded-2xl p-4 flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-stone-800">${data.user.name}</p>
                            <p class="text-xs text-stone-400">Just now</p>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-stone-700">${data.content}</p>
                </div>
            `;
                commentsBox.prepend(newComment);
                document.getElementById(`comment-count-${postId}`).textContent = parseInt(document.getElementById(`comment-count-${postId}`).textContent) + 1;
                input.value = '';
            }).finally(() => input.disabled = false);
        }

        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('image-preview-img');
                    img.src = e.target.result;
                    document.getElementById(previewId).classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function replyComment(commentId) { alert('Reply feature coming soon for comment ' + commentId); }
    </script>
@endsection