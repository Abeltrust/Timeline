

    {{-- Preview Pane --}}
    <div id="preview-container" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4"></div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Add Photos -->
        <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer hover:border-amber-500 transition">
            <input type="file" id="photos" accept="image/*" multiple hidden onchange="handlePhotoUpload(event)">
            <i class=" text-2xl text-amber-500" data-lucide="camera"></i>
            <span class="text-sm mt-2 text-amber-500">Add Photos</span>
        </label>

        <!-- Add Video -->
        <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer hover:border-amber-500 transition">
            <input type="file" id="video" accept="video/*" hidden onchange="handleSingleFile(event, 'video')">
            <i class=" text-2xl text-amber-500" data-lucide="video"></i>
            <span class="text-sm mt-2 text-amber-500">Add Video</span>
        </label>

        <!-- Add Audio -->
        <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer hover:border-amber-500 transition">
            <input type="file" id="audio" accept="audio/*" hidden onchange="handleSingleFile(event, 'audio')">
            <i class=" text-2xl text-amber-500" data-lucide="mic"></i>
            <span class="text-sm mt-2 text-amber-500">Add Audio</span>
        </label>

        <!-- Add Document -->
        <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer hover:border-amber-500 transition">
            <input type="file" id="document" accept=".pdf,.doc,.docx" hidden onchange="handleSingleFile(event, 'document')">
            <i class=" text-2xl text-amber-500" data-lucide="file"></i>
            <span class="text-sm mt-2 text-amber-500">Add Documents</span>
        </label>
    </div>

{{-- JavaScript --}}
<script>
    let uploadedPhotos = [];
    let uploadedFiles = { video: null, audio: null, document: null };

    function handlePhotoUpload(event) {
        const files = Array.from(event.target.files);
        const previewContainer = document.getElementById('preview-container');

        if (uploadedPhotos.length + files.length > 5) {
            alert("You can upload a maximum of 5 photos.");
            return;
        }

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const imgDiv = document.createElement('div');
                imgDiv.classList.add('relative', 'group');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded-xl', 'w-full', 'h-32', 'object-cover', 'shadow');

                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'p-1', 'hidden', 'group-hover:block');
                removeBtn.onclick = () => {
                    previewContainer.removeChild(imgDiv);
                    uploadedPhotos = uploadedPhotos.filter(f => f !== file);
                };

                imgDiv.appendChild(img);
                imgDiv.appendChild(removeBtn);
                previewContainer.appendChild(imgDiv);

                uploadedPhotos.push(file);
            };
            reader.readAsDataURL(file);
        });
    }

    function handleSingleFile(event, type) {
        const file = event.target.files[0];
        if (!file) return;

        // Prevent multiple uploads for same type
        if (uploadedFiles[type]) {
            alert(`You can upload only one ${type}.`);
            event.target.value = ""; // reset input
            return;
        }

        const previewContainer = document.getElementById('preview-container');
        const fileDiv = document.createElement('div');
        fileDiv.classList.add('relative', 'group', 'border', 'rounded-xl', 'p-3', 'flex', 'items-center', 'justify-between', 'shadow', 'bg-gray-50');

        const icon = document.createElement('i');
        icon.classList.add('fa', type === 'video' ? 'fa-video' : type === 'audio' ? 'fa-microphone' : 'fa-file', 'text-gray-600', 'text-xl');

        const name = document.createElement('span');
        name.textContent = file.name;
        name.classList.add('ml-2', 'text-sm', 'truncate', 'text-gray-700');

        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = '&times;';
        removeBtn.classList.add('bg-red-500', 'text-white', 'rounded-full', 'p-1', 'hidden', 'group-hover:block');
        removeBtn.onclick = () => {
            previewContainer.removeChild(fileDiv);
            uploadedFiles[type] = null;
            document.getElementById(type).value = "";
        };

        fileDiv.appendChild(icon);
        fileDiv.appendChild(name);
        fileDiv.appendChild(removeBtn);
        previewContainer.appendChild(fileDiv);

        uploadedFiles[type] = file;
    }
</script>
