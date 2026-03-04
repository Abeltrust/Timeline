

<?php $__env->startSection('title', 'Register - Timeline'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-bold mb-6 text-center text-amber-500 ">Register</h2>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Name -->
            <div class="mb-4 relative">
                <label for="name" class="block text-sm font-medium text-stone-700 mb-1">Name</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="circle-user-round" class="w-5 h-5"></i>
                    </span>
                    <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus
                        class="pl-10 py-3 block w-full stnd-input px-4" placeholder="name">
                    <?php $__errorArgs = ['name'];
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
            </div>

            <!-- Username -->
            <div class="mb-4 relative">
                <label for="username" class="block text-sm font-medium text-stone-700 mb-1">Username</label>
                <div class="mt-1 relative">
                    <span class="mb-1 absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </span>
                    <input id="username" type="text" name="username" value="<?php echo e(old('username')); ?>" required
                        class="pl-10 py-3 block w-full stnd-input px-4" placeholder="username">
                    <?php $__errorArgs = ['username'];
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
            </div>

            <!-- Email -->
            <div class="mb-4 relative">
                <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </span>
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="pl-10 py-3 block w-full stnd-input px-4" placeholder="your@email.com">
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
            </div>

            <!-- Password -->
            <div class="mb-4 relative" x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-stone-700 mb-1">Password</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </span>
                    <input id="password" :type="show ? 'text' : 'password'" name="password" required
                        class="pl-10 py-3 block w-full stnd-input px-4" placeholder="Your password">
                    <button type="button" class="absolute inset-y-0 right-3 text-sm text-gray-500" @click="show = !show"
                        tabindex="-1">
                        <span x-show="!show">👁</span>
                        <span x-show="show">🙈</span>
                    </button>
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
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 relative" x-data="{ show: false }">
                <label for="password_confirmation" class="block text-sm font-medium text-stone-700 mb-1">Confirm
                    Password</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </span>
                    <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation"
                        required class="pl-10 py-3 block w-full stnd-input px-4" placeholder="confirmation password">
                    <button type="button" class="absolute inset-y-0 right-3 text-sm text-gray-500" @click="show = !show"
                        tabindex="-1">
                        <span x-show="!show">👁</span>
                        <span x-show="show">🙈</span>
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold py-3 rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                Sign Up
            </button>

            <!-- Extra links -->
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-stone-500 hover:text-amber-600">Forgot your
                    password?</a>
            </div>
            <div class="mt-2 text-center">
                <p class="text-sm text-stone-600">
                    Already have an account?
                    <a href="<?php echo e(route('login')); ?>" class="font-medium text-amber-600 hover:underline">Login</a>
                </p>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/auth/register.blade.php ENDPATH**/ ?>