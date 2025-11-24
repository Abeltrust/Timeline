

    <div>
        <label for="endangerment_level" class="block text-sm font-medium text-stone-700 mb-1">Endangerment Level</label>
        <select id="endangerment_level" name="endangerment_level"
            class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            <option value="">Select status...</option>
            <option value="critical">Critically Endangered</option>
            <option value="endangered">Endangered</option>
            <option value="vulnerable">Vulnerable</option>
            <option value="stable">Stable</option>
            <option value="reviving">Reviving</option>
        </select>
    </div>

    
    <div>
        <label for="current_practitioners" class="block text-sm font-medium text-stone-700 mb-1">Current Practitioners</label>
        <input id="current_practitioners" name="current_practitioners" type="text"
            placeholder="e.g., 50+ master craftspeople, 3 remaining elders, widespread community practice"
            class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
    </div>

    
    <div>
        <label for="transmission_methods" class="block text-sm font-medium text-stone-700 mb-1">Transmission Methods</label>
        <textarea id="transmission_methods" name="transmission_methods" rows="2"
            placeholder="How is this knowledge passed down? Oral tradition, apprenticeship, family lineage..."
            class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
    </div>

    
    <div>
        <label for="preservation_efforts" class="block text-sm font-medium text-stone-700 mb-1">Preservation Efforts</label>
        <textarea id="preservation_efforts" name="preservation_efforts" rows="2"
            placeholder="What efforts are being made to preserve this culture? Documentation, education, revival programs..."
            class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
    </div>

    
    <div>
        <label for="current_challenges" class="block text-sm font-medium text-stone-700 mb-1">Current Challenges</label>
        <textarea id="current_challenges" name="current_challenges" rows="2"
            placeholder="What threatens this cultural practice? Modernization, lack of interest, resource constraints..."
            class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
    </div>

<?php /**PATH C:\project\resources\views/cultural-hub/steps/status.blade.php ENDPATH**/ ?>