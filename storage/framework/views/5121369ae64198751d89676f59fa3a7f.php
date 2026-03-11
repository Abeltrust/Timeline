

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-6 space-y-8">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Story Analytics</h1>
        <p class="text-gray-500 text-sm">Insights into your cultural impact and storytelling reach.</p>
    </div>

    <!-- METRIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

        <!-- Total Stories -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="file-text" class="w-6 h-6 text-amber-500"></i>
                <p class="text-sm font-medium text-gray-600">Total Stories</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['total_stories']); ?></p>
            <p class="text-xs text-amber-600 mt-1">+12%</p>
        </div>

        <!-- TAPs Received -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="heart" class="w-6 h-6 text-rose-500"></i>
                <p class="text-sm font-medium text-gray-600">TAPs Received</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['taps_received']); ?></p>
            <p class="text-xs text-rose-600 mt-1">+23%</p>
        </div>

        <!-- Locked-in Connections -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="user-check" class="w-6 h-6 text-green-500"></i>
                <p class="text-sm font-medium text-gray-600">Locked-in Connections</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['locked_in_connections']); ?></p>
            <p class="text-xs text-green-600 mt-1">+8%</p>
        </div>

        <!-- Story Views -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="eye" class="w-6 h-6 text-violet-500"></i>
                <p class="text-sm font-medium text-gray-600">Story Views</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['story_views']); ?></p>
            <p class="text-xs text-violet-600 mt-1">+15%</p>
        </div>

        <!-- Resonance Points -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="message-circle" class="w-6 h-6 text-yellow-500"></i>
                <p class="text-sm font-medium text-gray-600">Resonance Points</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['resonance_points']); ?></p>
            <p class="text-xs text-yellow-600 mt-1">+34%</p>
        </div>

        <!-- Cultural Contributions -->
        <div class="bg-white rounded-2xl shadow-md border p-4">
            <div class="flex items-center gap-3">
                <i data-lucide="globe" class="w-6 h-6 text-gray-500"></i>
                <p class="text-sm font-medium text-gray-600">Cultural Contributions</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($stats['cultural_contributions']); ?></p>
            <p class="text-xs text-gray-600 mt-1">+67%</p>
        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- TOP PERFORMING STORIES -->
        <div class="bg-white rounded-2xl p-6 shadow border">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="flame" class="w-5 h-5 text-amber-500"></i>
                Top Performing Stories
            </h2>
            <div class="space-y-4">
                <?php $__currentLoopData = $topStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between p-3 rounded-lg border hover:bg-gray-50 transition">
                        <div>
                            <p class="text-sm font-medium text-gray-800"><?php echo e($story['title']); ?></p>
                            <div class="flex gap-4 text-xs text-gray-500 mt-1">
                                <span><?php echo e($story['taps']); ?> TAPs</span>
                                <span><?php echo e($story['resonance']); ?> Resonance</span>
                                <span><?php echo e($story['views']); ?> Views</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400"><?php echo e($story['date']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- CULTURAL IMPACT -->
        <div class="bg-white rounded-2xl p-6 shadow border space-y-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
                <i data-lucide="landmark" class="w-5 h-5 text-amber-500"></i>
                Cultural Impact
            </h2>

            <!-- LIST -->
            <div class="space-y-3">
                <?php $__currentLoopData = $culturalImpact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $impact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 border rounded-lg bg-yellow-50">
                        <p class="font-medium text-gray-800"><?php echo e($impact['culture']); ?></p>
                        <p class="text-xs text-gray-600">
                            <?php echo e($impact['contributions']); ?> contributions • <?php echo e($impact['resonance']); ?> resonance
                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- PRESERVATION SCORE -->
            <div class="p-4 rounded-lg bg-green-50 border">
                <p class="font-medium text-gray-800 flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-5 h-5 text-green-600"></i>
                    Heritage Preservation Score
                </p>
                <p class="text-2xl font-bold text-green-700 mt-1"><?php echo e($preservationScore); ?>/100</p>
                <p class="text-xs text-green-600">Exceptional cultural preservation impact</p>
            </div>
        </div>
    </div>

    <!-- ENGAGEMENT OVER TIME -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i data-lucide="activity" class="w-5 h-5 text-amber-500"></i>
            Engagement Over Time
        </h2>
        <div id="engagementChart" class="h-64 flex items-center justify-center text-gray-400">
            Interactive engagement chart will be displayed here
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Laravel\Timeline\resources\views/analytics/index.blade.php ENDPATH**/ ?>