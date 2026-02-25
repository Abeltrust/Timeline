

<?php $__env->startSection('title', $culture->name . ' - Cultural Hub'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-12">

        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-stone-500 space-x-2">
            <a href="<?php echo e(route('cultural-hub.index')); ?>"
               class="hover:text-amber-600 transition font-medium">
                Cultural Hub
            </a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-amber-600 font-semibold">
                <?php echo e($culture->name); ?>

            </span>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3">

            <?php if($culture->status === 'pending_review'): ?>
                <span class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Pending Review
                </span>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
            <button onclick="toggleCultureLockin(<?php echo e($culture->id); ?>)"
                class="px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300
                <?php echo e(auth()->user()->hasLockedIn($culture)
                    ? 'bg-amber-600 text-white shadow-lg shadow-amber-500/30'
                    : 'bg-white border border-amber-200 text-amber-700 hover:bg-amber-50'); ?>">
                <?php echo e(auth()->user()->hasLockedIn($culture) ? 'Locked In' : 'Lock-In Presence'); ?>

            </button>
            <?php endif; ?>

        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- MAIN CONTENT -->
        <div class="lg:col-span-2 space-y-16">

            <!-- HERO -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl">

                <?php if($culture->image): ?>
                    <img src="<?php echo e(Storage::url($culture->image)); ?>"
                         class="w-full h-80 sm:h-96 lg:h-[520px] object-cover">
                <?php else: ?>
                    <div class="h-80 sm:h-96 bg-gradient-to-br from-amber-100 to-orange-200 flex items-center justify-center">
                        <i data-lucide="globe" class="w-16 h-16 text-amber-500"></i>
                    </div>
                <?php endif; ?>

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <span class="text-xs uppercase tracking-widest bg-amber-500 px-4 py-1.5 rounded-full shadow">
                        <?php echo e($culture->category); ?>

                    </span>

                    <h1 class="text-4xl sm:text-5xl font-bold mt-4 tracking-tight">
                        <?php echo e($culture->name); ?>

                    </h1>

                    <p class="flex items-center text-sm mt-3 text-stone-200">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                        <?php echo e($culture->region); ?>

                    </p>
                </div>

                <?php if($culture->license_credit): ?>
                <div class="absolute bottom-5 right-5 bg-black/50 backdrop-blur px-4 py-2 rounded-lg text-xs text-white">
                    © <?php echo e($culture->license_credit); ?>

                    <?php if($culture->license_type): ?>
                        • <?php echo e($culture->license_type); ?>

                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- DESCRIPTION -->
            <div>
                <h2 class="text-2xl font-semibold text-amber-600 mb-6">
                    Cultural Story
                </h2>
                <p class="text-stone-700 dark:text-stone-300 leading-relaxed text-lg">
                    <?php echo e($culture->description); ?>

                </p>
            </div>

            <!-- GALLERY -->
            <?php if($culture->media_files && count($culture->media_files)): ?>
            <div x-data="{ activeImage: '<?php echo e(Storage::url($culture->media_files[0])); ?>' }">
                <h2 class="text-2xl font-semibold text-amber-600 mb-6">Gallery</h2>

                <div class="rounded-2xl overflow-hidden shadow-xl mb-6">
                    <img :src="activeImage"
                         class="w-full h-80 sm:h-96 object-cover transition duration-500">
                </div>

                <div class="grid grid-cols-3 sm:grid-cols-5 gap-4">
                    <?php $__currentLoopData = $culture->media_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button @click="activeImage = '<?php echo e(Storage::url($file)); ?>'"
                        class="rounded-xl overflow-hidden border border-stone-200 hover:border-amber-500 transition-all duration-300 hover:scale-105">
                        <img src="<?php echo e(Storage::url($file)); ?>"
                             class="w-full h-20 object-cover">
                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- VIDEO -->
            <?php if($culture->video_url || $culture->video_path): ?>
            <div>
                <h2 class="text-2xl font-semibold text-amber-600 mb-6">
                    Video Highlight
                </h2>

                <div class="aspect-video rounded-2xl overflow-hidden shadow-xl">
                    <?php if($culture->video_path): ?>
                        <video controls class="w-full h-full">
                            <source src="<?php echo e(Storage::url($culture->video_path)); ?>" type="video/mp4">
                        </video>
                    <?php else: ?>
                        <iframe src="<?php echo e($culture->video_url); ?>"
                                class="w-full h-full"
                                allowfullscreen></iframe>
                    <?php endif; ?>
                </div>

                <?php if($culture->video_description): ?>
                <p class="mt-5 text-sm text-stone-600 dark:text-stone-400 italic">
                    <?php echo e($culture->video_description); ?>

                </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- AUDIO -->
            <?php if($culture->audio_path || $culture->audio_url): ?>
            <div>
                <h2 class="text-2xl font-semibold text-amber-600 mb-6">
                    Audio Archive
                </h2>

                <div class="bg-stone-100 dark:bg-stone-900 p-8 rounded-2xl shadow-lg">
                    <?php if($culture->audio_path): ?>
                        <audio controls class="w-full">
                            <source src="<?php echo e(Storage::url($culture->audio_path)); ?>" type="audio/mpeg">
                        </audio>
                    <?php else: ?>
                        <a href="<?php echo e($culture->audio_url); ?>" target="_blank"
                           class="inline-block bg-amber-600 text-white px-6 py-3 rounded-xl hover:bg-amber-700 transition shadow">
                            Listen to External Audio
                        </a>
                    <?php endif; ?>
                </div>

                <?php if($culture->audio_description): ?>
                <p class="mt-5 text-sm text-stone-600 dark:text-stone-400 italic">
                    <?php echo e($culture->audio_description); ?>

                </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>

        <!-- SIDEBAR -->
        <div class="space-y-8">

            <!-- Guardian -->
            <div class="bg-white dark:bg-stone-900 rounded-3xl p-8 shadow-lg border border-stone-100 dark:border-stone-800">
                <h3 class="font-semibold text-xl mb-4">Cultural Guardian</h3>

                <p class="text-amber-600 font-medium">
                    <?php echo e($culture->submitter->name ?? 'Community Member'); ?>

                </p>

                <div class="mt-6 text-sm text-stone-500 space-y-3">
                    <p><strong>Enshrined:</strong> <?php echo e($culture->created_at->format('M d, Y')); ?></p>
                    <p><strong>Archive ID:</strong> #TH-<?php echo e(str_pad($culture->id, 5, '0', STR_PAD_LEFT)); ?></p>
                </div>

                <a href="<?php echo e(route('profile.user', $culture->submitted_by)); ?>"
                   class="block mt-8 text-center bg-stone-900 text-white py-3 rounded-xl hover:opacity-90 transition shadow">
                    View Profile
                </a>
            </div>

            <!-- Community Pulse -->
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 text-white p-8 rounded-3xl shadow-2xl shadow-amber-500/30">
                <h3 class="font-semibold text-lg mb-6">Community Pulse</h3>

                <div class="flex justify-between">
                    <div>
                        <p class="text-3xl font-bold"><?php echo e($culture->locked_in_count); ?></p>
                        <p class="text-sm opacity-80">Locked In</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold"><?php echo e($culture->resonance_count); ?></p>
                        <p class="text-sm opacity-80">Resonances</p>
                    </div>
                </div>
            </div>

            <!-- Licensing -->
            <div class="bg-stone-50 dark:bg-stone-900 p-6 rounded-2xl border border-stone-200 dark:border-stone-800 text-sm text-stone-600 dark:text-stone-400">
                <strong>Digital Rights:</strong><br>
                License: <span class="text-amber-600"><?php echo e($culture->license_type ?? 'Standard Timeline'); ?></span><br>
                Credit: <?php echo e($culture->license_credit ?? 'Community Shared'); ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/cultural-hub/show.blade.php ENDPATH**/ ?>