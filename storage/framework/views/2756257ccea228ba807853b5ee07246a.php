<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo $__env->yieldContent('title', 'Timeline - Cultural Preservation Platform'); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        stone: {
                            50: '#fafaf9',
                            100: '#f5f5f4',
                            200: '#e7e5e4',
                            300: '#d6d3d1',
                            400: '#a8a29e',
                            500: '#78716c',
                            600: '#57534e',
                            700: '#44403c',
                            800: '#292524',
                            900: '#1c1917',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full bg-stone-50 antialiased">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 h-16 bg-white/95 backdrop-blur-sm border-b border-stone-200 z-50">
        <div class="flex items-center justify-between h-full px-6">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="book-open" class="w-5 h-5 text-white"></i>
                </div>
                <a href="<?php echo e(route('timeline.index')); ?>" class="text-xl font-bold bg-gradient-to-r from-stone-800 to-stone-600 bg-clip-text text-transparent hover:from-amber-600 hover:to-orange-600 transition-all duration-200">
                    Timeline
                </a>
            </div>

            <!-- Search Bar -->
            <?php if(auth()->guard()->check()): ?>
            <div class="flex-1 max-w-md mx-8">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-stone-400"></i>
                    <input type="text" placeholder="Search stories, cultures, people..." 
                           class="w-full pl-10 pr-4 py-2 bg-stone-100 border-0 rounded-lg focus:ring-2 focus:ring-amber-500 focus:bg-white transition-all duration-200">
                </div>
            </div>
            <?php endif; ?>

            <div class="flex items-center space-x-4">
                <?php if(auth()->guard()->check()): ?>
                    <!-- Live Button -->
                    <button class="p-2 text-stone-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all duration-200" title="Go Live">
                        <i data-lucide="video" class="w-5 h-5"></i>
                    </button>
                    
                    <!-- Notifications -->
                    <a href="<?php echo e(route('notifications.index')); ?>" class="relative p-2 text-stone-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all duration-200" title="Notifications">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <?php if(auth()->user()->notifications()->unread()->count() > 0): ?>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    
                    <!-- Share Story Button -->
                    <button onclick="openCreatePostModal()" class="flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all duration-200 shadow-sm hover:shadow-md">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span class="font-medium">Share Story</span>
                    </button>
                    
                    <!-- User Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 hover:bg-stone-100 rounded-lg p-2 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm"><?php echo e(auth()->user()->initials); ?></span>
                            </div>
                            <span class="text-sm font-medium text-stone-700 hidden md:block"><?php echo e(auth()->user()->name); ?></span>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-stone-200 py-2">
                            <a href="<?php echo e(route('profile.show')); ?>" class="block px-4 py-2 text-sm text-stone-700 hover:bg-stone-50">My Profile</a>
                            <a href="<?php echo e(route('settings.index')); ?>" class="block px-4 py-2 text-sm text-stone-700 hover:bg-stone-50">Settings</a>
                            <hr class="my-2">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                <button onclick="openLoginModal()" class="text-stone-600 hover:text-stone-800 font-medium transition-colors">
                    Sign In
                </button>
            <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-16 w-20 h-[calc(100vh-4rem)] bg-white border-r border-stone-200 overflow-y-auto">
            <div class="p-4">
                <!-- Main Navigation -->
                <nav class="space-y-3">
                    <?php
                    $menuItems = [
                        ['route' => 'timeline.index', 'icon' => 'home', 'label' => 'Timeline', 'tooltip' => 'Your chronological feed'],
                        ['route' => 'discover.index', 'icon' => 'compass', 'label' => 'Discover', 'tooltip' => 'Find new stories & cultures', 'auth' => true],
                        ['route' => 'cultural-hub.index', 'icon' => 'globe', 'label' => 'Cultural Hub', 'tooltip' => 'Explore global heritage'],
                        ['route' => 'communities.index', 'icon' => 'users', 'label' => 'Communities', 'tooltip' => 'Join cultural groups', 'auth' => true],
                        ['route' => 'events.index', 'icon' => 'calendar', 'label' => 'Events', 'tooltip' => 'Cultural events & meetups', 'auth' => true],
                        ['route' => 'profile.show', 'icon' => 'user', 'label' => 'My Story', 'tooltip' => 'Your life journey', 'auth' => true],
                        ['route' => 'vault.index', 'icon' => 'archive', 'label' => 'Vault', 'tooltip' => 'Private memories', 'auth' => true],
                        ['route' => 'messages.index', 'icon' => 'message-circle', 'label' => 'Messages', 'tooltip' => 'Connect with others', 'auth' => true],
                    ];
                    ?>
                    
                    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!isset($item['auth']) || auth()->check()): ?>
                        <div class="relative group">
                            <a href="<?php echo e(route($item['route'])); ?>" 
                               class="w-12 h-12 flex items-center justify-center rounded-xl transition-all duration-200 <?php echo e(request()->routeIs($item['route']) ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-800'); ?>">
                                <i data-lucide="<?php echo e($item['icon']); ?>" class="w-5 h-5"></i>
                            </a>
                            
                            <!-- Tooltip -->
                            <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-stone-800 text-white px-3 py-2 rounded-lg text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
                                <?php echo e($item['tooltip']); ?>

                                <div class="absolute left-0 top-1/2 transform -translate-x-1 -translate-y-1/2 w-2 h-2 bg-stone-800 rotate-45"></div>
                            </div>
                        </div>
                        <?php elseif(isset($item['auth']) && !auth()->check()): ?>
                        <div class="relative group">
                            <div class="w-12 h-12 flex items-center justify-center rounded-xl text-stone-400 cursor-not-allowed relative">
                                <i data-lucide="<?php echo e($item['icon']); ?>" class="w-5 h-5"></i>
                                <i data-lucide="lock" class="absolute -top-1 -right-1 w-3 h-3 text-stone-400"></i>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>

                <!-- Secondary Navigation -->
                <?php if(auth()->guard()->check()): ?>
                <div class="mt-6 pt-4 border-t border-stone-200">
                    <nav class="space-y-3">
                        <?php
                        $secondaryItems = [
                            ['route' => 'notifications.index', 'icon' => 'bell', 'tooltip' => 'Your activity updates'],
                            ['route' => 'analytics.index', 'icon' => 'bar-chart-3', 'tooltip' => 'Story insights'],
                            ['route' => 'settings.index', 'icon' => 'settings', 'tooltip' => 'Account preferences'],
                        ];
                        ?>
                        
                        <?php $__currentLoopData = $secondaryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative group">
                            <a href="<?php echo e(route($item['route'])); ?>" 
                               class="w-12 h-12 flex items-center justify-center rounded-xl transition-all duration-200 <?php echo e(request()->routeIs($item['route']) ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-800'); ?>">
                                <i data-lucide="<?php echo e($item['icon']); ?>" class="w-5 h-5"></i>
                            </a>
                            
                            <!-- Tooltip -->
                            <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-stone-800 text-white px-3 py-2 rounded-lg text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
                                <?php echo e($item['tooltip']); ?>

                                <div class="absolute left-0 top-1/2 transform -translate-x-1 -translate-y-1/2 w-2 h-2 bg-stone-800 rotate-45"></div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </nav>
                </div>
                <?php endif; ?>

                <!-- Brand Section -->
                <div class="mt-6 pt-4">
                    <div class="relative group">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                            <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                        </div>
                        
                        <!-- Tooltip -->
                        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-stone-800 text-white px-3 py-2 rounded-lg text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50 w-64">
                            <div class="font-semibold mb-1">Your Story Matters</div>
                            <div class="text-xs">Timeline preserves your authentic journey through Cultugraph integration</div>
                            <div class="absolute left-0 top-1/2 transform -translate-x-1 -translate-y-1/2 w-2 h-2 bg-stone-800 rotate-45"></div>
                        </div>
                    </div>
                    
                    <?php if(auth()->guard()->guest()): ?>
    
                        <button onclick="openLoginModal()" class="text-stone-600 hover:text-stone-800 font-medium transition-colors">
                            Start
                        </button>

                    <a href="<?php echo e(route('register')); ?>" class="mt-3 w-12 h-8 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-xs rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all duration-200 flex items-center justify-center font-medium">
                        Start
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-20 pt-16">
            <?php if(session('success')): ?>
            <div class="mx-6 mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600 mr-2"></i>
                    <span class="text-green-800"><?php echo e(session('success')); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 mr-2"></i>
                    <span class="text-red-800"><?php echo e(session('error')); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Create Post Modal -->
    <?php if(auth()->guard()->check()): ?>
    <div id="createPostModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-stone-200 p-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-stone-800">Share Your Story</h3>
                <button onclick="closeCreatePostModal()" class="p-2 text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="<?php echo e(route('timeline.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6">
                <?php echo csrf_field(); ?>
                
                <!-- User Info -->
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold"><?php echo e(auth()->user()->initials); ?></span>
                    </div>
                    <div>
                        <p class="font-semibold text-stone-800"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-sm text-stone-500">{{ auth()->user()->username }}</p>
                    </div>
                </div>

                <!-- Content -->
                <textarea name="content" required placeholder="What's happening in your story today? Share your cultural insights, daily experiences, or heritage discoveries..." 
                          class="w-full h-32 resize-none border-0 focus:ring-0 text-lg placeholder-stone-400 leading-relaxed mb-4"></textarea>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">Life Chapter</label>
                        <select name="chapter" class="w-full border border-stone-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            <option value="">Select a chapter...</option>
                            <option value="Cultural Tech Innovation">Cultural Tech Innovation</option>
                            <option value="Software Architecture Mastery">Software Architecture Mastery</option>
                            <option value="University & Cultural Awakening">University & Cultural Awakening</option>
                            <option value="Roots & Foundation">Roots & Foundation</option>
                            <option value="Community Building">Community Building</option>
                            <option value="Heritage Preservation">Heritage Preservation</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">Location (Optional)</label>
                        <div class="relative">
                            <i data-lucide="map-pin" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-stone-400"></i>
                            <input type="text" name="location" placeholder="Where are you?" 
                                   class="w-full pl-10 pr-4 py-2 border border-stone-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">Privacy</label>
                        <div class="flex space-x-3">
                            <label class="flex-1 flex items-center justify-center space-x-2 py-2 px-3 rounded-lg border border-stone-200 cursor-pointer hover:border-stone-300">
                                <input type="radio" name="privacy" value="public" checked class="text-amber-500">
                                <i data-lucide="globe" class="w-4 h-4"></i>
                                <span class="text-sm font-medium">Public Timeline</span>
                            </label>
                            <label class="flex-1 flex items-center justify-center space-x-2 py-2 px-3 rounded-lg border border-stone-200 cursor-pointer hover:border-stone-300">
                                <input type="radio" name="privacy" value="private" class="text-amber-500">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span class="text-sm font-medium">Private Story</span>
                            </label>
                            <label class="flex-1 flex items-center justify-center space-x-2 py-2 px-3 rounded-lg border border-stone-200 cursor-pointer hover:border-stone-300">
                                <input type="radio" name="privacy" value="vault" class="text-amber-500">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                                <span class="text-sm font-medium">Personal Vault</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">Add Image (Optional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full border border-stone-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-stone-200 flex items-center justify-between">
                    <div class="text-sm text-stone-500 flex items-center space-x-4">
                        <span class="flex items-center space-x-1">
                            <i data-lucide="heart" class="w-4 h-4 text-red-500"></i>
                            <span>TAP to appreciate</span>
                        </span>
                        <span class="flex items-center space-x-1">
                            <i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i>
                            <span>CHECK-IN to attend</span>
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="closeCreatePostModal()" class="px-4 py-2 text-stone-600 hover:text-stone-800 font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 py-2 rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all duration-200 font-medium">
                            Share Story
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Login Modal -->
        <?php if(auth()->guard()->guest()): ?>
        <div id="loginModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-xl">
                <div class="flex items-center justify-between border-b border-stone-200 px-6 py-4">
                    <h3 class="text-lg font-bold text-stone-800">Welcome Back</h3>
                    <button onclick="closeLoginModal()" class="p-2 text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="p-6 space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Email -->
                    <div>
                        <input type="email" name="email" placeholder="your@email.com" 
                            required autofocus
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" name="password" placeholder="Your password" 
                            required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full py-3 rounded-lg font-medium text-white bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 transition">
                        Sign In
                    </button>

                    <!-- Footer -->
                    <p class="text-center text-sm text-stone-600 mt-4">
                        Don’t have an account?
                        <a href="<?php echo e(route('register')); ?>" class="text-orange-600 font-medium hover:underline">
                            Join Timeline
                        </a>
                    </p>
                </form>
            </div>
        </div>
        <?php endif; ?>

    <?php endif; ?>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Create Post Modal Functions
        function openCreatePostModal() {
            document.getElementById('createPostModal').classList.remove('hidden');
            document.getElementById('createPostModal').classList.add('flex');
        }
        
        function closeCreatePostModal() {
            document.getElementById('createPostModal').classList.add('hidden');
            document.getElementById('createPostModal').classList.remove('flex');
        }
        
        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCreatePostModal();
            }
        });
        
        // Login Modal Functions
        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.getElementById('loginModal').classList.add('flex');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.getElementById('loginModal').classList.remove('flex');
        }

        // Close login modal on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLoginModal();
            }
        });

        // AJAX Functions for interactions
        function toggleTap(postId) {
            fetch(`/posts/${postId}/tap`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                const button = document.querySelector(`[data-tap-post="${postId}"]`);
                const count = document.querySelector(`[data-tap-count="${postId}"]`);
                
                if (data.tapped) {
                    button.classList.add('bg-red-50', 'text-red-600');
                    button.classList.remove('text-stone-600');
                } else {
                    button.classList.remove('bg-red-50', 'text-red-600');
                    button.classList.add('text-stone-600');
                }
                
                count.textContent = `${data.count} TAPs`;
            });
        }
        
        function toggleCheckin(postId) {
            fetch(`/posts/${postId}/checkin`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                const button = document.querySelector(`[data-checkin-post="${postId}"]`);
                const count = document.querySelector(`[data-checkin-count="${postId}"]`);
                
                if (data.checkedIn) {
                    button.classList.add('bg-green-50', 'text-green-600');
                    button.classList.remove('text-stone-600');
                } else {
                    button.classList.remove('bg-green-50', 'text-green-600');
                    button.classList.add('text-stone-600');
                }
                
                count.textContent = `${data.count} Check-In`;
            });
        }
        
        function toggleCultureLockin(cultureId) {
            fetch(`/cultures/${cultureId}/lockin`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                const button = document.querySelector(`[data-culture-lockin="${cultureId}"]`);
                
                if (data.lockedIn) {
                    button.classList.add('bg-gradient-to-r', 'from-amber-500', 'to-orange-600', 'text-white', 'shadow-sm');
                    button.classList.remove('bg-stone-100', 'text-stone-600');
                    button.innerHTML = '<i data-lucide="lock" class="w-3 h-3"></i><span>Locked-In</span>';
                } else {
                    button.classList.remove('bg-gradient-to-r', 'from-amber-500', 'to-orange-600', 'text-white', 'shadow-sm');
                    button.classList.add('bg-stone-100', 'text-stone-600');
                    button.innerHTML = '<i data-lucide="lock" class="w-3 h-3"></i><span>Lock-In</span>';
                }
                
                lucide.createIcons();
            });
        }
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\project\resources\views/app.blade.php ENDPATH**/ ?>