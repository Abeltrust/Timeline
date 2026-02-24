

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Create Community</h2>

    <form action="<?php echo e(route('communities.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Community Name -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Community Name</label>
            <input type="text" name="name" id="name"
                   class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                   placeholder="Name your community..." required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                      placeholder="What is this community about?" required></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Category -->
     <div class="mb-6">
  <h3 class="mb-4 text-lg font-semibold text-gray-900">Select Category</h3>
  <ul class="grid w-full gap-4 md:grid-cols-2">
    
    <!-- Heritage -->
    <li>
      <input type="radio" id="heritage" name="category" value="heritage" class="hidden peer" required>
      <label for="heritage" 
        class="inline-flex items-center justify-between w-full p-4 text-gray-600 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-amber-500 peer-checked:text-amber-600 peer-checked:bg-amber-50">
        <div class="block">
          <div class="w-full text-md font-semibold">Heritage</div>
          <div class="w-full text-sm">Preserve cultural heritage</div>
        </div>
       <i data-lucide="landmark" class="w-5 h-5 text-amber-500 peer-checked:text-amber-500"></i>
      </label>
    </li>

    <!-- Technology -->
    <li>
      <input type="radio" id="technology" name="category" value="technology" class="hidden peer">
      <label for="technology" 
        class="inline-flex items-center justify-between w-full p-4 text-gray-600 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-amber-500 peer-checked:text-amber-600 peer-checked:bg-amber-50">
        <div class="block">
          <div class="w-full text-md font-semibold">Technology</div>
          <div class="w-full text-sm">Digital tools for culture</div>
        </div>
          <i data-lucide="cpu" class="w-5 h-5 text-amber-500 peer-checked:text-amber-500"></i>
      </label>
    </li>

    <!-- Crafts -->
    <li>
      <input type="radio" id="crafts" name="category" value="crafts" class="hidden peer">
      <label for="crafts" 
        class="inline-flex items-center justify-between w-full p-4 text-gray-600 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-amber-500 peer-checked:text-amber-600 peer-checked:bg-amber-50">
        <div class="block">
          <div class="w-full text-md font-semibold">Crafts</div>
          <div class="w-full text-sm">Traditional arts & skills</div>
        </div>
           <i data-lucide="scissors" class="w-5 h-5 text-amber-500 peer-checked:text-amber-500"></i>
      </label>
    </li>

    <!-- Rituals -->
    <li>
      <input type="radio" id="rituals" name="category" value="rituals" class="hidden peer">
      <label for="rituals" 
        class="inline-flex items-center justify-between w-full p-4 text-gray-600 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-amber-500 peer-checked:text-amber-600 peer-checked:bg-amber-50">
        <div class="block">
          <div class="w-full text-md font-semibold">Rituals</div>
          <div class="w-full text-sm">Ceremonies & traditions</div>
        </div>
        <i data-lucide="flame" class="w-5 h-5 text-amber-500 peer-checked:text-amber-500"></i>
      </label>
    </li>

  </ul>
</div>





        <!-- Community Rules -->
        <div class="mb-6">
            <label for="rules" class="block text-gray-700 font-semibold mb-2">Community Rules</label>
            <textarea name="rules" id="rules" rows="4"
                      class="w-full border border-stone-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                      placeholder="Set guidelines for your community..." required></textarea>
            <?php $__errorArgs = ['rules'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Upload Image -->
        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Community Image</label>

            <!-- Custom file input -->
            <div 
                id="image-upload-box"
                class="w-full border-2 border-dashed border-stone-300 rounded-xl px-6 py-8 text-center cursor-pointer hover:border-amber-500 transition relative"
                onclick="document.getElementById('image').click()"
            >
                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(event)">
                
                <!-- Preview -->
                <div id="preview" class="hidden">
                    <img id="preview-img" class="mx-auto max-h-40 rounded-lg shadow" />
                    <p class="text-gray-500 text-sm mt-2">Click to change image</p>
                </div>

                <!-- Default state -->
                <div id="upload-text" class="text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 010 10h-1M12 12v9m0 0l-3-3m3 3l3-3" />
                    </svg>
                    <p class="text-base">Click to upload an image</p>
                    <p class="text-xs text-gray-400">PNG, JPG up to 2MB</p>
                </div>
            </div>

            <!-- Error -->
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview');
            const previewImage = document.getElementById('preview-img');
            const uploadText = document.getElementById('upload-text');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadText.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
        </script>


        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class=" w-full bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 py-3 rounded-xl shadow hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                Create Community
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Timeline\resources\views/communities/create.blade.php ENDPATH**/ ?>