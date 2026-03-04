{{-- resources/views/components/analytics/card.blade.php --}}

<div
    class="bg-white dark:bg-stone-900 rounded-2xl shadow-md p-5 flex flex-col gap-4 border border-gray-200 dark:border-stone-800">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-amber-100 dark:bg-amber-900/20 p-2 rounded-xl">
                <i data-lucide="{{ $icon ?? 'bar-chart-2' }}" class="w-6 h-6 text-amber-600 dark:text-amber-500"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-stone-100">{{ $title ?? 'Card Title' }}</h2>
        </div>

        {{-- Optional Action Icon (search, settings, etc.) --}}
        @if (!empty($actionIcon))
            <button class="text-gray-500 hover:text-gray-700">
                <i data-lucide="{{ $actionIcon }}" class="w-5 h-5"></i>
            </button>
        @endif
    </div>

    {{-- Content --}}
    <div>
        <p class="text-3xl font-bold text-gray-900 dark:text-stone-100">{{ $value ?? '0' }}</p>
        <p class="text-sm text-gray-500 dark:text-stone-400">{{ $subtitle ?? 'Description' }}</p>
    </div>

    {{-- Footer (growth, status, etc.) --}}
    @if (!empty($footer))
        <div class="flex items-center gap-2 text-sm">
            <i data-lucide="{{ $footerIcon ?? 'trending-up' }}" class="w-4 h-4 text-green-600"></i>
            <span class="text-green-600 font-medium">{{ $footer }}</span>
        </div>
    @endif

</div>