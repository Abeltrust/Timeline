<?php $__env->startSection('title', $event->title . ' - Timeline Events'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

    
    <a href="<?php echo e(url()->previous() !== url()->current() ? url()->previous() : route('events.index')); ?>" 
       class="inline-flex items-center text-sm font-semibold text-stone-500 hover:text-amber-600 transition mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back
    </a>

    
    <div class="bg-white dark:bg-stone-900 rounded-3xl overflow-hidden shadow-xl border border-stone-100 dark:border-stone-800">
        
        
        <?php if($event->image): ?>
            <div class="w-full h-64 sm:h-80 md:h-96 relative bg-stone-100 dark:bg-stone-800">
                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" class="w-full h-full object-cover" alt="<?php echo e($event->title); ?>">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                
                
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="bg-white/90 dark:bg-stone-900/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-black uppercase text-stone-800 dark:text-stone-100 shadow-sm border border-stone-200 dark:border-stone-700">
                        <?php echo e(ucfirst($event->type)); ?>

                    </span>
                    <?php if($event->is_online): ?>
                        <span class="bg-blue-500/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-black uppercase text-white shadow-sm border border-blue-400">
                            Online Event
                        </span>
                    <?php endif; ?>
                </div>

                <div class="absolute bottom-6 left-6 right-6">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white leading-tight mb-2">
                        <?php echo e($event->title); ?>

                    </h1>
                </div>
            </div>
        <?php else: ?>
            <div class="p-6 sm:p-8 border-b border-stone-100 dark:border-stone-800 pb-0">
                <div class="flex gap-2 mb-4">
                    <span class="bg-stone-100 dark:bg-stone-800 px-3 py-1 rounded-full text-xs font-black uppercase text-stone-600 dark:text-stone-300 border border-stone-200 dark:border-stone-700">
                        <?php echo e(ucfirst($event->type)); ?>

                    </span>
                    <?php if($event->is_online): ?>
                        <span class="bg-blue-50 dark:bg-blue-900/20 px-3 py-1 rounded-full text-xs font-black uppercase text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                            Online Event
                        </span>
                    <?php endif; ?>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-stone-900 dark:text-white leading-tight mb-6 mt-2">
                    <?php echo e($event->title); ?>

                </h1>
            </div>
        <?php endif; ?>

        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            
            
            <div class="md:col-span-2 space-y-8">
                
                
                <div class="flex items-center gap-4 bg-stone-50 dark:bg-stone-800/50 p-4 rounded-2xl border border-stone-100 dark:border-stone-800">
                    <img src="<?php echo e($event->organizer->profile_photo_url ?? asset('images/default-avatar.png')); ?>" alt="<?php echo e($event->organizer->name); ?>" class="w-14 h-14 rounded-full object-cover">
                    <div>
                        <p class="text-xs uppercase font-bold text-stone-500 dark:text-stone-400 tracking-wider mb-0.5">Organized by</p>
                        <p class="font-bold text-stone-900 dark:text-stone-100 text-lg"><?php echo e($event->organizer->name); ?></p>
                    </div>
                </div>

                
                <div>
                    <h3 class="text-xl font-bold text-stone-900 dark:text-stone-100 mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5 text-amber-500"></i> About this Event
                    </h3>
                    <div class="prose prose-stone dark:prose-invert max-w-none text-stone-700 dark:text-stone-300 whitespace-pre-line leading-relaxed">
                        <?php echo e($event->description); ?>

                    </div>
                </div>
                
                
                <?php if($event->community_id): ?>
                <div class="pt-6 border-t border-stone-100 dark:border-stone-800">
                    <h3 class="text-lg font-bold text-stone-900 dark:text-stone-100 mb-4 flex items-center gap-2">
                        <i data-lucide="users" class="w-5 h-5 text-amber-500"></i> Community Hosted
                    </h3>
                    <a href="<?php echo e(route('communities.show', $event->community_id)); ?>" class="flex items-center gap-4 group p-4 rounded-xl hover:bg-stone-50 dark:hover:bg-stone-800 transition border border-transparent hover:border-stone-200 dark:hover:border-stone-700">
                        <div class="w-12 h-12 rounded-lg bg-stone-200 dark:bg-stone-700 flex items-center justify-center overflow-hidden">
                            <?php if($event->community->image): ?>
                                <img src="<?php echo e(asset('storage/' . $event->community->image)); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <i data-lucide="users" class="w-6 h-6 text-stone-400"></i>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="font-bold text-stone-900 dark:text-stone-100 group-hover:text-amber-600 transition"><?php echo e($event->community->name); ?></p>
                            <p class="text-sm text-stone-500">View Community</p>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="space-y-6">
                
                
                <div class="bg-stone-50 dark:bg-stone-800/80 rounded-2xl p-6 border border-stone-100 dark:border-stone-700 space-y-6">
                    
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-stone-900 shadow-sm flex items-center justify-center text-amber-500 shrink-0">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="font-bold text-stone-900 dark:text-stone-100"><?php echo e($event->event_date->format('l, F j, Y')); ?></p>
                            <p class="text-stone-600 dark:text-stone-400 text-sm mt-0.5"><?php echo e($event->event_time->format('g:i A')); ?></p>
                        </div>
                    </div>

                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-stone-900 shadow-sm flex items-center justify-center text-orange-500 shrink-0">
                            <i data-lucide="<?php echo e($event->is_online ? 'video' : 'map-pin'); ?>" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="font-bold text-stone-900 dark:text-stone-100"><?php echo e($event->is_online ? 'Online Event' : 'Location'); ?></p>
                            <p class="text-stone-600 dark:text-stone-400 text-sm mt-0.5"><?php echo e($event->location); ?></p>
                            <?php if($event->is_online && $event->meeting_link && ($event->attendees->contains(auth()->id()) || $event->organizer_id == auth()->id())): ?>
                                <a href="<?php echo e($event->meeting_link); ?>" target="_blank" class="inline-block mt-2 text-sm text-blue-600 dark:text-blue-400 hover:underline font-semibold flex items-center gap-1">
                                    Join Meeting <i data-lucide="external-link" class="w-3 h-3"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-stone-900 shadow-sm flex items-center justify-center text-green-500 shrink-0">
                            <i data-lucide="tag" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="font-bold text-stone-900 dark:text-stone-100">Price</p>
                            <p class="text-stone-600 dark:text-stone-400 text-sm mt-0.5">
                                <?php echo e($event->price == 0 ? 'Free' : '$' . number_format($event->price, 2)); ?>

                            </p>
                        </div>
                    </div>
                </div>

                
                <div class="space-y-3 pt-2">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($event->organizer_id == auth()->id()): ?>
                            <div class="bg-stone-100 dark:bg-stone-800 p-4 rounded-xl text-center">
                                <p class="text-xs uppercase font-black text-stone-400 tracking-widest mb-1">Host Controls</p>
                                <p class="text-stone-600 dark:text-stone-300 font-bold">You are the Organizer</p>
                            </div>
                        <?php elseif($event->attendees->contains(auth()->id())): ?>
                            <div class="text-center">
                                <div class="w-full py-4 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800 font-bold rounded-xl mb-3 flex items-center justify-center gap-2">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i> 
                                    <?php echo e($event->price > 0 ? 'Ticket Active' : "You're Attending"); ?>

                                </div>
                                <form action="<?php echo e(route('events.leave', $event)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel? Refunds are handled by the host.')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-xs text-stone-500 hover:text-red-500 transition underline underline-offset-2">Cancel Registration</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <?php if($event->isFull()): ?>
                                <button disabled class="w-full py-4 bg-stone-100 dark:bg-stone-800 text-stone-500 dark:text-stone-400 font-bold rounded-xl cursor-not-allowed text-center uppercase tracking-wider text-sm flex items-center justify-center gap-2">
                                    <i data-lucide="slash" class="w-4 h-4"></i> Event is Full
                                </button>
                            <?php else: ?>
                                <form action="<?php echo e($event->price > 0 ? route('events.ticket', $event) : route('events.join', $event)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white shadow-lg shadow-amber-500/30 transition-all font-black rounded-xl text-center uppercase tracking-widest active:scale-95 flex items-center justify-center gap-2">
                                        <?php echo e($event->price > 0 ? 'Buy Ticket' : 'Register Now'); ?> 
                                        <i data-lucide="<?php echo e($event->price > 0 ? 'credit-card' : 'arrow-right'); ?>" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                <?php if($event->price > 0): ?>
                                    <p class="text-[10px] text-center text-stone-400 font-bold uppercase tracking-tight mt-2">Secure Ticketing Powered by Timeline Education</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="block w-full py-4 bg-stone-800 dark:bg-stone-100 hover:bg-stone-900 dark:hover:bg-white text-white dark:text-stone-900 transition-all font-bold rounded-xl text-center uppercase tracking-widest text-sm text-nowrap">
                            Log in to Join
                        </a>
                    <?php endif; ?>

                    <p class="text-center text-xs font-semibold text-stone-500 dark:text-stone-400 mt-4 flex items-center justify-center gap-1.5">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <?php echo e($event->attendees_count); ?> <?php echo e(Str::plural('person', $event->attendees_count)); ?> attending 
                        <?php if($event->max_attendees): ?>
                            (Max: <?php echo e($event->max_attendees); ?>)
                        <?php endif; ?>
                    </p>
                </div>

                
                <?php if($event->accepts_contributions): ?>
                <div class="mt-8 bg-amber-50 dark:bg-amber-900/10 rounded-2xl p-6 border border-amber-100 dark:border-amber-900/30">
                    <h4 class="text-sm font-black text-amber-800 dark:text-amber-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <i data-lucide="heart" class="w-4 h-4"></i> Support Educator
                    </h4>
                    <p class="text-xs text-amber-900/60 dark:text-amber-500/60 mb-4 leading-relaxed">
                        The organizer is open to financial contributions to support this work. Every bit helps preserve our traditions.
                    </p>
                    
                    <form action="<?php echo e(route('events.contribute', $event)); ?>" method="POST" class="space-y-3">
                        <?php echo csrf_field(); ?>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-amber-600 dark:text-amber-500 font-bold">$</span>
                            <input type="number" name="amount" min="1" step="1" required
                                class="w-full bg-white dark:bg-stone-800 border-amber-200 dark:border-amber-900/50 rounded-xl pl-7 pr-4 py-2 text-sm focus:ring-amber-500 focus:border-amber-500 dark:text-stone-100"
                                placeholder="Amount">
                        </div>
                        <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-black text-xs uppercase tracking-widest rounded-xl transition shadow-sm">
                            Send Contribution
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if(typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/events/show.blade.php ENDPATH**/ ?>