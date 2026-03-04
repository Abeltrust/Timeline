

<?php $__env->startSection('content'); ?>
    <div
        class="flex flex-col h-[100dvh] md:h-[calc(100vh-4rem)] bg-gray-100 dark:bg-stone-950 overflow-x-hidden font-sans w-full max-w-full box-border">

        <!-- INBOX COLUMN -->
        <div
            class="flex-1 flex flex-col bg-white dark:bg-stone-900 relative h-full w-full border-x border-gray-100 dark:border-stone-800 shadow-sm overflow-x-hidden overflow-y-auto box-border">

            <!-- HEADER -->
            <div
                class="p-2 md:p-4 flex items-center justify-between border-b border-gray-100 dark:border-stone-800 bg-white/80 dark:bg-stone-900/80 backdrop-blur-md sticky top-0 z-20">
                <h1 class="text-lg md:text-2xl font-black text-gray-900 dark:text-stone-100 tracking-tight truncate">
                    Messages</h1>
                <div
                    class="p-1.5 md:p-2 bg-amber-50 dark:bg-amber-900/20 rounded-full text-amber-600 dark:text-amber-400 cursor-pointer hover:bg-amber-100 dark:hover:bg-amber-900/40 transition-colors">
                    <i data-lucide="message-square-plus" class="w-5 h-5 md:w-6 md:h-6"></i>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="p-2 border-b border-gray-50 dark:border-stone-800/50">
                <div class="relative">
                    <i data-lucide="search"
                        class="absolute left-2 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 dark:text-stone-500"></i>
                    <input type="text" placeholder="Search..."
                        class="w-full pl-8 pr-2 py-1 bg-gray-50 dark:bg-stone-800 dark:text-stone-100 dark:placeholder-stone-400 border-0 rounded-xl text-xs md:text-sm truncate focus:ring-2 focus:ring-amber-500 transition-all box-border">
                </div>
            </div>

            <!-- USER LIST -->
            <div class="flex-1 overflow-y-auto space-y-1 p-1 md:p-2.5 custom-scrollbar box-border">
                <div
                    class="px-2 py-1 text-xs font-bold text-gray-400 dark:text-stone-500 uppercase tracking-widest truncate">
                    Active
                    Conversations</div>

                <?php $__empty_1 = true; $__currentLoopData = $activeUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('messages.start', $user->id)); ?>"
                        class="group flex items-center gap-2 p-2 md:p-3 rounded-xl transition-all duration-200 hover:bg-amber-50 dark:hover:bg-stone-800 hover:shadow-md hover:shadow-amber-100/50 dark:hover:shadow-none min-w-0">

                        <div class="relative flex-shrink-0">
                            <img src="<?php echo e($user->profile_photo_url); ?>"
                                class="w-10 h-10 md:w-12 md:h-12 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform">
                            <span
                                class="absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 rounded-full border-2 border-white dark:border-stone-900 
                                            <?php echo e($user->status == 'online' ? 'bg-green-500' : 'bg-gray-300 dark:bg-stone-600'); ?>">
                            </span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-0.5">
                                <h3 class="font-extrabold text-gray-900 dark:text-stone-100 truncate text-sm md:text-base">
                                    <?php echo e($user->name); ?></h3>
                                <span
                                    class="text-[10px] md:text-[11px] font-bold text-gray-400 dark:text-stone-500 uppercase tracking-tighter truncate">
                                    <?php echo e($user->last_seen ? $user->last_seen->diffForHumans(null, true) : ''); ?>

                                </span>
                            </div>
                            <p
                                class="text-xs md:text-sm text-gray-500 dark:text-stone-400 truncate leading-snug font-medium max-w-[70%]">
                                <?php echo e($user->last_message ? Str::limit($user->last_message, 30) : 'Start a new conversation'); ?>

                            </p>
                        </div>

                        <?php if($user->last_status): ?>
                            <div class="flex-shrink-0">
                                <?php if($user->last_status == 'sent'): ?>
                                    <i data-lucide="check" class="w-3 h-3 md:w-4 md:h-4 text-gray-300 dark:text-stone-600"></i>
                                <?php elseif($user->last_status == 'read' || $user->last_status == 'delivered'): ?>
                                    <i data-lucide="check-check"
                                        class="w-3 h-3 md:w-4 md:h-4 <?php echo e($user->last_status == 'read' ? 'text-amber-500 dark:text-amber-400' : 'text-gray-300 dark:text-stone-600'); ?>"></i>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div
                        class="h-full flex flex-col items-center justify-center opacity-40 text-gray-400 dark:text-stone-500 p-8 space-y-4 truncate">
                        <i data-lucide="ghost" class="w-12 h-12 md:w-16 md:h-16"></i>
                        <p class="font-bold text-sm md:text-base truncate">No active users found.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/messages/index.blade.php ENDPATH**/ ?>