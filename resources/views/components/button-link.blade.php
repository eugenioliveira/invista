@props(['type' => 'primary', 'format' => 'normal'])

@php
    $colors = ($type == 'primary')
        ? 'bg-primary hover:bg-orange-400 active:bg-orange-600 focus:border-orange-600 focus:shadow-outline-orange'
        : 'bg-red-600 hover:bg-red-500 active:bg-red-600 focus:border-red-700 focus:shadow-outline-red';
    $padding = ($format == 'normal')
        ? 'px-4 py-2'
        : 'p-2';

    $classes = sprintf('%s %s', $colors, $padding);
@endphp

<a {{ $attributes->merge(['class' => "inline-flex items-center border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest {$classes} focus:outline-none disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</a>
