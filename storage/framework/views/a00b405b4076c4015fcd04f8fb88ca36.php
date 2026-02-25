

<?php $__env->startSection('title', $culture->name . ' - Cultural Hub'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Breadcrumbs & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-2 text-stone-500 text-sm">
                <a href="<?php echo e(route('cultural-hub.index')); ?>"
                    class="hover:text-amber-600 transition-colors uppercase tracking-widest font-bold text-[10px]">Cultural
                    Hub</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-stone-800 font-bold uppercase tracking-widest text-[10px]"><?php echo e($culture->name); ?></span>
            </div>

            <div class="flex items-center space-x-3">
                <?php if($culture->status === 'pending_review'): ?>
                    <span
                        class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest flex items-center shadow-sm border border-amber-200">
                        <i data-lucide="clock" class="w-3.5 h-3.5 mr-2"></i>
                        Pending Review
                    </span>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <button onclick="toggleCultureLockin(<?php echo e($culture->id); ?>)" data-culture-lockin="<?php echo e($culture->id); ?>"
                        class="px-6 py-2 rounded-xl font-bold text-xs transition-all duration-300 <?php echo e(auth()->user()->hasLockedIn($culture) ? 'bg-amber-600 text-white shadow-lg' : 'bg-white text-stone-600 border border-stone-200 hover:bg-stone-50'); ?> flex items-center space-x-2">
                        <i data-lucide="<?php echo e(auth()->user()->hasLockedIn($culture) ? 'check' : 'lock'); ?>" class="w-4 h-4"></i>
                        <span><?php echo e(auth()->user()->hasLockedIn($culture) ? 'Locked-In' : 'Lock-In Presence'); ?></span>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
            <!-- Main Content (Left Column) -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Hero Card -->
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl border border-stone-100 group">
                    <?php if($culture->image): ?>
                        <img src="<?php echo e(Storage::url($culture->image)); ?>" alt="<?php echo e($culture->name); ?>"
                            class="w-full h-[400px] sm:h-[500px] object-cover">
                        <?php if($culture->image_license): ?>
                            <div
                                class="absolute bottom-4 right-4 backdrop-blur-md bg-stone-900/30 text-white/80 px-3 py-1 rounded-lg text-[9px] uppercase tracking-widest font-medium border border-white/10">
                                &copy; <?php echo e($culture->image_license); ?>

                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div
                            class="w-full h-[400px] sm:h-[500px] bg-gradient-to-br from-amber-500/10 to-orange-600/10 flex items-center justify-center">
                            <i data-lucide="globe" class="w-32 h-32 text-amber-600/20"></i>
                        </div>
                    <?php endif; ?>

                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-transparent to-transparent"></div>

                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <span
                            class="inline-block bg-amber-500 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                            <?php echo e($culture->category); ?>

                        </span>
                        <h1 class="text-4xl sm:text-5xl font-black mb-2 tracking-tight"><?php echo e($culture->name); ?></h1>
                        <div class="flex items-center text-stone-300 font-bold uppercase tracking-widest text-xs">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-amber-500"></i>
                            <?php echo e($culture->region); ?>

                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose prose-stone prose-lg max-w-none">
                    <div
                        class="flex items-center space-x-2 text-amber-600 mb-6 uppercase tracking-tighter text-xs font-black">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                        <span>The Essence of Tradition</span>
                    </div>
                    <p
                        class="text-stone-600 dark:text-stone-300 leading-relaxed text-xl font-medium italic mb-8 border-l-4 border-amber-500 pl-6 py-2">
                        "<?php echo e($culture->description); ?>"
                    </p>
                    <div class="text-stone-700 dark:text-stone-400 space-y-6 leading-loose">
                        <!-- Additional details could be added here if we had more fields -->
                        <p>This cultural heritage represents deep-rooted values and practices passed down through
                            generations in the <?php echo e($culture->region); ?> region. It stands as a testament to the resilience and
                            creativity of its people.</p>
                    </div>
                </div>

                <!-- Multimedia Players -->
                <?php if($culture->video_url || $culture->audio_url): ?>
                    <div class="space-y-8 pt-12 border-t border-stone-100">
                        <div class="flex items-center space-x-2 text-amber-600 uppercase tracking-tighter text-xs font-black">
                            <i data-lucide="play-circle" class="w-4 h-4"></i>
                            <span>Multimedia Experiences</span>
                        </div>

                        <?php if($culture->video_url): ?>
                            <div class="relative rounded-3xl overflow-hidden shadow-xl bg-stone-900 aspect-video group">
                                <?php
                                    $videoId = null;
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $culture->video_url, $match)) {
                                        $videoId = $match[1];
                                    }
                                ?>

                                <?php if($videoId): ?>
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?php echo e($videoId); ?>" frameborder="0"
                                        allowfullscreen></iframe>
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-stone-500 p-8 text-center">
                                        <i data-lucide="video" class="w-12 h-12 mb-4 opacity-20"></i>
                                        <p class="text-sm font-bold uppercase tracking-widest">Video Experience Available</p>
                                        <a href="<?php echo e($culture->video_url); ?>" target="_blank"
                                            class="mt-4 px-6 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-xs font-bold transition-all">Watch
                                            Preview</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if($culture->audio_url): ?>
                            <div
                                class="rounded-3xl p-6 bg-gradient-to-r from-stone-900 to-stone-800 shadow-xl border border-stone-700">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg animate-pulse">
                                            <i data-lucide="audio-lines" class="w-6 h-6 text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-black text-sm uppercase tracking-widest">Sound of Heritage</p>
                                            <p class="text-stone-400 text-[10px] uppercase font-bold tracking-tighter">Audio
                                                Transmission Available</p>
                                        </div>
                                    </div>
                                    <a href="<?php echo e($culture->audio_url); ?>" target="_blank"
                                        class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-black transition-all shadow-md">
                                        LISTEN
                                    </a>
                                </div>
                                <div class="h-1 bg-stone-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-500 w-1/3"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="space-y-8">
                <!-- Guardian Info Card -->
                <div
                    class="bg-stone-50 dark:bg-stone-900 border border-stone-100 dark:border-stone-800 rounded-[2rem] p-8 shadow-sm">
                    <div class="text-center">
                        <div
                            class="inline-flex w-20 h-20 rounded-[1.5rem] bg-amber-500 items-center justify-center text-white mb-4 shadow-xl shadow-amber-500/20 rotate-3">
                            <i data-lucide="shield-check" class="w-10 h-10"></i>
                        </div>
                        <h2 class="text-stone-900 dark:text-white font-black text-lg uppercase tracking-tight">Cultural
                            Guardian</h2>
                        <p class="text-sm font-bold text-amber-600 mb-6 tracking-widest uppercase">
                            <?php echo e($culture->submitter->name ?? 'Anonymous Guest'); ?></p>

                        <div class="space-y-4 pt-6 border-t border-stone-200 dark:border-stone-800">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-stone-500 font-bold uppercase tracking-widest">Contributed On</span>
                                <span
                                    class="text-stone-800 dark:text-stone-300 font-black"><?php echo e($culture->created_at->format('M d, Y')); ?></span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-stone-500 font-bold uppercase tracking-widest">Guardian Rank</span>
                                <span class="text-amber-600 font-black">ELDER PRESERVER</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="<?php echo e(route('profile.user', $culture->submitted_by)); ?>"
                                class="w-full inline-flex items-center justify-center py-3 bg-stone-900 dark:bg-white dark:text-stone-900 text-white rounded-2xl text-xs font-black tracking-widest hover:scale-[1.02] transition-transform">
                                VIEW STORY
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Interactions Summary -->
                <div
                    class="bg-amber-50 dark:bg-amber-950/20 rounded-[2rem] p-8 border border-amber-100 dark:border-amber-900">
                    <h3 class="text-amber-800 dark:text-amber-400 font-black text-xs uppercase tracking-widest mb-6">
                        Collective Pulse</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="p-4 bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-amber-100 dark:border-amber-900 flex flex-col items-center">
                            <span class="text-2xl font-black text-amber-600"><?php echo e($culture->locked_in_count); ?></span>
                            <span
                                class="text-[9px] font-black text-stone-400 uppercase tracking-widest mt-1 text-center">Locked-In
                                PRESENCE</span>
                        </div>
                        <div
                            class="p-4 bg-white dark:bg-stone-900 rounded-2xl shadow-sm border border-amber-100 dark:border-amber-900 flex flex-col items-center">
                            <span class="text-2xl font-black text-orange-600"><?php echo e($culture->resonance_count); ?></span>
                            <span
                                class="text-[9px] font-black text-stone-400 uppercase tracking-widest mt-1 text-center">EMPATHIC
                                RESONANCE</span>
                        </div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="mt-6 pt-6 border-t border-amber-200 dark:border-amber-900">
                            <p class="text-[10px] text-amber-700 dark:text-amber-500 font-bold italic text-center">Your
                                interaction helps preserve this heritage in the digital vault.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());

        function toggleCultureLockin(id) {
            fetch(`/cultures/${id}/lockin`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.lockedIn !== undefined) {
                        location.reload(); // Refresh to update counts for now, or implement optimistic UI later
                    }
                });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/cultural-hub/show.blade.php ENDPATH**/ ?>