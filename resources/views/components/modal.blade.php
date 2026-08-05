@props(['name', 'title' => '', 'maxWidth' => '2xl'])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    x-data="{ show: false }"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 flex items-center justify-center"
>
    <!-- Backdrop Blur -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="show = false"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
    ></div>

    <!-- Modal Dialog Container -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative bg-white rounded-3xl shadow-2xl transform transition-all w-full {{ $maxWidthClass }} z-10 border border-gray-100 max-h-[90vh] flex flex-col my-auto overflow-hidden"
    >
        @if($title)
            <!-- Modal Header -->
            <div class="px-6 py-4 sm:px-8 sm:py-5 bg-gradient-to-r from-[#340C6F] to-[#1A0638] text-white flex items-center justify-between shrink-0">
                <h3 class="font-extrabold text-base sm:text-lg tracking-wide flex items-center gap-2">
                    {{ $title }}
                </h3>
                <button @click="show = false" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        @endif

        <div class="p-5 sm:p-6 overflow-y-auto max-h-[calc(90vh-70px)]">
            {{ $slot }}
        </div>
    </div>
</div>
