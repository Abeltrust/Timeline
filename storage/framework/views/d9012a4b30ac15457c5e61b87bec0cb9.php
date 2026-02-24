

<?php $__env->startSection('title', 'Cultural Hub - Explore Global Heritage'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
    <div class="mb-6 sm:mb-8 text-center sm:text-left">
        <h2 class="text-2xl sm:text-3xl font-bold text-stone-800 mb-2 sm:mb-3">
            Cultural Hub
        </h2>
        <p class="text-sm sm:text-base text-stone-600 leading-relaxed">
            Discover, preserve, and celebrate the rich tapestry of global cultures. 
            Every tradition has a story, every heritage deserves preservation.
        </p>
    </div>

    <!-- Category Filter -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-wrap gap-2 sm:gap-3 justify-center sm:justify-start">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('cultural-hub.index', ['category' => $key])); ?>" 
               class="flex items-center space-x-1.5 sm:space-x-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium transition-all duration-200 <?php echo e($category === $key ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'bg-white text-stone-600 border border-stone-200 hover:border-stone-300 hover:shadow-sm'); ?>">
                <?php if($key === 'all'): ?>
                <i data-lucide="globe" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php elseif($key === 'festivals'): ?>
                <i data-lucide="calendar" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php elseif($key === 'traditions'): ?>
                <i data-lucide="book-open" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php elseif($key === 'music'): ?>
                <i data-lucide="music" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php elseif($key === 'heritage'): ?>
                <i data-lucide="map-pin" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php else: ?>
                <i data-lucide="globe" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                <?php endif; ?>
                <span><?php echo e($label); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Cultures Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-10 sm:mb-12">
        <?php $__empty_1 = true; $__currentLoopData = $cultures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $culture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-stone-100 hover:shadow-lg transition-all duration-300 group">
            <div class="aspect-video overflow-hidden">
                <?php if($culture->image): ?>
                <img src="<?php echo e(Storage::url($culture->image)); ?>" alt="<?php echo e($culture->name); ?>" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center">
                    <i data-lucide="globe" class="w-10 h-10 sm:w-16 sm:h-16 text-amber-600"></i>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="p-4 sm:p-6">
                <div class="flex items-start justify-between mb-2 sm:mb-3">
                    <div>
                        <h3 class="font-bold text-stone-800 text-base sm:text-lg mb-0.5 sm:mb-1"><?php echo e($culture->name); ?></h3>
                        <div class="flex items-center space-x-1 sm:space-x-2 text-xs sm:text-sm text-stone-500">
                            <i data-lucide="map-pin" class="w-3 h-3"></i>
                            <span><?php echo e($culture->region); ?></span>
                        </div>
                    </div>
                    <span class="bg-stone-100 text-stone-600 px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full text-[10px] sm:text-xs font-medium">
                        <?php echo e($culture->category); ?>

                    </span>
                </div>

                <p class="text-stone-600 text-xs sm:text-sm leading-relaxed mb-3 sm:mb-4 line-clamp-3">
                    <?php echo e($culture->description); ?>

                </p>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 sm:space-x-4 text-[11px] sm:text-sm text-stone-500">
                        <span class="flex items-center space-x-1">
                            <i data-lucide="users" class="w-3 h-3"></i>
                            <span><?php echo e($culture->locked_in_count); ?> Locked-In</span>
                        </span>
                        <span class="flex items-center space-x-1">
                            <i data-lucide="heart" class="w-3 h-3"></i>
                            <span><?php echo e($culture->resonance_count); ?> Resonance</span>
                        </span>
                    </div>
                    
                    <?php if(auth()->guard()->check()): ?>
                    <button onclick="toggleCultureLockin(<?php echo e($culture->id); ?>)" 
                            data-culture-lockin="<?php echo e($culture->id); ?>"
                            class="flex items-center space-x-1.5 sm:space-x-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg font-medium text-xs sm:text-sm transition-all duration-200 <?php echo e(auth()->user()->hasLockedIn($culture) ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-sm' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'); ?>">
                        <i data-lucide="lock" class="w-3 h-3"></i>
                        <span><?php echo e(auth()->user()->hasLockedIn($culture) ? 'Locked-In' : 'Lock-In'); ?></span>
                    </button>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="flex items-center space-x-1.5 sm:space-x-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg font-medium text-xs sm:text-sm bg-stone-100 text-stone-600 hover:bg-stone-200 transition-all duration-200">
                        <i data-lucide="lock" class="w-3 h-3"></i>
                        <span>Lock-In</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full text-center py-8 sm:py-12">
            <i data-lucide="globe" class="w-12 h-12 sm:w-16 sm:h-16 text-amber-600 mx-auto mb-3 sm:mb-4"></i>
            <h3 class="text-base sm:text-lg font-semibold text-stone-600 mb-1 sm:mb-2">No cultures found</h3>
            <p class="text-stone-500 text-sm sm:text-base mb-3 sm:mb-4">Be the first to share a culture in this category!</p>
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('cultural-hub.create')); ?>" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                Share Your Culture
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('register')); ?>" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                Join Timeline
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($cultures->hasPages()): ?>
    <div class="mb-10 sm:mb-12">
        <?php echo e($cultures->links()); ?>

    </div>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 sm:p-8 mt-4 sm:mt-0">
        <div class="text-center">
            <i data-lucide="globe" class="w-10 h-10 sm:w-12 sm:h-12 text-amber-600 mx-auto mb-3 sm:mb-4"></i>
            <h3 class="text-lg sm:text-xl font-bold text-stone-800 mb-1 sm:mb-2">Preserve Your Heritage</h3>
            <p class="text-stone-600 text-sm sm:text-base mb-5 sm:mb-6">
                Share your cultural traditions, stories, and practices to help preserve them for future generations.
            </p>
            <a href="<?php echo e(route('register')); ?>" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-medium text-sm sm:text-base hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-sm hover:shadow-md">
                Join Timeline
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/cultural-hub/index.blade.php ENDPATH**/ ?>