<?php $__env->startSection('title', 'Share Your Culture - Cultural Hub'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8"
     x-data="shareCulture(<?php echo e(count($errors) ? session('last_step', 1) : 1); ?>)">

    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 mb-4">
            <a href="<?php echo e(route('cultural-hub.index')); ?>" 
               class="p-2 text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors mb-2 sm:mb-0 w-fit">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div class="flex items-center space-x-3">
                <i data-lucide="globe" class="w-8 h-8 text-amber-600"></i>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-stone-800">Share Your Culture</h1>
                    <p class="text-stone-600 text-sm sm:text-base">Contribute to the global preservation of cultural heritage</p>
                </div>
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="flex justify-between items-center mb-4 sm:mb-6 space-x-1">
            <template x-for="step in 5" :key="step">
                <div class="flex-1 flex items-center">
                    <div :class="step === currentStep ? 'bg-amber-500 text-white' : step < currentStep ? 'bg-green-500 text-white' : 'bg-stone-200 text-stone-600'"
                         class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-all duration-200 flex-shrink-0">
                        <span x-show="step < currentStep">✓</span>
                        <span x-show="step >= currentStep" x-text="step"></span>
                    </div>
                    <div x-show="step < 5" 
                         :class="step < currentStep ? 'bg-green-500' : 'bg-stone-200'"
                         class="flex-1 h-1 mx-1 transition-all duration-200"></div>
                </div>
            </template>
        </div>

        <!-- Step Title -->
        <div class="text-sm text-stone-600 mb-4 sm:mb-6">
            Step <span x-text="currentStep"></span> of 5: 
          <b> <span x-text="stepTitles[currentStep - 1]"></span></b>
        </div>
    </div>

    <form action="<?php echo e(route('cultural-hub.store')); ?>" 
          method="POST" 
          enctype="multipart/form-data" 
          class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-stone-100 space-y-6 sm:space-y-8">
        <?php echo csrf_field(); ?>
        
        <!-- Steps -->
        <div x-show="currentStep === 1" class="space-y-4 sm:space-y-6">
            <?php echo $__env->make('cultural-hub.steps.basic-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div x-show="currentStep === 2" class="space-y-4 sm:space-y-6">
            <?php echo $__env->make('cultural-hub.steps.significance', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div x-show="currentStep === 3" class="space-y-4 sm:space-y-6">
            <?php echo $__env->make('cultural-hub.steps.status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div x-show="currentStep === 4" class="space-y-4 sm:space-y-6">
            <?php echo $__env->make('cultural-hub.steps.media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div x-show="currentStep === 5" class="space-y-4 sm:space-y-6">
            <?php echo $__env->make('cultural-hub.steps.personal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <!-- Navigation -->
        <div class="flex flex-wrap items-center justify-between pt-6 mt-6 border-t border-stone-200 gap-2">
            <button type="button" 
                    @click="previousStep()" 
                    x-show="currentStep > 1" 
                    class="flex items-center justify-center space-x-2 px-4 py-2 text-stone-600 hover:text-stone-800 transition-colors flex-1 sm:flex-none">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Previous</span>
            </button>
            
            <button type="submit" name="draft" value="1"
                    class="px-4 py-2 text-stone-600 hover:text-stone-800 transition-colors flex-1 sm:flex-none">
                Save Draft
            </button>
            
            <button type="button" 
                    @click="nextStep()" 
                    x-show="currentStep < 5" 
                    class="flex items-center justify-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all duration-200 flex-1 sm:flex-none">
                <span>Next</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
            
            <button type="submit" 
                    x-show="currentStep === 5" 
                    class="flex items-center justify-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-200 flex-1 sm:flex-none">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Submit Culture</span>
            </button>
        </div>
    </form>

    <!-- Help Section -->
    <?php echo $__env->make('cultural-hub.steps.help', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function shareCulture(initialStep = 1) {
        return {
            currentStep: initialStep,
            stepTitles: [
                'Basic Information',
                'Cultural Significance',
                'Current Status',
                'Media Documentation',
                'Personal Connection'
            ],
            nextStep() {
                if (this.currentStep < 5) this.currentStep++;
            },
            previousStep() {
                if (this.currentStep > 1) this.currentStep--;
            }
        }
    }
    
    document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\resources\views/cultural-hub/create.blade.php ENDPATH**/ ?>