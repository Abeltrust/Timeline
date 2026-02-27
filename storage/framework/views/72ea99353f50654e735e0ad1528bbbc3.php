

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-3 sm:px-4 py-6 sm:py-8">

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-5 sm:mb-6 space-y-3 sm:space-y-0 text-center sm:text-left">
        <div>
            <h1 class="text-lg sm:text-2xl font-bold text-gray-800">Personal Vault</h1>
            <p class="text-gray-600 text-xs sm:text-sm">Your private collection of memories and important moments.</p>
        </div>

        <a href="<?php echo e(route('vault.create')); ?>"
           class="inline-block text-sm sm:text-base px-3 sm:px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-lg shadow hover:opacity-90 transition">
            + Add Memory
        </a>
    </div>

    
    <div class="flex flex-wrap justify-center sm:justify-start gap-2 sm:gap-3 mb-5 sm:mb-6">
        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('vault.index', ['type' => $key])); ?>"
               class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium whitespace-nowrap
                      <?php echo e($type === $key 
                        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                <?php echo e($label); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if($items->count()): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 sm:p-5 flex flex-col justify-between">

                    
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <?php switch($item->type):
                                case ('photos'): ?>
                                    <i data-lucide="image" class="w-4 h-4 sm:w-5 sm:h-5 text-purple-500"></i>
                                    <?php break; ?>
                                <?php case ('documents'): ?>
                                    <i data-lucide="file-text" class="w-4 h-4 sm:w-5 sm:h-5 text-blue-500"></i>
                                    <?php break; ?>
                                <?php case ('videos'): ?>
                                    <i data-lucide="video" class="w-4 h-4 sm:w-5 sm:h-5 text-red-500"></i>
                                    <?php break; ?>
                                <?php case ('audio'): ?>
                                    <i data-lucide="music" class="w-4 h-4 sm:w-5 sm:h-5 text-pink-500"></i>
                                    <?php break; ?>
                                <?php default: ?>
                                    <i data-lucide="file" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500"></i>
                            <?php endswitch; ?>
                            <h2 class="font-semibold text-gray-800 text-sm sm:text-base truncate max-w-[160px] sm:max-w-[200px]">
                                <?php echo e($item->title); ?>

                            </h2>
                        </div>
                        <form action="<?php echo e(route('vault.destroy', $item)); ?>" method="POST" 
                              onsubmit="return confirm('Delete this item?')" class="flex-shrink-0">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                <i data-lucide="trash-2" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </button>
                        </form>
                    </div>

                    
                    <p class="text-gray-600 text-xs sm:text-sm mb-4 leading-snug"><?php echo e(Str::limit($item->description, 100)); ?></p>

                    
                    <div class="flex items-center justify-between text-[11px] sm:text-xs text-gray-500 mb-4">
                        <span><?php echo e($item->created_at->format('M d, Y')); ?></span>
                        <span><?php echo e($item->file_size); ?></span>
                    </div>

                    
                    <div class="flex items-center justify-between">
                        <a href="<?php echo e(route('vault.show', $item)); ?>" 
                           class="text-xs sm:text-sm font-medium text-gray-600 hover:text-orange-600">
                            View
                        </a>
                        <a href="<?php echo e(route('vault.download', $item)); ?>" 
                           class="px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow hover:opacity-90 transition">
                            Download
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-6 sm:mt-8">
            <?php echo e($items->links()); ?>

        </div>

    <?php else: ?>
        <p class="text-gray-600 text-center text-sm sm:text-base">No items in your vault yet.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    lucide.createIcons(); // render Lucide icons
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Laravel\Timeline\resources\views/vault/index.blade.php ENDPATH**/ ?>