@props(['type' => 'primary', 'format' => 'normal'])

@php
    $colors = '';
    switch ($type) {
        case 'primary':
            $colors = 'bg-primary hover:bg-orange-500 active:bg-orange-600 focus:border-orange-600 focus:ring focus:ring-orange-600';
            break;
        case 'danger':
            $colors = 'bg-red-600 hover:bg-red-500 active:bg-red-600 focus:border-red-700 focus:ring ring-red';
            break;
        case 'success':
            $colors = 'bg-green-600 hover:bg-green-500 active:bg-green-600 focus:border-green-700 focus:ring ring-green';
            break;
        default:
            break;

    }
    $padding = ($format == 'normal')
        ? 'px-4 py-2'
        : 'p-2';

    $classes = sprintf('%s %s', $colors, $padding);
@endphp

<a {{ $attributes->merge(['class' => "inline-flex items-center border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest {$classes} focus:outline-none disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</a>
