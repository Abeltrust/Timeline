


<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Events</h1>

        
        <form action="<?php echo e(route('events.index')); ?>" method="GET" 
              class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
            <input type="text" 
                   name="search" 
                   value="<?php echo e(request('search')); ?>"
                   placeholder="Search events..."
                   class="flex-1 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none text-sm sm:text-base">
            <button type="submit" 
                    class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-lg shadow text-sm sm:text-base">
                Search
            </button>
        </form>
    </div>

    
    <div class="flex flex-wrap gap-2 mb-6">
        <?php
            $filters = ['all' => 'All', 'attending' => 'Attending', 'hosting' => 'Hosting', 'nearby' => 'Nearby'];
        ?>
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('events.index', array_merge(request()->except('page'), ['filter' => $key]))); ?>"
               class="px-4 py-2 rounded-full text-xs sm:text-sm font-medium 
                      <?php echo e(request('filter','all') === $key 
                        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                <?php echo e($label); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if($events->count()): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5 flex flex-col justify-between">

                    
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2"><?php echo e($event->title); ?></h2>
                        <p class="text-gray-600 text-sm mb-4"><?php echo e(Str::limit($event->description, 100)); ?></p>

                        
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span><?php echo e($event->date->format('M d, Y')); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                                <span><?php echo e($event->date->format('h:i A')); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                <span><?php echo e($event->location); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span><?php echo e($event->attendees_count); ?> attending</span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2">
                        <a href="<?php echo e(route('events.show', $event)); ?>" 
                           class="text-sm font-medium text-center sm:text-left text-gray-600 hover:text-orange-600">
                            View Details
                        </a>

                        <?php if($event->attendees->contains(auth()->id())): ?>
                            <form action="<?php echo e(route('events.leave', $event)); ?>" method="POST" class="w-full sm:w-auto">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                                    Leave
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('events.join', $event)); ?>" method="POST" class="w-full sm:w-auto">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="w-full px-4 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow hover:from-amber-600 hover:to-orange-700">
                                    Join
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-8">
            <?php echo e($events->links()); ?>

        </div>

    <?php else: ?>
        <p class="text-gray-600 text-center">No events found.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    lucide.createIcons(); // initialize lucide icons
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\resources\views/events/index.blade.php ENDPATH**/ ?>