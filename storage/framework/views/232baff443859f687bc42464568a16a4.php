


<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 space-y-6">

            
            <div class="flex gap-4 border-b border-stone-200 dark:border-stone-800 pb-2">
                <button onclick="switchCommunityTab('feed')" id="tab-feed" class="px-4 py-2 text-sm sm:text-base font-semibold border-b-2 border-amber-500 text-amber-600 dark:text-amber-500 transition">Feed</button>
                <button onclick="switchCommunityTab('meetings')" id="tab-meetings" class="px-4 py-2 text-sm sm:text-base font-semibold border-b-2 border-transparent text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 transition">Meetings / Lectures</button>
            </div>

            
            <div id="section-feed" class="space-y-6 block">

            
            <?php if(auth()->guard()->check()): ?>
                <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-md p-6 border border-stone-100 dark:border-stone-800">
                    <form id="community-post-form" action="<?php echo e(route('communities.posts.store', $community->id)); ?>" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="community_id" value="<?php echo e($community->id); ?>">
                        <textarea name="content" rows="5"
                            class="w-full p-4 border border-stone-300 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-2xl resize-none focus:ring-2 focus:ring-amber-300 text-sm sm:text-base placeholder-stone-400 dark:placeholder-stone-500"
                            placeholder="Share something with <?php echo e($community->name); ?>..."></textarea>

                        <div class="flex items-center justify-between gap-3 flex-wrap">
                            <div class="flex items-center gap-3 text-stone-600 dark:text-stone-400">
                                <label title="Add image"
                                    class="cursor-pointer p-2 rounded-md hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                                    <i data-lucide="image" class="w-6 h-6"></i>
                                    <input id="community-image-input" type="file" name="image" accept="image/*" class="hidden"
                                        onchange="previewImage(event,'image-preview')">
                                </label>
                                <label title="Add video"
                                    class="cursor-pointer p-2 rounded-md hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                                    <i data-lucide="video" class="w-6 h-6"></i>
                                    <input type="file" name="video" accept="video/*" class="hidden">
                                </label>
                                <label title="Add audio"
                                    class="cursor-pointer p-2 rounded-md hover:bg-stone-50 dark:hover:bg-stone-800 transition">
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
            <?php endif; ?>

            
            <div class="space-y-6" id="posts-feed">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-md border border-stone-100 dark:border-stone-800 p-5 post-card"
                        id="post-<?php echo e($post->id); ?>">

                        
                        <div class="flex items-center gap-3 mb-3">
                            <img src="<?php echo e($post->user->profile_photo_url); ?>" alt="<?php echo e($post->user->name); ?>"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-sm sm:text-base text-stone-800 dark:text-stone-100">
                                    <?php echo e($post->user->name); ?></p>
                                <p class="text-xs sm:text-sm text-stone-500 dark:text-stone-400">
                                    <?php echo e($post->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>

                        
                        <p
                            class="mt-2 text-sm sm:text-base text-stone-700 dark:text-stone-300 leading-relaxed whitespace-pre-wrap text-left">
                            <?php echo e($post->content); ?>

                        </p>

                        
                        <div class="mt-3 flex flex-col gap-4">
                            <?php if($post->image): ?>
                                <div class="w-full bg-stone-50 dark:bg-stone-800/50 rounded-xl overflow-hidden flex items-center justify-center border border-stone-100 dark:border-stone-800">
                                    <img src="<?php echo e(asset('storage/' . $post->image)); ?>"
                                        class="w-full h-auto max-h-[32rem] object-contain" alt="post image">
                                </div>
                            <?php endif; ?>
                            <?php if($post->video): ?>
                                <video controls class="rounded-xl w-full max-h-96 sm:max-h-[28rem]">
                                    <source src="<?php echo e(asset('storage/' . $post->video)); ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                            <?php if($post->audio): ?>
                                <audio controls class="w-full">
                                    <source src="<?php echo e(asset('storage/' . $post->audio)); ?>" type="audio/mpeg">
                                </audio>
                            <?php endif; ?>
                        </div>

                        
                        <div
                            class="flex items-center justify-center gap-6 mt-4 border-t border-stone-100 dark:border-stone-800 pt-3 flex-wrap">
                            <?php if(auth()->guard()->check()): ?>
                                <button title="Tap" data-tap-post="<?php echo e($post->id); ?>"
                                    onclick="toggleCommunityTap(<?php echo e($post->id); ?>, this)"
                                    class="flex items-center gap-2 px-3 py-1 rounded-full text-sm transition-all transform active:scale-95 <?php echo e($post->taps()->where('user_id', auth()->id())->exists() ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-stone-600 dark:text-stone-400 hover:bg-stone-50 dark:hover:bg-stone-800'); ?>">
                                    <i data-lucide="heart"
                                        class="w-5 h-5 transition-transform duration-300 <?php echo e($post->taps()->where('user_id', auth()->id())->exists() ? 'fill-current scale-110' : 'scale-100'); ?>"></i>
                                    <span id="tap-count-<?php echo e($post->id); ?>"
                                        class="text-sm font-medium"><?php echo e($post->taps()->count()); ?></span>
                                </button>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>"
                                    class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-400 dark:text-stone-500 hover:text-amber-600 dark:hover:text-amber-500 transition">
                                    <i data-lucide="heart" class="w-5 h-5"></i>
                                    <span class="text-sm font-medium"><?php echo e($post->taps()->count()); ?></span>
                                </a>
                            <?php endif; ?>

                            <button title="Comments" onclick="toggleCommentsBox(<?php echo e($post->id); ?>)"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 dark:text-stone-400 hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                                <i data-lucide="message-square" class="w-5 h-5"></i>
                                <span id="comment-count-<?php echo e($post->id); ?>"
                                    class="text-sm font-medium"><?php echo e($post->comments()->count()); ?></span>
                            </button>

                            <button title="Save"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 dark:text-stone-400 hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                                <span class="text-sm"></span>
                            </button>

                            <button title="Share"
                                onclick="openShareModal('<?php echo e(url('/communities/' . $community->id . '?post=' . $post->id)); ?>', '<?php echo e(addslashes(Str::limit($post->content ?? '', 120))); ?>')"
                                class="flex items-center gap-2 px-3 py-1 rounded-full text-sm text-stone-600 dark:text-stone-400 hover:bg-stone-50 dark:hover:bg-stone-800 transition">
                                <i data-lucide="share-2" class="w-5 h-5"></i>
                                <span class="text-sm"></span>
                            </button>
                        </div>

                        
                        <div id="comments-box-<?php echo e($post->id); ?>" class="hidden mt-3 space-y-3">
                            <?php $__currentLoopData = $post->comments()->whereNull('parent_id')->latest()->limit(50)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex gap-3 items-start">
                                    <img src="<?php echo e($comment->user->profile_photo_url); ?>" class="w-9 h-9 rounded-full object-cover">
                                    <div class="flex-1 space-y-2">
                                        <div class="bg-stone-50 dark:bg-stone-800 rounded-2xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-stone-800 dark:text-stone-100"><?php echo e($comment->user->name); ?></p>
                                                    <p class="text-xs text-stone-400 dark:text-stone-500"><?php echo e($comment->created_at->diffForHumans()); ?></p>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-sm text-stone-700 dark:text-stone-300"><?php echo e($comment->content); ?></p>
                                            <div class="mt-2 text-xs text-stone-500 flex gap-3">
                                                <button onclick="toggleReplyBox(<?php echo e($comment->id); ?>)" class="hover:text-amber-600">Reply</button>
                                            </div>
                                        </div>

                                        
                                        <?php if(auth()->guard()->check()): ?>
                                            <form id="reply-form-<?php echo e($comment->id); ?>" class="hidden flex gap-2" onsubmit="submitReply(event, <?php echo e($post->id); ?>, <?php echo e($comment->id); ?>)">
                                                <?php echo csrf_field(); ?>
                                                <input type="text" id="reply-input-<?php echo e($comment->id); ?>" placeholder="Write a reply..." class="flex-1 px-3 py-2 text-sm rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-900 text-stone-900 dark:text-stone-100 placeholder-stone-400 focus:ring-2 focus:ring-amber-300 transition-all outline-none">
                                                <button type="submit" class="px-3 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-sm"><i data-lucide="send" class="w-4 h-4"></i></button>
                                            </form>
                                        <?php endif; ?>

                                        
                                        <div id="replies-box-<?php echo e($comment->id); ?>" class="space-y-2 pl-4 border-l-2 border-stone-100 dark:border-stone-800 mt-2">
                                            <?php $__currentLoopData = $comment->replies()->oldest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="flex gap-3 items-start">
                                                    <img src="<?php echo e($reply->user->profile_photo_url); ?>" class="w-7 h-7 rounded-full object-cover">
                                                    <div class="bg-stone-50 dark:bg-stone-800 rounded-2xl p-3 flex-1">
                                                        <div class="flex items-center justify-between">
                                                            <div>
                                                                <p class="text-sm font-medium text-stone-800 dark:text-stone-100"><?php echo e($reply->user->name); ?></p>
                                                                <p class="text-xs text-stone-400 dark:text-stone-500"><?php echo e($reply->created_at->diffForHumans()); ?></p>
                                                            </div>
                                                        </div>
                                                        <p class="mt-1 text-sm text-stone-700 dark:text-stone-300"><?php echo e($reply->content); ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(auth()->guard()->check()): ?>
                                <form onsubmit="submitComment(event, <?php echo e($post->id); ?>)" class="mt-3 flex items-center gap-3">
                                    <?php echo csrf_field(); ?>
                                    <input id="comment-input-<?php echo e($post->id); ?>" name="content" type="text"
                                        placeholder="Write a comment..."
                                        class="flex-1 px-4 py-3 rounded-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-900 text-stone-900 dark:text-stone-100 placeholder-stone-400 align-middle focus:outline-none focus:ring-2 focus:ring-amber-300 transition-all text-sm md:text-base">
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-full text-sm sm:text-base">
                                        <i data-lucide="send" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            <?php else: ?>
                                <div class="mt-3 text-xs sm:text-sm text-stone-500 dark:text-stone-400">
                                    <a href="<?php echo e(route('login')); ?>" class="text-amber-600 dark:text-amber-500">Log in</a> to comment.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-12">
                        <i data-lucide="box" class="w-14 h-14 text-stone-300 mx-auto mb-3"></i>
                        <p class="text-sm sm:text-base text-stone-600">No posts yet. Be the first to post!</p>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="mt-6">
                <?php echo e($posts->links()); ?>

            </div>
            
            </div> 

            
            <div id="section-meetings" class="hidden space-y-6">
                <div class="flex items-center justify-between bg-white dark:bg-stone-900 rounded-2xl shadow-md border border-stone-100 dark:border-stone-800 p-5">
                    <div>
                        <h3 class="text-lg font-bold text-stone-800 dark:text-stone-100">Community Meetings</h3>
                        <p class="text-sm text-stone-500 dark:text-stone-400">Host and join live lectures or gatherings.</p>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('events.create', ['community_id' => $community->id])); ?>" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-sm sm:text-base font-semibold shadow-sm hover:from-amber-600 hover:to-orange-700 transition">
                            Create Meeting
                        </a>
                    <?php endif; ?>
                </div>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $community->events()->upcoming()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-stone-100 dark:border-stone-800 p-4 flex flex-col sm:flex-row gap-4">
                            <?php if($event->image): ?>
                                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" class="w-full sm:w-32 h-32 object-cover rounded-xl shrink-0" alt="<?php echo e($event->title); ?>">
                            <?php else: ?>
                                <div class="w-full sm:w-32 h-32 bg-stone-100 dark:bg-stone-800 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="calendar" class="w-8 h-8 text-stone-400"></i>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-stone-800 dark:text-stone-100"><?php echo e($event->title); ?></h4>
                                <p class="text-sm text-stone-600 dark:text-stone-400 mt-1"><?php echo e(Str::limit($event->description, 100)); ?></p>
                                <div class="mt-3 flex flex-wrap gap-3 text-xs font-medium text-stone-500">
                                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i> <?php echo e($event->event_date->format('M d, Y')); ?> at <?php echo e($event->event_time->format('H:i')); ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-4 h-4"></i> <?php echo e($event->is_online ? 'Online' : $event->location); ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="users" class="w-4 h-4"></i> <?php echo e($event->attendees_count); ?> / <?php echo e($event->max_attendees ?: '∞'); ?> attending</span>
                                </div>
                            </div>
                            <div class="flex flex-col justify-end">
                                <a href="<?php echo e(route('events.show', $event)); ?>" class="px-4 py-2 border border-stone-200 dark:border-stone-700 rounded-xl text-sm text-stone-800 dark:text-stone-200 hover:bg-stone-50 dark:hover:bg-stone-800 transition text-center text-nowrap">View Event</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-10 bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-stone-100 dark:border-stone-800">
                            <i data-lucide="calendar-x" class="w-12 h-12 text-stone-300 mx-auto mb-3"></i>
                            <p class="text-stone-500">No upcoming meetings in this community.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="space-y-6">

            
            <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-md border border-stone-100 dark:border-stone-800">
                
                <div class="relative h-56 sm:h-64 lg:h-72 rounded-t-2xl overflow-hidden bg-stone-100 dark:bg-stone-800">
                    <img src="<?php echo e($community->image ? asset('storage/' . $community->image) : asset('images/community-default.jpg')); ?>"
                        class="w-full h-full object-cover" alt="<?php echo e($community->name); ?>">
                </div>

                
                <div class="p-5">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-800 dark:text-stone-100"><?php echo e($community->name); ?>

                    </h2>
                    <p class="text-xs sm:text-sm text-stone-500 dark:text-stone-400 mt-1">
                        <?php echo e($community->members()->count()); ?> members •
                        <?php echo e($posts->total() ?? $community->communityPosts()->count()); ?> posts
                    </p>
                    <p class="text-sm sm:text-base text-stone-600 dark:text-stone-300 mt-2"><?php echo e($community->description); ?>

                    </p>

                    
                    <div class="mt-4 flex flex-col gap-2">
                        <a href=""
                            class="w-full px-4 py-2 rounded-lg border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 text-sm sm:text-base hover:bg-stone-50 dark:hover:bg-stone-800 text-center transition">View
                            Activity / Settings</a>

                        <?php if(auth()->guard()->check()): ?>
                            <?php if($community->members->contains(auth()->id())): ?>
                                <form action="<?php echo e(route('communities.leave', $community)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg border border-red-400 text-red-600 text-sm sm:text-base hover:bg-red-50 transition">
                                        Leave Community
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('communities.join', $community)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition">
                                        Join Community
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="bg-white dark:bg-stone-900 rounded-2xl shadow-md border border-stone-100 dark:border-stone-800 p-5">
                <h3 class="font-semibold text-stone-800 dark:text-stone-100 mb-3">Members</h3>
                <div class="grid grid-cols-4 gap-3">
                    <?php $__currentLoopData = $community->members->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($member->profile_photo_url); ?>"
                            class="w-14 h-14 rounded-full mx-auto object-cover border border-stone-100 dark:border-stone-700">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>

    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => { lucide.createIcons() });
        const csrfToken = '<?php echo e(csrf_token()); ?>';

        function toggleCommentsBox(postId) { document.getElementById(`comments-box-${postId}`).classList.toggle("hidden"); }

        function toggleCommunityTap(postId, btn) {
            if(btn.disabled) return;
            btn.disabled = true;
            
            // Interaction animation feedback
            const icon = btn.querySelector('i');
            icon.classList.add('scale-125');
            setTimeout(() => icon.classList.remove('scale-125'), 150);

            fetch(`/community-posts/${postId}/tap`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
                .then(res => res.json()).then(data => {
                    const countEl = document.getElementById(`tap-count-${postId}`);
                    if (countEl) countEl.textContent = data.count;
                    if (data.tapped) { 
                        btn.classList.add('bg-red-50', 'text-red-600', 'dark:bg-red-900/20', 'dark:text-red-400');
                        btn.classList.remove('text-stone-600', 'dark:text-stone-400', 'hover:bg-stone-50', 'dark:hover:bg-stone-800');
                        icon.classList.add('fill-current', 'scale-110');
                        icon.classList.remove('scale-100');
                    }
                    else { 
                        btn.classList.remove('bg-red-50', 'text-red-600', 'dark:bg-red-900/20', 'dark:text-red-400');
                        btn.classList.add('text-stone-600', 'dark:text-stone-400', 'hover:bg-stone-50', 'dark:hover:bg-stone-800');
                        icon.classList.remove('fill-current', 'scale-110');
                        icon.classList.add('scale-100');
                    }
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

        function toggleReplyBox(commentId) { 
            const box = document.getElementById(`reply-form-${commentId}`);
            if(box) box.classList.toggle('hidden'); 
        }

        function submitReply(e, postId, parentId) {
            e.preventDefault();
            const input = document.getElementById(`reply-input-${parentId}`);
            const content = input.value.trim();
            if (!content) return;
            input.disabled = true;

            fetch(`/community-posts/${postId}/comment`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ content, parent_id: parentId })
            }).then(res => res.json()).then(data => {
                const repliesBox = document.getElementById(`replies-box-${parentId}`);
                const newReply = document.createElement('div');
                newReply.className = 'flex gap-3 items-start';
                newReply.innerHTML = `
                    <img src="${data.user.profile_photo_url || '/images/default-avatar.png'}" class="w-7 h-7 rounded-full object-cover">
                    <div class="bg-stone-50 dark:bg-stone-800 rounded-2xl p-3 flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-stone-800 dark:text-stone-100">${data.user.name}</p>
                                <p class="text-xs text-stone-400 dark:text-stone-500">Just now</p>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-stone-700 dark:text-stone-300">${data.content}</p>
                    </div>
                `;
                repliesBox.appendChild(newReply);
                document.getElementById(`comment-count-${postId}`).textContent = parseInt(document.getElementById(`comment-count-${postId}`).textContent) + 1;
                input.value = '';
                toggleReplyBox(parentId);
            }).finally(() => input.disabled = false);
        }

        function switchCommunityTab(tab) {
            document.getElementById('section-feed').classList.add('hidden');
            document.getElementById('section-meetings').classList.add('hidden');
            
            document.getElementById('tab-feed').classList.remove('border-amber-500', 'text-amber-600', 'dark:text-amber-500');
            document.getElementById('tab-feed').classList.add('border-transparent', 'text-stone-500');
            document.getElementById('tab-meetings').classList.remove('border-amber-500', 'text-amber-600', 'dark:text-amber-500');
            document.getElementById('tab-meetings').classList.add('border-transparent', 'text-stone-500');

            document.getElementById(`section-${tab}`).classList.remove('hidden');
            document.getElementById(`tab-${tab}`).classList.remove('border-transparent', 'text-stone-500');
            document.getElementById(`tab-${tab}`).classList.add('border-amber-500', 'text-amber-600', 'dark:text-amber-500');
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/communities/show.blade.php ENDPATH**/ ?>