


<?php $__env->startSection('content'); ?>
    <div class="flex flex-col min-h-screen bg-stone-50 overflow-x-hidden w-full box-border">
        <div class="max-w-4xl mx-auto p-3 sm:p-6 space-y-4 sm:space-y-6 w-full box-border">

            
            <div
                class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100 overflow-hidden relative mb-4">
                
                <div class="w-full h-24 sm:h-48 bg-gradient-to-r from-amber-400 via-orange-500 to-rose-500"></div>

                
                <div class="px-3 pb-5 sm:px-8 relative flex flex-col items-center">
                    
                    <div
                        class="relative w-20 h-20 sm:w-36 sm:h-36 rounded-full border-4 border-white shadow-md overflow-hidden bg-stone-100 -mt-10 sm:-mt-18 flex-shrink-0 z-10">
                        <img src="<?php echo e($user->profile_photo_url); ?>" alt="<?php echo e($user->name); ?>"
                            class="w-full h-full object-cover">

                        
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->id() === $user->id): ?>
                                <form action="<?php echo e(route('profile.photo.upload')); ?>" method="POST" enctype="multipart/form-data"
                                    class="absolute bottom-0 right-0 z-20">
                                    <?php echo csrf_field(); ?>
                                    <label
                                        class="cursor-pointer bg-white p-1.5 rounded-full shadow border border-stone-100 hover:bg-stone-50 transition flex items-center justify-center">
                                        <input type="file" name="profile_photo" class="hidden" onchange="this.form.submit()">
                                        <i data-lucide="camera" class="w-4 h-4 text-orange-500"></i>
                                    </label>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    
                    <div class="text-center mt-2 sm:mt-3 w-full">
                        <h1 class="text-lg sm:text-2xl font-black text-stone-800 truncate"><?php echo e($user->name); ?></h1>
                        <p class="text-xs sm:text-sm text-stone-500 mt-1 max-w-md mx-auto leading-relaxed">
                            <?php echo e($user->bio ?? 'Software Architect & Cultural Preservationist | Building bridges between tech & heritage'); ?>

                        </p>
                    </div>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() === $user->id): ?>
                            <a href="<?php echo e(route('profile.edit')); ?>"
                                class="inline-flex items-center justify-center mt-4 sm:mt-5 px-5 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition-all active:scale-95">
                                Edit Profile
                            </a>
                        <?php else: ?>
                            <div class="mt-4 sm:mt-5 flex flex-wrap justify-center gap-2 sm:gap-3 w-full max-w-sm mx-auto">
                                <!-- Vibe Button -->
                                <button onclick="toggleUserTap(<?php echo e($user->id); ?>)" id="profile-vibe-btn"
                                    class="flex items-center justify-center space-x-1.5 px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl text-xs font-semibold transition-all shadow-sm flex-1 sm:flex-none
                                                                                                    <?php echo e(isset($hasVibed) && $hasVibed ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-white border border-stone-200 text-stone-700 hover:bg-stone-50'); ?>">
                                    <i data-lucide="thumbs-up" id="profile-vibe-icon"
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 <?php echo e(isset($hasVibed) && $hasVibed ? 'fill-current' : ''); ?>"></i>
                                    <span id="profile-vibe-text"><?php echo e(isset($hasVibed) && $hasVibed ? 'Vibed' : 'Vibe'); ?></span>
                                </button>

                                <!-- Lock-in Button -->
                                <button onclick="toggleUserLockIn(<?php echo e($user->id); ?>)" id="profile-lockin-btn"
                                    class="flex items-center justify-center space-x-1.5 px-4 sm:px-6 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all shadow-sm flex-1 sm:flex-none
                                                                                                    <?php echo e(isset($isLockedIn) && $isLockedIn ? 'bg-stone-100 text-stone-700 hover:bg-red-50 hover:text-red-600' : 'bg-gradient-to-r from-amber-500 to-orange-600 text-white hover:shadow-md hover:scale-[1.02]'); ?>">
                                    <i data-lucide="<?php echo e(isset($isLockedIn) && $isLockedIn ? 'user-check' : 'user-plus'); ?>"
                                        id="profile-lockin-icon" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                    <span
                                        id="profile-lockin-text"><?php echo e(isset($isLockedIn) && $isLockedIn ? 'Locked In' : 'Lock In'); ?></span>
                                </button>

                                <!-- Send Message Button (Restricted) -->
                                <?php if(isset($isLockedIn) && $isLockedIn): ?>
                                    <a href="<?php echo e(route('messages.start', $user->id)); ?>"
                                        class="flex items-center justify-center space-x-1.5 px-3 sm:px-5 py-2 sm:py-2.5 bg-stone-800 text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm hover:bg-stone-900 transition-all flex-none">
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                        <span class="hidden sm:inline">Message</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 text-center mb-2">
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-5 border border-stone-100 transition hover:shadow-md">
                    <p class="text-lg sm:text-2xl font-black text-stone-800"><?php echo e($user->posts_count ?? 0); ?></p>
                    <p class="text-[10px] sm:text-xs font-bold text-stone-400 mt-1 uppercase tracking-wider">Stories</p>
                </div>
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-5 border border-stone-100 transition hover:shadow-md">
                    <p class="text-lg sm:text-2xl font-black text-stone-800" id="profile-locked-in-count">
                        <?php echo e($user->locked_in_count ?? 0); ?>

                    </p>
                    <p class="text-[10px] sm:text-xs font-bold text-stone-400 mt-1 uppercase tracking-wider">Locked-In</p>
                </div>
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-5 border border-stone-100 transition hover:shadow-md">
                    <p class="text-lg sm:text-2xl font-black text-stone-800" id="profile-vibes-count">
                        <?php echo e($user->taps_received ?? 0); ?>

                    </p>
                    <p class="text-[10px] sm:text-xs font-bold text-stone-400 mt-1 uppercase tracking-wider">Vibes</p>
                </div>
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-5 border border-stone-100 transition hover:shadow-md">
                    <p class="text-lg sm:text-2xl font-black text-stone-800"><?php echo e($user->life_chapters_count ?? 0); ?></p>
                    <p class="text-[10px] sm:text-xs font-bold text-stone-400 mt-1 uppercase tracking-wider">Chapters</p>
                </div>
            </div>

            
            <?php if(auth()->id() === $user->id || (isset($isLockedIn) && $isLockedIn)): ?>
                <div class="bg-white rounded-3xl shadow-sm p-5 sm:p-6 border border-stone-100 mb-8">
                    <div class="flex gap-6 border-b border-stone-100 mb-5 overflow-x-auto scrollbar-hide">
                        <button class="text-sm font-bold pb-3 border-b-2 border-orange-500 text-stone-800 flex-shrink-0">Life
                            Story</button>
                        <button
                            class="text-sm font-semibold pb-3 text-stone-400 hover:text-stone-800 transition flex-shrink-0">Cultural
                            Identity</button>
                        <button
                            class="text-sm font-semibold pb-3 text-stone-400 hover:text-stone-800 transition flex-shrink-0">Achievements</button>
                        <button
                            class="text-sm font-semibold pb-3 text-stone-400 hover:text-stone-800 transition flex-shrink-0">Private
                            Vault</button>
                    </div>

                    
                    <div class="space-y-3">
                        <?php $__currentLoopData = $user->lifeChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                class="bg-stone-50 p-3 rounded-xl border border-stone-100 flex flex-col sm:flex-row justify-between items-start gap-3">
                                <div class="flex gap-3 items-start flex-1">
                                    <div class="p-2 bg-orange-400 rounded-lg text-white flex-shrink-0">
                                        <i data-lucide="book" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-stone-800 text-sm sm:text-base"><?php echo e($chapter->title); ?></h3>
                                        <p class="text-stone-600 text-xs sm:text-sm mt-0.5"><?php echo e($chapter->description); ?></p>
                                        <p class="text-xs text-stone-400 mt-1"><?php echo e($chapter->location ?? 'Jos, Nigeria'); ?> •
                                            <?php echo e($chapter->stories_count ?? 0); ?> Stories
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs text-stone-400 mt-1 sm:mt-0"><?php echo e($chapter->start_year); ?> -
                                    <?php echo e($chapter->end_year ?? 'Present'); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->id() === $user->id): ?>
                                <a href=""
                                    class="inline-flex items-center gap-2 px-3 py-1.5 text-orange-500 border border-orange-300 rounded-lg hover:bg-orange-50 transition text-sm">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Add Chapter
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                
                <div class="bg-white rounded-2xl shadow p-8 border border-stone-100 mx-3 sm:mx-0 text-center">
                    <div
                        class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-stone-200">
                        <i data-lucide="lock" class="w-8 h-8 text-stone-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-stone-800 mb-2">Restricted Profile</h3>
                    <p class="text-stone-500 text-sm max-w-sm mx-auto mb-6">
                        Lock in with <?php echo e(explode(' ', trim($user->name))[0]); ?> to see their full life story, cultural identity,
                        and send them direct messages.
                    </p>
                    <button onclick="toggleUserLockIn(<?php echo e($user->id); ?>)"
                        class="inline-flex items-center space-x-2 px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-sm font-bold shadow-md hover:shadow-lg transition-all">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Lock In Now</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });

        <?php if(auth()->guard()->check()): ?>
                // Toggle User Vibe (Tap)
                function toggleUserTap(userId) {
                    fetch(`/users/${userId}/tap`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }
                            const icon = document.getElementById(`profile-vibe-icon`);
                            const count = document.getElementById(`profile-vibes-count`);
                            const text = document.getElementById(`profile-vibe-text`);
                            const btn = document.getElementById(`profile-vibe-btn`);

                            if (count) count.textContent = data.count;

                            if (data.tapped) {
                                btn.className = "flex items-center justify-center space-x-1.5 px-4 py-2 rounded-xl text-xs font-semibold transition-all shadow-sm bg-amber-100 text-amber-700 hover:bg-amber-200";
                                icon.classList.add('fill-current');
                                text.textContent = 'Vibed';
                            } else {
                                btn.className = "flex items-center justify-center space-x-1.5 px-4 py-2 rounded-xl text-xs font-semibold transition-all shadow-sm bg-white border border-stone-200 text-stone-700 hover:bg-stone-50";
                                icon.classList.remove('fill-current');
                                text.textContent = 'Vibe';
                            }
                        })
                        .catch(error => console.error('Error toggling vibe:', error));
                }

            // Toggle User Lock-in
            function toggleUserLockIn(userId) {
                fetch(`/users/${userId}/lockin`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }
                        // Just refresh the entire page so the user can immediately see the new restricted layout / get message access
                        window.location.reload();
                    })
                    .catch(error => console.error('Error toggling lock-in:', error));
            }
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/profile/index.blade.php ENDPATH**/ ?>