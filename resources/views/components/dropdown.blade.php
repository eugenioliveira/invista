@props(['alignment' => 'left'])

@php
    $alignmentClasses = [
        'left' => 'left-0',
        'right'=> 'right-0'
    ];
@endphp

<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <div @click.prevent="open = !open">
        {{ $trigger }}
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
