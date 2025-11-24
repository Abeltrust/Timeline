
    <p class="text-sm text-gray-500">Provide key information about this cultural practice before continuing.</p>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
            Cultural Practice Title
        </label>
        <input type="text" id="title" name="title"
            class="w-full border border-gray-300 rounded-xl p-3 shadow-sm text-sm text-gray-700 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none"
            placeholder="e.g. Traditional Dance Festival" required>
    </div>

    <!-- Location -->
    <div>
        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
            Location
        </label>
        <input type="text" id="location" name="location"
            class="w-full border border-gray-300 rounded-xl p-3 shadow-sm text-sm text-gray-700 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
            placeholder="e.g. Lagos, Nigeria" required>
    </div>

    <!-- Category -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
            Category
        </label>
        <select id="category" name="category"
            class="w-full border border-gray-300 rounded-xl p-3 shadow-sm text-sm text-gray-700 bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            <option value="">-- Select Category --</option>
            <option value="festival">Festival</option>
            <option value="music">Music</option>
            <option value="dance">Dance</option>
            <option value="ritual">Ritual</option>
            <option value="craft">Craft</option>
            <option value="language">Language</option>
        </select>
    </div>

<?php /**PATH C:\project\resources\views/cultural-hub/steps/basic-info.blade.php ENDPATH**/ ?>