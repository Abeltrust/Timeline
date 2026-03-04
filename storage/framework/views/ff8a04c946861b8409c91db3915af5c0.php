

<?php $__env->startSection('title', 'Cultural Hub - Explore Global Heritage'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 relative">
        <!-- Background Decorative Elements -->
        <div class="fixed inset-0 pointer-events-none z-0 opacity-30 dark:opacity-20">
            <div class="absolute top-[10%] left-[5%] w-96 h-96 bg-amber-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[10%] right-[5%] w-[30rem] h-[30rem] bg-orange-600/10 rounded-full blur-[150px]"></div>
        </div>

        <div
            class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 text-center sm:text-left">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Cultural Hub
                </h2>
                <p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-2xl">
                    Discover, preserve, and celebrate the rich tapestry of global cultures.
                    Every tradition has a story, every heritage deserves preservation.
                </p>
            </div>
            <?php if(auth()->guard()->check()): ?>
                <div class="flex-shrink-0">
                    <a href="<?php echo e(route('cultural-hub.create')); ?>"
                        class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        <span>Share Your Culture</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center space-x-3">
                    <i data-lucide="check-circle" class="w-5 h-5 transition-colors"></i>
                    <p class="text-sm font-medium"><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Discovery Container -->
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-start" x-data="{ mobileFiltersOpen: false }">
            
            <!-- Main Content Area (Column 1-9 on LG) -->
            <div class="lg:col-span-9 space-y-10 order-last lg:order-first">
                
                <!-- Mobile Dropdown Toolbar (Premium Glassmorphism) -->
                <div class="lg:hidden flex items-center justify-between backdrop-blur-xl bg-white/80 dark:bg-stone-900/80 p-5 rounded-[2rem] border border-white/20 dark:border-stone-800/50 shadow-2xl relative z-40 mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500/10 to-orange-600/10 flex items-center justify-center border border-amber-500/20">
                            <i data-lucide="compass" class="w-6 h-6 text-amber-600 animate-spin-slow"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-amber-600 uppercase tracking-[0.2em] mb-0.5">Exploring</p>
                            <p class="text-base font-black text-stone-900 dark:text-white uppercase tracking-tight"><?php echo e($categories[(string)$category] ?? 'Global Heritage'); ?></p>
                        </div>
                    </div>

                    <!-- Three-Dot Trigger -->
                    <div class="relative">
                        <button @click="mobileFiltersOpen = !mobileFiltersOpen" 
                                class="w-12 h-12 flex items-center justify-center rounded-[1.25rem] bg-stone-50 dark:bg-stone-800 hover:bg-amber-500 hover:text-white transition-all duration-300 shadow-inner">
                            <i data-lucide="more-vertical" class="w-6 h-6"></i>
                        </button>

                        <!-- Mobile Menu Dropdown (Cinematic Transition) -->
                        <div x-show="mobileFiltersOpen" 
                             @click.away="mobileFiltersOpen = false"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-90 -translate-y-4"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="absolute right-0 mt-4 w-72 backdrop-blur-2xl bg-white/95 dark:bg-stone-900/95 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.2)] border border-white/20 dark:border-stone-800/50 overflow-hidden py-4 z-50"
                             x-cloak>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('cultural-hub.index', ['category' => $key])); ?>"
                                   class="flex items-center justify-between px-8 py-4 hover:bg-amber-500/10 transition-colors group">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-2 h-2 rounded-full <?php echo e($category === $key ? 'bg-amber-500 shadow-[0_0_12px_rgba(245,158,11,0.8)]' : 'bg-stone-200 dark:bg-stone-700'); ?>"></div>
                                        <span class="text-xs font-black uppercase tracking-widest <?php echo e($category === $key ? 'text-amber-600' : 'text-stone-600 dark:text-stone-400'); ?>">
                                            <?php echo e($label); ?>

                                        </span>
                                    </div>
                                    <?php if($category === $key): ?>
                                        <i data-lucide="check" class="w-4 h-4 text-amber-500"></i>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Cultures Grid (Cinematic Cards) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <?php $__empty_1 = true; $__currentLoopData = $cultures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $culture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white dark:bg-stone-900 rounded-[3rem] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_30px_70px_rgba(0,0,0,0.12)] transition-all duration-700 group border border-stone-100 dark:border-stone-800/50 flex flex-col h-full transform hover:-translate-y-4">
                            <!-- Image Section -->
                            <div class="aspect-[4/5] overflow-hidden relative">
                                <div class="absolute top-6 left-6 z-20 flex flex-col gap-2">
                                    <span class="backdrop-blur-md bg-black/30 text-white px-4 py-1.5 rounded-full text-[9px] uppercase tracking-[0.2em] font-black border border-white/20 shadow-lg">
                                        <?php echo e($culture->category); ?>

                                    </span>
                                    <?php if($culture->status === 'featured'): ?>
                                        <span class="backdrop-blur-md bg-amber-500/80 text-white px-4 py-1.5 rounded-full text-[9px] uppercase tracking-[0.2em] font-black border border-amber-400/50 shadow-lg flex items-center">
                                            <i data-lucide="crown" class="w-3 h-3 mr-1.5"></i>
                                            Featured
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if($culture->image): ?>
                                    <img src="<?php echo e(Storage::url($culture->image)); ?>" alt="<?php echo e($culture->name); ?>"
                                         class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-110">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-br from-amber-500/10 to-orange-600/10 flex items-center justify-center">
                                        <i data-lucide="globe" class="w-16 h-16 text-amber-600/20"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(auth()->id() === $culture->submitted_by): ?>
                                        <!-- Owner Actions Dropdown -->
                                        <div class="absolute top-6 right-6 z-30" x-data="{ open: false }">
                                            <button @click="open = !open" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md border border-white/30 text-white flex items-center justify-center hover:bg-white/40 transition-all">
                                                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                            </button>
                                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-stone-900 rounded-2xl shadow-2xl border border-stone-100 dark:border-stone-800 overflow-hidden py-2" x-cloak>
                                                <a href="<?php echo e(route('cultural-hub.edit', $culture->id)); ?>" class="flex items-center px-6 py-3 text-xs font-black uppercase text-stone-600 hover:bg-stone-50"><i data-lucide="edit-3" class="w-3.5 h-3.5 mr-3 text-amber-500"></i> Edit Legend</a>
                                                <form action="<?php echo e(route('cultural-hub.destroy', $culture->id)); ?>" method="POST" onsubmit="return confirm('Enshrine this deletion?')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="w-full flex items-center px-6 py-3 text-xs font-black uppercase text-red-600 hover:bg-red-50"><i data-lucide="trash-2" class="w-3.5 h-3.5 mr-3"></i> Dissolve</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Floating Lock-In Badge -->
                                <div class="absolute bottom-6 right-6 z-20">
                                    <button onclick="toggleCultureLockin(<?php echo e($culture->id); ?>)" 
                                            class="w-12 h-12 rounded-2xl <?php echo e(auth()->check() && auth()->user()->hasLockedIn($culture) ? 'bg-amber-500 text-white' : 'bg-white/90 text-stone-900'); ?> backdrop-blur-md flex items-center justify-center shadow-2xl hover:scale-110 transition-transform group/lock">
                                        <i data-lucide="<?php echo e(auth()->check() && auth()->user()->hasLockedIn($culture) ? 'check' : 'lock'); ?>" class="w-5 h-5 group-hover/lock:scale-110 transition-transform"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-8 flex-1 flex flex-col relative">
                                <!-- Guardian Badge -->
                                <div class="absolute -top-6 left-8 bg-white dark:bg-stone-900 px-4 py-2 rounded-xl border border-stone-100 dark:border-stone-800 shadow-lg flex items-center space-x-2">
                                     <div class="w-4 h-4 rounded-full bg-amber-500 flex items-center justify-center">
                                         <i data-lucide="user" class="w-2.5 h-2.5 text-white"></i>
                                     </div>
                                     <span class="text-[9px] font-black text-stone-500 dark:text-stone-400 uppercase tracking-widest"><?php echo e($culture->submitter->name ?? 'Timeline Guardian'); ?></span>
                                </div>

                                <div class="mb-6 mt-4">
                                    <div class="flex items-center space-x-2 text-amber-500 mb-2 uppercase tracking-[0.2em] text-[9px] font-black">
                                        <i data-lucide="sparkles" class="w-3 h-3"></i>
                                        <span>Heritage Enshrined</span>
                                    </div>
                                    
                                    <h3 class="font-black text-stone-900 dark:text-white text-2xl mb-2 tracking-tighter leading-tight group-hover:text-amber-600 transition-colors">
                                        <?php echo e($culture->name); ?>

                                    </h3>
                                    
                                    <div class="flex items-center text-stone-400 text-xs font-bold uppercase tracking-widest">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5 mr-2 text-amber-500 opacity-60"></i>
                                        <?php echo e($culture->region); ?>

                                    </div>
                                </div>

                                <p class="text-stone-500 dark:text-stone-400 text-sm leading-relaxed mb-8 line-clamp-2 italic font-medium flex-1">
                                    "<?php echo e($culture->description); ?>"
                                </p>

                                <!-- Card Footer -->
                                <div class="pt-6 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between">
                                    <div class="flex items-center space-x-6">
                                        <div class="flex flex-col">
                                            <span class="text-xl font-black text-stone-900 dark:text-white leading-none tracking-tighter"><?php echo e($culture->locked_in_count); ?></span>
                                            <span class="text-[8px] font-black text-stone-400 uppercase tracking-widest mt-1">Locked-In</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xl font-black text-stone-900 dark:text-white leading-none tracking-tighter"><?php echo e($culture->resonance_count); ?></span>
                                            <span class="text-[8px] font-black text-stone-400 uppercase tracking-widest mt-1">Pulses</span>
                                        </div>
                                    </div>

                                    <a href="<?php echo e(route('cultural-hub.show', $culture->id)); ?>" 
                                       class="group/btn relative overflow-hidden px-6 py-3 bg-stone-900 dark:bg-white text-white dark:text-stone-900 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl transition-all hover:scale-105 active:scale-95">
                                        <span class="relative z-10 flex items-center space-x-2">
                                            <span>Explore</span>
                                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover/btn:translate-x-1 transition-transform"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full text-center py-24 backdrop-blur-md bg-stone-50/50 dark:bg-stone-900/10 rounded-[4rem] border-4 border-dashed border-stone-200 dark:border-stone-800">
                            <i data-lucide="globe" class="w-24 h-24 text-amber-500/10 mx-auto mb-8"></i>
                            <h3 class="text-2xl font-black text-stone-800 dark:text-white uppercase tracking-tighter mb-4">The Archive lies Silent</h3>
                            <p class="text-stone-500 text-base max-w-sm mx-auto mb-10 font-bold">No cultural stories have been enshrined in this category yet. Be the first to share your legacy.</p>
                            <a href="<?php echo e(route('cultural-hub.create')); ?>" class="inline-flex items-center space-x-3 px-10 py-5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-xs hover:scale-110 transition-transform shadow-2xl shadow-amber-500/40">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                                <span>ENSHRINE STORY</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination (Premium Aesthetic) -->
                <?php if($cultures->hasPages()): ?>
                    <div class="pt-12 border-t border-stone-100 dark:border-stone-800">
                        <?php echo e($cultures->links()); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Desktop Sidebar (Relocated to Right + Floating Glass) -->
            <aside class="hidden lg:block lg:col-span-3 sticky top-24 space-y-8 lg:order-last">
                <div class="backdrop-blur-2xl bg-white/70 dark:bg-stone-900/70 rounded-[3rem] border border-white/40 dark:border-stone-800/50 p-10 shadow-2xl shadow-amber-500/5">
                    <!-- Premium Search Filter -->
                    <form action="<?php echo e(route('cultural-hub.index')); ?>" method="GET" class="mb-10 p-1.5 bg-stone-100/50 dark:bg-stone-800/50 rounded-2xl flex items-center border border-stone-200 dark:border-stone-700 focus-within:border-amber-400 focus-within:ring-8 focus-within:ring-amber-400/5 transition-all group">
                        <?php if($category !== 'all'): ?>
                            <input type="hidden" name="category" value="<?php echo e($category); ?>">
                        <?php endif; ?>
                        <div class="w-12 h-12 flex items-center justify-center text-stone-400 group-focus-within:text-amber-500 transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="SEARCH LEGENDS..." class="bg-transparent border-none focus:ring-0 text-[10px] font-black text-stone-800 dark:text-stone-200 w-full placeholder:text-stone-400 uppercase tracking-[0.2em]">
                        <button type="submit" class="hidden"></button>
                    </form>

                    <div class="flex items-center space-x-3 text-amber-600 mb-8 uppercase tracking-[0.3em] text-[10px] font-black">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                        <span>Discovery Vault</span>
                    </div>

                    <div class="space-y-3">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('cultural-hub.index', ['category' => $key])); ?>"
                                class="flex items-center justify-between group px-6 py-4 rounded-[1.5rem] transition-all duration-500 <?php echo e($category === $key ? 'bg-stone-900 dark:bg-white text-white dark:text-stone-900 shadow-2xl scale-[1.05] z-10' : 'text-stone-500 dark:text-stone-400 hover:bg-white dark:hover:bg-stone-800 hover:shadow-xl hover:scale-[1.02]'); ?>">
                                <div class="flex items-center space-x-4">
                                    <?php
                                        $icon = match($key) {
                                            'all' => 'globe-2',
                                            'festivals' => 'party-popper',
                                            'traditions' => 'scroll',
                                            'music' => 'music-4',
                                            'heritage' => 'landmark',
                                            'crafts' => 'hammer',
                                            'language' => 'languages',
                                            default => 'sparkles'
                                        };
                                    ?>
                                    <i data-lucide="<?php echo e($icon); ?>" class="w-5 h-5 <?php echo e($category === $key ? 'text-amber-500' : 'text-stone-400 group-hover:text-amber-500'); ?> transition-colors"></i>
                                    <span class="text-[11px] font-black uppercase tracking-tight"><?php echo e($label); ?></span>
                                </div>
                                <i data-lucide="arrow-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all transform -translate-x-2 group-hover:translate-x-0"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Premium Sidebar CTA -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-[3rem] p-10 text-white shadow-2xl shadow-amber-500/30 group overflow-hidden relative">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <i data-lucide="crown" class="w-12 h-12 mb-6 text-amber-200 opacity-60 group-hover:rotate-12 transition-transform duration-500"></i>
                        <h3 class="font-black text-2xl mb-3 tracking-tighter leading-tight">Become a Story Guardian</h3>
                        <p class="text-[10px] font-bold opacity-80 leading-relaxed mb-10 uppercase tracking-widest text-amber-100">Every ritual, every craft, every song counts.</p>
                        <a href="<?php echo e(route('cultural-hub.create')); ?>" class="w-full inline-flex items-center justify-center py-5 bg-white text-amber-600 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-xl hover:bg-stone-900 hover:text-white transition-all duration-300 transform group-hover:scale-105 active:scale-95">
                            ENSHRINE NOW
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <?php if(auth()->guard()->guest()): ?>
            <div class="bg-stone-900 dark:bg-white rounded-[4rem] p-16 mt-24 text-center relative overflow-hidden shadow-[0_50px_100px_rgba(0,0,0,0.3)] dark:shadow-[0_50px_100px_rgba(0,0,0,0.1)]">
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-500 rounded-full blur-[150px] translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-600 rounded-full blur-[150px] -translate-x-1/2 translate-y-1/2"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-amber-500 rounded-[2rem] flex items-center justify-center mx-auto mb-10 shadow-2xl rotate-12">
                        <i data-lucide="shield-check" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-4xl sm:text-5xl font-black text-white dark:text-stone-900 mb-6 tracking-tighter leading-none">The Human Legacy <br> Needs You</h3>
                    <p class="text-stone-400 dark:text-stone-500 text-lg max-w-2xl mx-auto mb-12 font-medium leading-relaxed">Join thousands of guardians in the global initiative to preserve our shared traditions. Unlock your potential to contribute to the Timeline.</p>
                    <a href="<?php echo e(route('register')); ?>"
                        class="inline-flex items-center space-x-4 px-12 py-6 bg-amber-500 text-white rounded-[2rem] font-black uppercase tracking-[0.3em] text-[10px] hover:scale-110 active:scale-95 transition-all shadow-2xl shadow-amber-500/50">
                        <span>INITIATE MEMBERSHIP</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });

        function toggleCultureLockin(id) {
            <?php if(auth()->guard()->guest()): ?>
                window.location.href = "<?php echo e(route('login')); ?>";
                return;
            <?php endif; ?>

            fetch(`/cultural-hub/${id}/lock-in`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.lockedIn !== undefined) {
                    location.reload(); // Simple reload for state consistency, or update DOM
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Laravel\Timeline\resources\views/cultural-hub/index.blade.php ENDPATH**/ ?>