@props(['route'])

@php
    $classes = Route::is($route) ? 'bg-white bg-opacity-25' : 'hover:bg-white hover:bg-opacity-25';
@endphp

<a
    class="font-medium inline-flex items-center text-sm px-4 py-2 rounded transition ease-in duration-150 {{ $classes }}"
    href="{{ route($route) }}"
>
    {{ $slot }}
</a>
