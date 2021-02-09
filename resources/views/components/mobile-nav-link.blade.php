@props(['route'])

@php
    $classes = Route::is($route) ? 'bg-white bg-opacity-25' : '';
@endphp

<a
    class="font-medium text-sm rounded-md px-4 py-2 {{ $classes }}"
    href="{{ route($route) }}"
>
    {{ $slot }}
</a>
