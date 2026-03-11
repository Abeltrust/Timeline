@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto bg-white dark:bg-stone-900 border border-stone-100 dark:border-stone-800 shadow-lg rounded-2xl p-6 sm:p-8 mt-10">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 dark:text-stone-100">
      {{ isset($community_id) ? 'Schedule Community Meeting' : 'Create Event' }}
    </h2>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      @if(isset($community_id))
          <input type="hidden" name="community_id" value="{{ $community_id }}">
      @endif

      <!-- Title -->
      <div>
        <label for="title" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Event/Meeting Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}"
          class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
          placeholder="What is this event about?" required>
        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <!-- Description -->
      <div>
        <label for="description" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Description</label>
        <textarea name="description" id="description" rows="4"
          class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
          placeholder="Provide more details..." required>{{ old('description') }}</textarea>
        @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Date -->
          <div>
            <label for="event_date" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Date</label>
            <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}"
              class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
            @error('event_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Time -->
          <div>
            <label for="event_time" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Time</label>
            <input type="time" name="event_time" id="event_time" value="{{ old('event_time') }}"
              class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
            @error('event_time')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
      </div>

      <!-- Type -->
      <div>
        <label for="type" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Event Type</label>
        <select name="type" id="type" class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
            <option value="workshop">Workshop</option>
            <option value="conference">Conference</option>
            <option value="cultural" selected>Cultural Gathering</option>
            <option value="exhibition">Exhibition</option>
        </select>
        @error('type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <!-- Online / Location format -->
      <div class="space-y-4 border border-stone-200 dark:border-stone-800 rounded-xl p-5 bg-stone-50 dark:bg-stone-800/30">
        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_online" value="0">
                <input type="checkbox" name="is_online" value="1" id="is_online" class="w-5 h-5 rounded border-stone-300 text-amber-500 focus:ring-amber-500" {{ old('is_online') ? 'checked' : '' }} onchange="toggleOnlineFields()">
                <span class="text-stone-800 dark:text-stone-200 font-medium">This is an online event/meeting</span>
            </label>
        </div>

        <div id="location-field">
            <label for="location" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Physical Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', 'Online') }}"
            class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
            placeholder="e.g. City Hall, Local Community Center" required>
        </div>

        <div id="meeting-link-field" class="hidden">
            <label for="meeting_link" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Meeting Link</label>
            <input type="url" name="meeting_link" id="meeting_link" value="{{ old('meeting_link') }}"
            class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none"
            placeholder="https://zoom.us/j/123456789">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Max Attendees -->
          <div>
            <label for="max_attendees" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Capacity (Optional)</label>
            <input type="number" name="max_attendees" id="max_attendees" value="{{ old('max_attendees') }}" min="1"
              class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="Leave empty for unlimited">
            @error('max_attendees')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Price ($) (Optional)</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" value="0"
              class="w-full border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="0.00 (Free)">
            @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
      </div>

      <!-- Upload Image -->
      <div>
        <label for="image" class="block text-gray-700 dark:text-stone-300 font-semibold mb-2">Event Cover Image</label>
        <div id="image-upload-box"
          class="w-full py-10 border-2 border-dashed border-stone-300 dark:border-stone-700 bg-stone-50 dark:bg-stone-800/50 rounded-xl text-center cursor-pointer hover:border-amber-500 transition relative"
          onclick="document.getElementById('image').click()">
          <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(event)">

          <div id="preview" class="hidden">
            <img id="preview-img" class="mx-auto max-h-40 rounded-lg shadow object-cover" />
            <p class="text-gray-500 text-sm mt-2">Click to change cover</p>
          </div>

          <div id="upload-text" class="text-gray-500">
            <i data-lucide="image" class="w-12 h-12 mx-auto mb-3 text-stone-400"></i>
            <p class="text-base text-stone-600 dark:text-stone-300">Click to upload an image</p>
            <p class="text-xs text-stone-400 mt-1">PNG, JPG up to 10MB</p>
          </div>
        </div>
        @error('image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <script>
        function toggleOnlineFields() {
            const isOnline = document.getElementById('is_online').checked;
            const locField = document.getElementById('location-field');
            const linkField = document.getElementById('meeting-link-field');
            const locInput = document.getElementById('location');

            if (isOnline) {
                locField.classList.add('hidden');
                linkField.classList.remove('hidden');
                locInput.value = 'Online';
            } else {
                locField.classList.remove('hidden');
                linkField.classList.add('hidden');
                if(locInput.value === 'Online') locInput.value = '';
            }
        }
        
        // Initialize state on load
        document.addEventListener('DOMContentLoaded', toggleOnlineFields);

        function previewImage(event) {
          const file = event.target.files[0];
          const previewContainer = document.getElementById('preview');
          const previewImage = document.getElementById('preview-img');
          const uploadText = document.getElementById('upload-text');

          if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              previewImage.src = e.target.result;
              previewContainer.classList.remove('hidden');
              uploadText.classList.add('hidden');
            }
            reader.readAsDataURL(file);
          }
        }
      </script>

      <!-- Submit -->
      <div class="pt-4 border-t border-stone-100 dark:border-stone-800">
        <button type="submit"
          class="w-full bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold text-lg px-6 py-4 rounded-xl shadow-md hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
          {{ isset($community_id) ? 'Schedule Meeting' : 'Create Event' }}
        </button>
      </div>
    </form>
  </div>
  
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
      lucide.createIcons();
  </script>
@endsection
