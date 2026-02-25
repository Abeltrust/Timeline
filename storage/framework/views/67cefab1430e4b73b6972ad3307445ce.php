

<?php $__env->startSection('title', 'Timeline - Your Cultural Journey'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto p-4 sm:p-6">
        <?php if(auth()->guard()->guest()): ?>
            <!-- Welcome Section for Guests -->
            <div
                class="bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 rounded-2xl p-6 sm:p-8 border border-amber-200 mb-8">
                <div class="text-center mb-8">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="book-open" class="w-7 h-7 sm:w-8 sm:h-8 text-white"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-stone-800 mb-3">
                        Welcome to Timeline
                    </h2>
                    <p class="text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl mx-auto">
                        Your life. Your culture. Your story. A new kind of social platform designed to capture
                        the complete story of your journey while preserving the heritage that shapes us all.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <h3 class="font-semibold text-stone-800 mb-2">Authentic Stories</h3>
                        <p class="text-sm text-stone-600">Share your real journey chronologically, not algorithmically</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="globe" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <h3 class="font-semibold text-stone-800 mb-2">Cultural Heritage</h3>
                        <p class="text-sm text-stone-600">Preserve and celebrate cultures from around the world</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="users" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h3 class="font-semibold text-stone-800 mb-2">Meaningful Connections</h3>
                        <p class="text-sm text-stone-600">Lock-In to timelines that matter, TAP to show appreciation</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="archive" class="w-6 h-6 text-orange-600"></i>
                        </div>
                        <h3 class="font-semibold text-stone-800 mb-2">Personal Vault</h3>
                        <p class="text-sm text-stone-600">Keep your most precious memories safe and private</p>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-stone-600 mb-4">Ready to start your timeline?</p>
                    <a href="<?php echo e(route('register')); ?>"
                        class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 sm:px-8 py-3 rounded-xl font-semibold hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        Join Timeline
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-stone-800 mb-1">Your Timeline</h2>
                        <p class="text-stone-600 text-sm sm:text-base">Stories unfolding in real time, just as life happens.</p>
                    </div>
                </div>
                <div class="flex space-x-2 overflow-x-auto scrollbar-hide pb-2">
                    <a href="<?php echo e(route('timeline.index', ['filter' => 'all'])); ?>"
                        class="flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition <?php echo e($filter === 'all' ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white' : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300'); ?>">
                        Stories
                    </a>
                    <a href="<?php echo e(route('timeline.index', ['filter' => 'lockedin'])); ?>"
                        class="flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition <?php echo e($filter === 'lockedin' ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white' : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300'); ?>">
                        Locked-In
                    </a>
                    <a href="<?php echo e(route('timeline.index', ['filter' => 'cultural'])); ?>"
                        class="flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition <?php echo e($filter === 'cultural' ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white' : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300'); ?>">
                        Cultural
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Feed -->
        <div class="space-y-6">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article
                    class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-stone-100 hover:shadow-md transition-all duration-300">
                    <div class="flex flex-col sm:flex-row items-start sm:space-x-4">
                        <!-- Post Content -->
                        <div class="flex-1 w-full">
                            <!-- Header -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3">
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-sm sm:text-base">
                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo e($post->user->profile_photo_url); ?>"
                                            class="w-10 h-10 rounded-full object-cover border border-stone-100 shadow-sm">
                                    </div>

                                    <!-- User Info -->
                                    <a href="<?php echo e(route('profile.user', $post->user)); ?>"
                                        class="font-semibold text-stone-800 hover:text-amber-600">
                                        <?php echo e($post->user->name); ?>

                                    </a>
                                    <span class="text-stone-400 text-xs sm:text-sm">@ <?php echo e($post->user->username); ?></span>

                                    <?php if($post->user->location): ?>
                                        <span class="text-xs bg-stone-100 text-stone-600 px-2 py-0.5 rounded-full">
                                            <?php echo e($post->user->location); ?>

                                        </span>
                                    <?php endif; ?>

                                    <!-- Divider Dot -->
                                    <span class="hidden sm:inline text-stone-300">•</span>

                                    <!-- Meta Info -->
                                    <span class="flex items-center space-x-1 text-stone-500">
                                        <i data-lucide="clock" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                        <span><?php echo e($post->time_ago); ?></span>
                                    </span>

                                    <?php if($post->location): ?>
                                        <span class="flex items-center space-x-1 text-stone-500">
                                            <i data-lucide="map-pin" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                            <span><?php echo e($post->location); ?></span>
                                        </span>
                                    <?php endif; ?>

                                    <?php if($post->chapter): ?>
                                        <span
                                            class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                            <?php echo e($post->chapter); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if($post->privacy === 'private'): ?>
                                    <i data-lucide="lock" class="w-4 h-4 text-stone-400 mt-2 sm:mt-0"></i>
                                <?php endif; ?>
                            </div>

                            <!-- Body -->
                            <div class="mb-4">
                                <p class="text-stone-700 leading-relaxed text-sm sm:text-base"><?php echo e($post->content); ?></p>
                                <?php if($post->image): ?>
                                    <div class="mt-4 rounded-xl overflow-hidden">
                                        <img src="<?php echo e(Storage::url($post->image)); ?>"
                                            class="w-full max-h-[600px] object-contain  rounded-md w-full sm:max-h-[28rem]">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div
                                class="flex flex-wrap justify-center items-center gap-2 sm:gap-3 pt-3 sm:pt-4 border-t border-stone-100 text-xs sm:text-sm md:text-base">
                                <?php if(auth()->guard()->check()): ?>
                                    <!-- TAP -->
                                    <button onclick="toggleTap(<?php echo e($post->id); ?>)" data-tap-post="<?php echo e($post->id); ?>"
                                        class="flex items-center space-x-1 sm:space-x-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg transition 
                                                                        <?php echo e(auth()->user()->hasTapped($post) ? 'bg-red-50 text-red-600' : 'text-stone-600 hover:bg-stone-100'); ?>">
                                        <i data-lucide="heart"
                                            class="w-3 h-3 sm:w-4 sm:h-4 <?php echo e(auth()->user()->hasTapped($post) ? 'fill-current' : ''); ?>"></i>
                                        <span class="font-medium" data-tap-count="<?php echo e($post->id); ?>">
                                            <?php echo e($post->taps_count); ?>

                                        </span>
                                    </button>

                                    <!-- Resonance -->
                                    <button onclick="toggleResonanceBox(<?php echo e($post->id); ?>)"
                                        class="flex items-center space-x-1 sm:space-x-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg transition text-stone-600 hover:bg-stone-100">
                                        <i data-lucide="message-circle" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                        <span class="font-medium"
                                            data-resonance-count="<?php echo e($post->id); ?>"><?php echo e($post->resonances->count()); ?> </span>
                                    </button>

                                    <!-- Check-In -->
                                    <button onclick="toggleCheckin(<?php echo e($post->id); ?>)" data-checkin-post="<?php echo e($post->id); ?>"
                                        class="flex items-center space-x-1 sm:space-x-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg transition text-stone-600 hover:bg-stone-100">
                                        <i data-lucide="check-circle" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                        <span class="font-medium" data-checkin-count="<?php echo e($post->id); ?>">
                                            <?php echo e($post->check_ins_count); ?>

                                        </span>
                                    </button>

                                    <!-- Share -->
                                    <button onclick="openShareModal('<?php echo e(url('/timeline/' . $post->id)); ?>')"
                                        class="flex items-center space-x-1 sm:space-x-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg transition text-stone-600 hover:bg-stone-100">
                                        <i data-lucide="share-2" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                                        <span class="font-medium"></span>
                                    </button>
                                <?php endif; ?>
                            </div>


                            <!-- Resonance Box -->
                            <div id="resonance-box-<?php echo e($post->id); ?>" class="hidden mt-4">
                                <div class="space-y-2 sm:space-y-3">
                                    <?php $__currentLoopData = $post->resonances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resonance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="p-2 sm:p-3 bg-stone-50 rounded-lg">
                                            <span
                                                class="font-medium text-stone-800 text-xs sm:text-sm text-strong"><?php echo e($resonance->user->name); ?></span>
                                            <p class="text-stone-700 text-xs sm:text-sm leading-snug"><?php echo e($resonance->content); ?></p>
                                            <span
                                                class="text-[10px] sm:text-xs text-stone-500"><?php echo e($resonance->created_at->diffForHumans()); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <?php if(auth()->guard()->check()): ?>
                                    <div class="flex items-center mt-2 sm:mt-3 space-x-1 sm:space-x-2">
                                        <input type="text" id="resonance-input-<?php echo e($post->id); ?>" placeholder="Write a resonance..."
                                            class="flex-1 border rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none">
                                        <button onclick="submitResonance(<?php echo e($post->id); ?>)"
                                            class="p-2 sm:p-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition flex items-center justify-center">
                                            <i data-lucide="send" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                        </button>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-12">
                    <i data-lucide="book-open" class="w-14 h-14 sm:w-16 sm:h-16 text-stone-300 mx-auto mb-4"></i>
                    <h3 class="text-base sm:text-lg font-semibold text-stone-600 mb-2">No stories yet</h3>
                    <p class="text-stone-500 mb-4">
                        <?php if(auth()->guard()->check()): ?> Be the first to share your story! <?php else: ?> Join Timeline to start sharing. <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <?php if($posts->hasPages()): ?>
            <div class="mt-8 flex justify-center"><?php echo e($posts->links()); ?></div>
        <?php endif; ?>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-3 sm:p-0">
        <div
            class="bg-white rounded-xl sm:rounded-2xl shadow-lg w-full max-w-sm sm:max-w-md p-4 sm:p-6 relative text-xs sm:text-sm">
            <!-- Close Button -->
            <button onclick="closeShareModal()"
                class="absolute top-2 right-2 sm:top-3 sm:right-3 text-gray-500 hover:text-gray-700">
                <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>
            </button>

            <!-- Header -->
            <h2 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4 flex items-center gap-2">
                <i data-lucide="share-2" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                Share this story
            </h2>

            <!-- Share Options -->
            <div class="space-y-2 sm:space-y-3">
                <button onclick="copyLink()"
                    class="flex items-center gap-2 sm:gap-3 w-full bg-gray-100 hover:bg-gray-200 p-2 sm:p-3 rounded-lg transition">
                    <i data-lucide="copy" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600"></i>
                    <span class="text-xs sm:text-sm">Copy Link</span>
                </button>

                <a id="wa-share" href="#" target="_blank"
                    class="flex items-center gap-2 sm:gap-3 w-full bg-green-100 hover:bg-green-200 p-2 sm:p-3 rounded-lg transition">
                    <i data-lucide="message-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-green-600"></i>
                    <span class="text-xs sm:text-sm">Share on WhatsApp</span>
                </a>

                <a id="fb-share" href="#" target="_blank"
                    class="flex items-center gap-2 sm:gap-3 w-full bg-blue-100 hover:bg-blue-200 p-2 sm:p-3 rounded-lg transition">
                    <i data-lucide="facebook" class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600"></i>
                    <span class="text-xs sm:text-sm">Share on Facebook</span>
                </a>

                <a id="tw-share" href="#" target="_blank"
                    class="flex items-center gap-2 sm:gap-3 w-full bg-sky-100 hover:bg-sky-200 p-2 sm:p-3 rounded-lg transition">
                    <i data-lucide="twitter" class="w-4 h-4 sm:w-5 sm:h-5 text-sky-600"></i>
                    <span class="text-xs sm:text-sm">Share on Twitter</span>
                </a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => lucide.createIcons());

        let currentShareUrl = "";

        // Open modal
        function openShareModal(url) {
            currentShareUrl = url;
            document.getElementById("shareModal").classList.remove("hidden");
            document.getElementById("shareModal").classList.add("flex");

            document.getElementById("wa-share").href = `https://wa.me/?text=${encodeURIComponent(url)}`;
            document.getElementById("fb-share").href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            document.getElementById("tw-share").href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`;
        }

        // Close modal
        function closeShareModal() {
            document.getElementById("shareModal").classList.add("hidden");
            document.getElementById("shareModal").classList.remove("flex");
        }

        // Copy link function
        function copyLink() {
            navigator.clipboard.writeText(currentShareUrl).then(() => {
                alert("Link copied to clipboard!");
            });
        }

        // Toggle TAP
        function toggleTap(postId) {
            let btn = document.querySelector(`[data-tap-post="${postId}"]`);
            let countSpan = document.querySelector(`[data-tap-count="${postId}"]`);
            let icon = btn.querySelector('i');

            // Optimistic UI update
            let isTapped = btn.classList.contains('text-red-600');
            let currentCount = parseInt(countSpan.textContent) || 0;

            if (isTapped) {
                btn.classList.remove('bg-red-50', 'text-red-600');
                btn.classList.add('text-stone-600', 'hover:bg-stone-100');
                icon.classList.remove('fill-current');
                countSpan.textContent = Math.max(0, currentCount - 1);
            } else {
                btn.classList.add('bg-red-50', 'text-red-600');
                btn.classList.remove('text-stone-600', 'hover:bg-stone-100');
                icon.classList.add('fill-current');
                countSpan.textContent = currentCount + 1;
            }

            fetch(`/timeline/${postId}/tap`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
            })
                .then(res => res.json())
                .then(data => {
                    // Sync with server data
                    countSpan.textContent = data.count;
                    if (data.tapped) {
                        btn.classList.add('bg-red-50', 'text-red-600');
                        icon.classList.add('fill-current');
                    } else {
                        btn.classList.remove('bg-red-50', 'text-red-600');
                        icon.classList.remove('fill-current');
                    }
                })
                .catch(err => {
                    // Revert on error
                    console.error('TAP error:', err);
                    if (isTapped) {
                        btn.classList.add('bg-red-50', 'text-red-600');
                        icon.classList.add('fill-current');
                        countSpan.textContent = currentCount;
                    } else {
                        btn.classList.remove('bg-red-50', 'text-red-600');
                        icon.classList.remove('fill-current');
                        countSpan.textContent = currentCount;
                    }
                });
        }

        // Toggle Check-In
        function toggleCheckin(postId) {
            let btn = document.querySelector(`[data-checkin-post="${postId}"]`);
            let countSpan = document.querySelector(`[data-checkin-count="${postId}"]`);
            
            // Optimistic UI update
            let isCheckedIn = btn.classList.contains('text-green-600');
            let currentCount = parseInt(countSpan.textContent) || 0;
            
            if (isCheckedIn) {
                btn.classList.remove('text-green-600');
                countSpan.textContent = Math.max(0, currentCount - 1);
            } else {
                btn.classList.add('text-green-600');
                countSpan.textContent = currentCount + 1;
            }

            fetch(`/timeline/${postId}/checkin`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
            })
                .then(res => res.json())
                .then(data => {
                    countSpan.textContent = data.count;
                    if (data.checkedIn) {
                        btn.classList.add('text-green-600');
                    } else {
                        btn.classList.remove('text-green-600');
                    }
                })
                .catch(err => {
                    console.error('Checkin error:', err);
                    if (isCheckedIn) {
                        btn.classList.add('text-green-600');
                    } else {
                        btn.classList.remove('text-green-600');
                    }
                    countSpan.textContent = currentCount;
                });
        }

        // Toggle Resonance Box
        function toggleResonanceBox(postId) {
            const box = document.getElementById(`resonance-box-${postId}`);
            box.classList.toggle("hidden");
        }

        // Submit Resonance
        function submitResonance(postId) {
            const input = document.getElementById(`resonance-input-${postId}`);
            const content = input.value.trim();
            if (!content) return;

            fetch(`/timeline/${postId}/resonance`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ content })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const box = document.querySelector(`#resonance-box-${postId} .space-y-2, #resonance-box-${postId} .space-y-3`);
                        if (box) {
                            box.insertAdjacentHTML('beforeend', `
                                    <div class="p-2 sm:p-3 bg-stone-50 rounded-lg">
                                        <span class="font-medium text-stone-800 text-xs sm:text-sm">${data.resonance.user.name}</span>
                                        <p class="text-stone-700 text-xs sm:text-sm leading-snug">${data.resonance.content}</p>
                                        <span class="text-[10px] sm:text-xs text-stone-500">${data.resonance.time}</span>
                                    </div>
                                `);
                        }
                        input.value = '';
                        document.querySelector(`[data-resonance-count="${postId}"]`).innerText = `${data.count} Resonance`;
                        lucide.createIcons(); // re-render icon if needed
                    }
                })
                .catch(err => console.error('Error:', err));
        }

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/timeline/index.blade.php ENDPATH**/ ?>