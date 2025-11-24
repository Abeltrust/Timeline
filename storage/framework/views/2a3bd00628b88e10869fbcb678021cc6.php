

<?php $__env->startSection('title', 'Login - Timeline'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Welcome Back</h2>

        <!-- Login Form -->
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-stone-700">Email</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="pl-10 py-3 block w-full rounded-xl border border-stone-300 focus:ring-amber-500 focus:border-amber-500 text-stone-700 placeholder-stone-400"
                        placeholder="your@email.com">
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-stone-700">Password</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </span>
                    <input id="password" type="password" name="password" required
                        class="pl-10 py-3 block w-full rounded-xl border border-stone-300 focus:ring-amber-500 focus:border-amber-500 text-stone-700 placeholder-stone-400"
                        placeholder="Your password">
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold py-3 rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                Sign In
            </button>
        </form>

        <!-- Links -->
        <div class="mt-4 text-center">
            <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-stone-500 hover:text-amber-600">Forgot your password?</a>
        </div>
        <div class="mt-2 text-center">
            <p class="text-sm text-stone-600">
                Don’t have an account? 
                <a href="<?php echo e(route('register')); ?>" class="font-medium text-amber-600 hover:underline">Join Timeline</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\resources\views/login.blade.php ENDPATH**/ ?>