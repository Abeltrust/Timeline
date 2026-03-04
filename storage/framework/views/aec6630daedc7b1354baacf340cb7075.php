

<?php $__env->startSection('content'); ?>
    <div class="max-w-5xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- SIDEBAR -->
            <aside class="bg-white dark:bg-stone-800 border dark:border-stone-700 rounded-xl shadow p-4 space-y-2">
                <button data-tab="profile"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg bg-amber-50 text-amber-600 font-medium">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    Profile
                </button>
                <button data-tab="notifications"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg hover:bg-gray-50">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    Notifications
                </button>
                <button data-tab="privacy"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg hover:bg-gray-50">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                    Privacy & Security
                </button>
                <button data-tab="cultural"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg hover:bg-gray-50">
                    <i data-lucide="globe" class="w-5 h-5"></i>
                    Cultural Settings
                </button>
                <button data-tab="appearance"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg hover:bg-gray-50">
                    <i data-lucide="palette" class="w-5 h-5"></i>
                    Appearance
                </button>
                <button data-tab="storage"
                    class="tab-btn flex items-center gap-2 px-3 py-2 w-full text-left rounded-lg hover:bg-gray-50">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    Data & Storage
                </button>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="md:col-span-3 bg-white dark:bg-stone-800 border dark:border-stone-700 rounded-xl shadow p-6">

                <!-- PROFILE PAGE -->
                <div id="tab-profile" class="tab-page">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Profile</h2>
                    <form action="<?php echo e(route('settings.update', Auth::user()->id)); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>"
                                    class="w-full stnd-input p-2 mt-1 dark:bg-stone-900 dark:text-gray-100 dark:border-stone-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                <input type="text" name="username" value="<?php echo e(Auth::user()->username); ?>"
                                    class="w-full stnd-input p-2 mt-1 dark:bg-stone-900 dark:text-gray-100 dark:border-stone-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                            <textarea name="bio" rows="3"
                                class="w-full stnd-input p-2 mt-1 dark:bg-stone-900 dark:text-gray-100 dark:border-stone-700"><?php echo e(Auth::user()->bio); ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                <input type="text" name="location" value="<?php echo e(Auth::user()->location); ?>"
                                    class="w-full stnd-input p-2 mt-1 dark:bg-stone-900 dark:text-gray-100 dark:border-stone-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website</label>
                                <input type="url" name="website" value="<?php echo e(Auth::user()->website); ?>"
                                    class="w-full stnd-input p-2 mt-1 dark:bg-stone-900 dark:text-gray-100 dark:border-stone-700">
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4">
                            <button type="button" class="text-red-500 text-sm font-medium flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                Delete Account
                            </button>
                            <button type="submit"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-medium">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- NOTIFICATIONS PAGE -->
                <div id="tab-notifications" class="tab-page hidden">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Notifications</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Manage how you receive notifications.</p>
                    <div class="mt-4 space-y-3">
                        <label class="flex items-center gap-2 dark:text-gray-300">
                            <input type="checkbox" class="rounded border-gray-300 dark:border-stone-600 dark:bg-stone-900">
                            Email Alerts
                        </label>
                        <label class="flex items-center gap-2 dark:text-gray-300">
                            <input type="checkbox" class="rounded border-gray-300 dark:border-stone-600 dark:bg-stone-900">
                            Push Notifications
                        </label>
                    </div>
                </div>

                <!-- PRIVACY PAGE -->
                <div id="tab-privacy" class="tab-page hidden">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Privacy & Security</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Control who can see your profile and secure your
                        account.</p>
                </div>

                <!-- CULTURAL PAGE -->
                <div id="tab-cultural" class="tab-page hidden">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Cultural Settings</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Customize your cultural experience.</p>
                </div>

                <!-- APPEARANCE PAGE -->
                <div id="tab-appearance" class="tab-page hidden">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Appearance</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6">Customize the interface theme of Timeline.</p>

                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 dark:bg-stone-800 rounded-xl border border-gray-100 dark:border-stone-700">
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-200">Dark Mode</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Easier on the eyes in low light.</p>
                        </div>

                        <button id="theme-toggle"
                            class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 bg-gray-200 dark:bg-amber-500">
                            <span class="sr-only">Toggle Dark Mode</span>
                            <span id="theme-toggle-slider"
                                class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform translate-x-1 dark:translate-x-6"></span>
                        </button>
                    </div>
                </div>

                <!-- STORAGE PAGE -->
                <div id="tab-storage" class="tab-page hidden">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Data & Storage</h2>
                    <p class="text-gray-600 text-sm">Manage your storage and data usage.</p>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const buttons = document.querySelectorAll(".tab-btn");
            const pages = document.querySelectorAll(".tab-page");

            buttons.forEach(btn => {
                btn.addEventListener("click", () => {
                    let target = btn.getAttribute("data-tab");

                    // Reset styles
                    buttons.forEach(b => b.classList.remove("bg-amber-50", "text-amber-600", "font-medium"));
                    pages.forEach(p => p.classList.add("hidden"));

                    // Activate selected
                    btn.classList.add("bg-amber-50", "text-amber-600", "font-medium");
                    document.getElementById("tab-" + target).classList.remove("hidden");
                });
            });

            // --- Dark Mode Toggle Logic ---
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleSlider = document.getElementById('theme-toggle-slider');

            // Initialize slider position based on current theme
            if (document.documentElement.classList.contains('dark')) {
                themeToggleSlider.classList.remove('translate-x-1');
                themeToggleSlider.classList.add('translate-x-6');
                themeToggleBtn.classList.remove('bg-gray-200');
                themeToggleBtn.classList.add('bg-amber-500');
            }

            themeToggleBtn.addEventListener('click', function () {
                // Toggle the 'dark' class on HTML element
                document.documentElement.classList.toggle('dark');

                const isDark = document.documentElement.classList.contains('dark');

                // Update Local Storage
                if (isDark) {
                    localStorage.setItem('theme', 'dark');
                    themeToggleSlider.classList.remove('translate-x-1');
                    themeToggleSlider.classList.add('translate-x-6');
                    themeToggleBtn.classList.remove('bg-gray-200');
                    themeToggleBtn.classList.add('bg-amber-500');
                } else {
                    localStorage.setItem('theme', 'light');
                    themeToggleSlider.classList.remove('translate-x-6');
                    themeToggleSlider.classList.add('translate-x-1');
                    themeToggleBtn.classList.remove('bg-amber-500');
                    themeToggleBtn.classList.add('bg-gray-200');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Laravel\Timeline\resources\views/profile/settings.blade.php ENDPATH**/ ?>