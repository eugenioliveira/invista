@props([
    'arrow' => true,
    'alignment' => 'left'
])

@php
    $alignmentClasses = [
        'left' => 'left-0',
        'right'=> 'right-0'
    ];
@endphp

<div x-data="{open: false}" @click.away="open = false" class="relative">
    <div @click.prevent="open = !open" class="flex items-center cursor-pointer">
        {{ $trigger }}
        @if($arrow)
            <div class="w-4 h-4 ml-1 opacity-75">
                <svg x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </div>
        @endif
    </div>

    <div
        class="absolute {{ $alignmentClasses[$alignment] }} z-20 bg-white rounded shadow-md mt-1 py-2 w-40"
        x-show="open"
        x-transition:enter="transition transform ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition transform ease-in duration-75"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
    >
        {{ $slot }}
    </div>
</div>
