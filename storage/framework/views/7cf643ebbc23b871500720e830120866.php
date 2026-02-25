
   
    
    <div>
        <label for="connection" class="block text-sm font-medium text-gray-600 mb-2">
            How are you connected to this culture?
        </label>
        <textarea id="connection" name="connection" rows="3"
            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-amber-500 focus:outline-none text-gray-700 text-sm"
            placeholder="Family heritage, research, community involvement..."></textarea>
    </div>

    
    <div>
        <label for="contributors" class="block text-sm font-medium text-gray-600 mb-2">
            Contributors & Collaborators
        </label>
        <div id="contributors-container" class="space-y-2">
            <input type="text" name="contributors[]" placeholder="Add collaborator names..."
                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-amber-500 focus:outline-none text-gray-700 text-sm">
        </div>
        <button type="button" id="add-contributor"
            class="mt-2 inline-flex items-center gap-2 text-amber-600 text-sm hover:text-amber-700 transition">
            <i class="fa fa-plus"></i> Add another collaborator
        </button>
    </div>

    
    <div>
        <label for="tags" class="block text-sm font-medium text-gray-600 mb-2">
            Tags
        </label>
        <div id="tags-container" class="space-y-2">
            <input type="text" name="tags[]" placeholder="Add tags (heritage, traditional, endangered...)"
                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-500 focus:outline-none text-gray-700 text-sm">
        </div>
        <button type="button" id="add-tag"
            class="mt-2 inline-flex items-center gap-2 text-green-600 text-sm hover:text-green-700 transition">
            <i class="fa fa-plus"></i> Add another tag
        </button>
    </div>

    
    <div>
        <label for="vision" class="block text-sm font-medium text-gray-600 mb-2">
            Future Vision
        </label>
        <textarea id="vision" name="vision" rows="3"
            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-amber-500 focus:outline-none text-gray-700 text-sm"
            placeholder="How do you see this culture evolving or being preserved in the future?"></textarea>
    </div>



<script>
    // Collaborators
    const addContributorBtn = document.getElementById('add-contributor');
    const contributorsContainer = document.getElementById('contributors-container');
    let contributorCount = 1;
    addContributorBtn.addEventListener('click', () => {
        if (contributorCount >= 3) {
            alert('You can add a maximum of 3 collaborators.');
            return;
        }
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'contributors[]';
        input.placeholder = 'Add collaborator names...';
        input.classList.add('w-full', 'border', 'border-gray-300', 'rounded-xl', 'p-3', 'focus:ring-2', 'focus:ring-amber-500', 'focus:outline-none', 'text-gray-700', 'text-sm');
        contributorsContainer.appendChild(input);
        contributorCount++;
    });

    // Tags
    const addTagBtn = document.getElementById('add-tag');
    const tagsContainer = document.getElementById('tags-container');
    let tagCount = 1;
    addTagBtn.addEventListener('click', () => {
        if (tagCount >= 5) {
            alert('You can add a maximum of 5 tags.');
            return;
        }
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'tags[]';
        input.placeholder = 'Add tags (heritage, traditional, endangered...)';
        input.classList.add('w-full', 'border', 'border-gray-300', 'rounded-xl', 'p-3', 'focus:ring-2', 'focus:ring-green-500', 'focus:outline-none', 'text-gray-700', 'text-sm');
        tagsContainer.appendChild(input);
        tagCount++;
    });
</script>
<?php /**PATH C:\Timeline\resources\views/cultural-hub/steps/personal.blade.php ENDPATH**/ ?>