

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">

    <!-- LEFT COLUMN (ACTIVE USERS) -->
    <div class="w-1/4 border-r border-gray-200 bg-white overflow-y-auto">
        <div class="p-4 font-bold text-gray-700 border-b">Active Users</div>

        <?php $__currentLoopData = $activeUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('messages.start', $user->id)); ?>" 
               class="flex items-center gap-3 p-3 hover:bg-gray-100 cursor-pointer">
                <div class="relative">
                    <img src="<?php echo e($user->avatar); ?>" class="w-10 h-10 rounded-full object-cover">
                    <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full 
                        <?php echo e($user->status == 'online' ? 'bg-amber-400' : 'bg-gray-400'); ?>">
                    </span>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800"><?php echo e($user->name); ?></p>
                    <p class="text-xs text-gray-500 truncate"><?php echo e($user->last_message); ?></p>
                </div>
                <div>
                    <?php if($user->last_status == 'sent'): ?>
                        <i data-lucide="check" class="w-4 h-4 text-gray-400"></i>
                    <?php elseif($user->last_status == 'read'): ?>
                        <i data-lucide="check-check" class="w-4 h-4 text-amber-500"></i>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- RIGHT COLUMN (CHAT) -->
    <div class="flex-1 flex flex-col">

        <?php if($selectedConversation): ?>
            <?php
                $otherUser = $selectedConversation->participants
                    ->where('id', '!=', auth()->id())
                    ->first();
            ?>

            <!-- CHAT HEADER -->
            <div class="flex items-center justify-between p-4 border-b bg-white">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e($otherUser->avatar ?? ''); ?>" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <p class="font-semibold text-gray-800"><?php echo e($otherUser->name ?? 'Unknown'); ?></p>
                        <p class="text-xs text-gray-500">
                            <?php echo e($otherUser->is_online ? 'Online' : 'Last seen ' . $otherUser->last_seen->diffForHumans()); ?>

                        </p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <i data-lucide="phone" class="w-5 h-5 text-gray-600 cursor-pointer"></i>
                    <i data-lucide="video" class="w-5 h-5 text-gray-600 cursor-pointer"></i>
                </div>
            </div>

            <!-- CHAT MESSAGES -->
            <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-100">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex <?php echo e($msg->user_id == auth()->id() ? 'justify-end' : 'justify-start'); ?>">
                        <div class="max-w-xs px-4 py-2 rounded-2xl 
                            <?php echo e($msg->user_id == auth()->id() ? 'bg-amber-400 text-white rounded-br-none' : 'bg-white text-gray-800 rounded-bl-none'); ?>">
                            <p><?php echo e($msg->content); ?></p>
                            <div class="flex justify-end mt-1 space-x-1 text-xs text-gray-600">
                                <span><?php echo e($msg->created_at->format('H:i')); ?></span>
                                <?php if($msg->user_id == auth()->id()): ?>
                                    <?php if($msg->status == 'sent'): ?>
                                        <i data-lucide="check" class="w-4 h-4"></i>
                                    <?php elseif($msg->status == 'read'): ?>
                                        <i data-lucide="check-check" class="w-4 h-4 text-amber-600"></i>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- CHAT INPUT -->
            <form action="<?php echo e(route('messages.store', $selectedConversation->id)); ?>" method="POST" class="p-3 border-t bg-white flex items-center gap-3">
                <?php echo csrf_field(); ?>
                <input type="text" name="content" placeholder="Type a message..."
                    class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring focus:ring-amber-300">
                <button type="submit" class="bg-amber-500 text-white rounded-full p-2">
                    <i data-lucide="send" class="w-5 h-5"></i>
                </button>
            </form>
        <?php else: ?>
            <div class="flex-1 flex items-center justify-center text-gray-500">
                Select a conversation to start chatting
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\resources\views/messages/index.blade.php ENDPATH**/ ?>