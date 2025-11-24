


<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

    
    <div class="bg-white rounded-2xl shadow-md p-6 space-y-4 border border-stone-100">
        <h2 class="text-xl font-semibold">Start Your Live Stream</h2>
        <form action="<?php echo e(route('live-stream.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="space-y-4">
                <input type="text" name="title" placeholder="What will you be sharing today?" class="w-full border rounded-lg p-3 text-sm" required>
                <textarea name="description" rows="3" placeholder="Tell viewers what they can expect to learn..." class="w-full border rounded-lg p-3 text-sm"></textarea>
                <input type="text" name="category" placeholder="Category (e.g., Heritage, Crafts)" class="w-full border rounded-lg p-3 text-sm">
            </div>
            <button type="submit" class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500 transition">
                <i data-lucide="video"></i> Go Live
            </button>
        </form>
        <p class="text-xs text-gray-500 mt-2">Tip: Share cultural practices, traditional crafts, or heritage stories.</p>
    </div>

    
    <div>
        <h2 class="text-xl font-semibold mb-4">Live Now</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $liveStreams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-stone-100">
                <div class="relative">
                    <img src="<?php echo e($stream->thumbnail ?? 'https://via.placeholder.com/400x200'); ?>" alt="Stream Thumbnail" class="w-full h-48 object-cover">
                    <span class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs flex items-center gap-1">
                        <i data-lucide="video"></i> LIVE
                    </span>
                    <span class="absolute top-2 right-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs"><?php echo e($stream->viewers_count); ?> viewers</span>
                </div>
                <div class="p-4 space-y-1">
                    <h3 class="font-semibold text-stone-800"><?php echo e($stream->title); ?></h3>
                    <p class="text-sm text-stone-500">Host: <?php echo e($stream->host->name); ?></p>
                    <?php if($stream->category): ?>
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mt-1"><?php echo e($stream->category); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => { lucide.createIcons() });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\resources\views/live-streaming/index.blade.php ENDPATH**/ ?>