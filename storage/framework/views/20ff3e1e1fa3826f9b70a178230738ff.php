


<?php $__env->startSection('content'); ?>
    <div class="flex flex-col min-h-screen bg-stone-50 overflow-x-hidden w-full box-border">
        <div class="max-w-4xl mx-auto p-4 sm:p-6 space-y-6 w-full box-border">

            
            <div class="flex flex-col items-center pt-8">
                <div
                    class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white">
                    <img src="<?php echo e($user->profile_photo_url); ?>" alt="<?php echo e($user->name); ?>" class="w-full h-full object-cover">

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() === $user->id): ?>
                            <form action="<?php echo e(route('profile.photo.upload')); ?>" method="POST" enctype="multipart/form-data"
                                class="absolute bottom-0 right-0">
                                <?php echo csrf_field(); ?>
                                <label class="cursor-pointer bg-white p-1 rounded-full shadow hover:bg-gray-100 transition">
                                    <input type="file" name="profile_photo" class="hidden" onchange="this.form.submit()">
                                    <i data-lucide="camera" class="w-4 h-4 text-orange-500"></i>
                                </label>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                
                <div class="text-center mt-4 w-full px-4">
                    <h1 class="text-lg sm:text-2xl font-black text-stone-800 truncate"><?php echo e($user->name); ?></h1>
                    <p class="text-xs sm:text-sm text-stone-500 mt-1 max-w-md mx-auto leading-snug">
                        <?php echo e($user->bio ?? 'Software Architect & Cultural Preservationist | Building bridges between tech & heritage'); ?>

                    </p>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() === $user->id): ?>
                            <a href="<?php echo e(route('profile.edit')); ?>"
                                class="inline-flex items-center mt-3 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition-all active:scale-95">
                                Edit Profile
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center px-3">
                <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
                    <p class="text-md font-semibold text-stone-800"><?php echo e($user->stories_count ?? 0); ?></p>
                    <p class="text-xs text-stone-500 mt-1">Stories</p>
                </div>
                <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
                    <p class="text-md font-semibold text-stone-800"><?php echo e($user->locked_in_count ?? 0); ?></p>
                    <p class="text-xs text-stone-500 mt-1">Locked-In</p>
                </div>
                <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
                    <p class="text-md font-semibold text-stone-800"><?php echo e($user->taps_count ?? 0); ?></p>
                    <p class="text-xs text-stone-500 mt-1">TAPs</p>
                </div>
                <div class="bg-white rounded-xl shadow p-3 border border-stone-100">
                    <p class="text-md font-semibold text-stone-800"><?php echo e($user->life_chapters_count ?? 0); ?></p>
                    <p class="text-xs text-stone-500 mt-1">Chapters</p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl shadow p-4 border border-stone-100 mx-3 sm:mx-0">
                <div class="flex gap-4 border-b border-stone-200 mb-3 overflow-x-auto scrollbar-hide">
                    <button class="text-sm font-medium pb-2 border-b-2 border-orange-500 flex-shrink-0">Life Story</button>
                    <button
                        class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Cultural
                        Identity</button>
                    <button
                        class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Achievements</button>
                    <button
                        class="text-sm font-medium pb-2 text-stone-500 hover:text-orange-500 transition flex-shrink-0">Private
                        Vault</button>
                </div>

                
                <div class="space-y-3">
                    <?php $__currentLoopData = $user->lifeChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-stone-50 p-3 rounded-xl border border-stone-100 flex flex-col sm:flex-row justify-between items-start gap-3">
                            <div class="flex gap-3 items-start flex-1">
                                <div class="p-2 bg-orange-400 rounded-lg text-white flex-shrink-0">
                                    <i data-lucide="book" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-stone-800 text-sm sm:text-base"><?php echo e($chapter->title); ?></h3>
                                    <p class="text-stone-600 text-xs sm:text-sm mt-0.5"><?php echo e($chapter->description); ?></p>
                                    <p class="text-xs text-stone-400 mt-1"><?php echo e($chapter->location ?? 'Jos, Nigeria'); ?> •
                                        <?php echo e($chapter->stories_count ?? 0); ?> Stories
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs text-stone-400 mt-1 sm:mt-0"><?php echo e($chapter->start_year); ?> -
                                <?php echo e($chapter->end_year ?? 'Present'); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->id() === $user->id): ?>
                            <a href=""
                                class="inline-flex items-center gap-2 px-3 py-1.5 text-orange-500 border border-orange-300 rounded-lg hover:bg-orange-50 transition text-sm">
                                <i data-lucide="plus" class="w-4 h-4"></i> Add Chapter
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/profile/index.blade.php ENDPATH**/ ?>