

<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <h1 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-stone-100">Notifications</h1>
            <button onclick="markAllAsRead()" class="text-sm sm:text-base text-amber-500 hover:underline">
                Mark all as read
            </button>
        </div>

        <!-- FILTER TABS -->
        <div class="flex flex-wrap gap-2 sm:gap-3 mb-6">
            <?php
                $filters = [
                    'all' => 'All',
                    'unread' => 'Unread',
                    'tap' => 'TAPs',
                    'lock-in' => 'Lock-Ins',
                    'resonance' => 'Resonance'
                ];
            ?>

            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('notifications.index', ['filter' => $key])); ?>"
                    class="px-3 sm:px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-colors
                        <?php echo e($filter === $key ? 'bg-amber-500 text-white' : 'bg-gray-100 dark:bg-stone-800 text-gray-600 dark:text-stone-400 hover:bg-gray-200 dark:hover:bg-stone-700'); ?>">
                    <?php echo e($label); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- NOTIFICATION LIST -->
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div
                    class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 p-4 bg-white dark:bg-stone-900 rounded-xl border border-gray-100 dark:border-stone-800 shadow-sm hover:bg-gray-50 dark:hover:bg-stone-800/50 transition">

                    <!-- LEFT SIDE -->
                    <div class="flex items-start gap-3">
                        <!-- AVATAR / ICON -->
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                <?php echo e($notification->read ? 'bg-gray-200 dark:bg-stone-800 text-gray-500 dark:text-stone-500' : 'bg-amber-500 text-amber-600 dark:text-amber-100'); ?>">
                            <span class="font-bold text-sm">
                                <?php echo e(strtoupper(substr($notification->fromUser->name ?? 'N/A', 0, 2))); ?>

                            </span>
                        </div>

                        <!-- MESSAGE -->
                        <div>
                            <p class="text-sm sm:text-base text-gray-800 dark:text-stone-200">
                                <?php echo $notification->message; ?>

                            </p>
                            <p class="text-xs text-gray-500 dark:text-stone-500 mt-1">
                                <?php echo e($notification->created_at->diffForHumans()); ?>

                            </p>
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-row sm:flex-col items-center sm:items-end gap-2">
                        <?php if(!$notification->read): ?>
                            <button onclick="markAsRead('<?php echo e($notification->id); ?>')" class="text-xs text-amber-500 hover:underline">
                                Mark as read
                            </button>
                        <?php endif; ?>
                        <button onclick="deleteNotification('<?php echo e($notification->id); ?>')"
                            class="text-xs text-red-500 hover:underline">
                            Dismiss
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-500 dark:text-stone-500 text-center">No notifications found.</p>
            <?php endif; ?>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            <?php echo e($notifications->links()); ?>

        </div>
    </div>

    <script>
        function markAsRead(id) {
            fetch(`/notifications/${id}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            }).then(() => location.reload());
        }

        function markAllAsRead() {
            fetch(`/notifications/read-all`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            }).then(() => location.reload());
        }

        function deleteNotification(id) {
            fetch(`/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            }).then(() => location.reload());
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/notifications/index.blade.php ENDPATH**/ ?>