


<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-stone-100 tracking-tight">
                Cultural Events</h1>

            
            <form action="<?php echo e(route('events.index')); ?>" method="GET"
                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-80">
                <div class="relative flex-1">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Find your tribe..."
                        class="w-full pl-10 pr-4 py-2 bg-stone-100 dark:bg-stone-800 border-none rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm trans-all">
                </div>
            </form>
        </div>

        
        <?php if($liveStreams->count() > 0): ?>
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-stone-100 flex items-center gap-2">
                        <span class="flex h-3 w-3 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                        Ongoing Cultural Broadcasts
                    </h2>
                    <a href="<?php echo e(route('live-stream.index')); ?>"
                        class="text-sm font-bold text-amber-600 dark:text-amber-500 hover:text-amber-700">View All Streams</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $liveStreams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('live-stream.show', $stream)); ?>"
                            class="group relative aspect-video bg-stone-900 rounded-2xl overflow-hidden shadow-lg hover:scale-[1.02] transition-all duration-300">
                            <img src="<?php echo e($stream->thumbnail ?? 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=800'); ?>"
                                class="w-full h-full object-cover opacity-70 group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="bg-red-600 text-white text-[10px] uppercase font-black px-2 py-0.5 rounded shadow">Live</span>
                                <span
                                    class="bg-black/40 backdrop-blur-md text-white text-[10px] px-2 py-0.5 rounded flex items-center gap-1">
                                    <i data-lucide="eye" class="w-3 h-3 text-stone-300"></i> <?php echo e($stream->viewers_count); ?>

                                </span>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white font-bold text-lg leading-snug group-hover:text-amber-400 transition-colors">
                                    <?php echo e($stream->title); ?></h3>
                                <p class="text-stone-300 text-xs flex items-center gap-2 mt-1">
                                    <img src="<?php echo e($stream->host->profile_photo_url); ?>"
                                        class="w-4 h-4 rounded-full border border-white/20">
                                    <?php echo e($stream->host->name); ?>

                                </p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>

        
        <section class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-stone-100">Discovery Timeline</h2>

                
                <nav class="flex p-1 bg-stone-100 dark:bg-stone-800 rounded-xl w-fit">
                    <?php $__currentLoopData = ['all' => 'Exploration', 'attending' => 'My Journey', 'hosting' => 'Organizing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('events.index', array_merge(request()->except('page'), ['filter' => $key]))); ?>" class="px-5 py-2 rounded-lg text-xs font-bold tracking-tight uppercase transition-all
                                              <?php echo e(request('filter', 'all') === $key
                        ? 'bg-white dark:bg-stone-700 text-amber-600 dark:text-amber-400 shadow-sm'
                        : 'text-stone-500 hover:text-stone-700 dark:hover:text-stone-300'); ?>">
                                    <?php echo e($label); ?>

                                </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>
            </div>

            
            <?php if($events->count() || $upcomingStreams->count()): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    
                    <?php $__currentLoopData = $upcomingStreams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white dark:bg-stone-900 rounded-3xl overflow-hidden shadow-sm hover:shadow-md border border-stone-100 dark:border-stone-800 flex flex-col group trans-all">
                            <div class="relative h-48 w-full overflow-hidden">
                                <span
                                    class="absolute top-4 left-4 z-10 bg-amber-500 text-white text-[10px] uppercase font-black px-2 py-1 rounded-lg shadow-lg">Upcoming
                                    Stream</span>
                                <img src="<?php echo e($stream->thumbnail ?? 'https://images.unsplash.com/photo-1541462608141-ad60397d5873?auto=format&fit=crop&q=80&w=800'); ?>"
                                    class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-90">
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3
                                    class="font-black text-gray-900 dark:text-stone-100 text-lg mb-2 group-hover:text-amber-600 transition-colors">
                                    <?php echo e($stream->title); ?></h3>
                                <div class="space-y-2 mb-6">
                                    <div
                                        class="flex items-center gap-2 text-stone-500 dark:text-stone-400 text-xs font-bold uppercase tracking-wider">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        <span><?php echo e($stream->scheduled_at->format('M d • h:i A')); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-stone-400 text-xs font-medium">
                                        <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                                        <span><?php echo e($stream->category ?? 'Cultural Heritage'); ?></span>
                                    </div>
                                </div>
                                <a href="<?php echo e(route('live-stream.show', $stream)); ?>"
                                    class="mt-auto w-full py-3 bg-stone-100 dark:bg-stone-800 hover:bg-amber-50 text-stone-600 dark:text-stone-300 font-bold text-xs uppercase tracking-widest rounded-2xl text-center trans-all">Get
                                    Notified</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white dark:bg-stone-900 rounded-3xl overflow-hidden shadow-sm hover:shadow-md border border-stone-100 dark:border-stone-800 flex flex-col group trans-all">
                            <?php if($event->image): ?>
                                <div class="h-48 w-full overflow-hidden relative">
                                    <img src="<?php echo e(asset('storage/' . $event->image)); ?>"
                                        class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <span
                                        class="absolute top-4 right-4 bg-white/90 dark:bg-stone-900/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black uppercase text-stone-600 dark:text-stone-300 border border-stone-200 dark:border-stone-800"><?php echo e($event->type); ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="p-6 flex-1 flex flex-col">
                                <h3
                                    class="font-black text-gray-900 dark:text-stone-100 text-xl mb-3 line-clamp-1 group-hover:text-amber-600 transition-colors">
                                    <?php echo e($event->title); ?></h3>

                                <div class="grid grid-cols-2 gap-y-4 mb-6">
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[10px] uppercase font-black text-stone-400 dark:text-stone-500 leading-none mb-1">
                                                Date</p>
                                            <p class="text-xs font-bold text-stone-700 dark:text-stone-300">
                                                <?php echo e($event->event_date->format('M d, Y')); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center text-orange-600 dark:text-orange-400">
                                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[10px] uppercase font-black text-stone-400 dark:text-stone-500 leading-none mb-1">
                                                Location</p>
                                            <p class="text-xs font-bold text-stone-700 dark:text-stone-300 line-clamp-1">
                                                <?php echo e($event->location); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto flex items-center justify-between gap-4">
                                    <a href="<?php echo e(route('events.show', $event)); ?>"
                                        class="flex-1 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl text-center shadow-lg shadow-amber-500/20 active:scale-95 transition-all">Attend</a>
                                    <div @click="/* share functionality */"
                                        class="w-12 h-12 rounded-2xl bg-stone-100 dark:bg-stone-800 flex items-center justify-center text-stone-500 hover:bg-stone-200 dark:hover:bg-stone-700 cursor-pointer trans-all">
                                        <i data-lucide="share-2" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mt-12 flex justify-center">
                    <?php echo e($events->links()); ?>

                </div>

            <?php else: ?>
                <div class="py-20 text-center">
                    <div
                        class="w-20 h-20 bg-stone-100 dark:bg-stone-800 rounded-full flex items-center justify-center mx-auto mb-6 text-stone-400">
                        <i data-lucide="calendar-off" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-stone-100">No Experiences Found</h3>
                    <p class="text-stone-500 dark:text-stone-400 mt-2 max-w-sm mx-auto">Try broadening your exploration or check
                        back later for new cultural gatherings.</p>
                </div>
            <?php endif; ?>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        lucide.createIcons(); // initialize lucide icons
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/events/index.blade.php ENDPATH**/ ?>