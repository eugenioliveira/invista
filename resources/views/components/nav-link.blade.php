@props(['route', 'dropdown' => false])

@php
    $classes = Route::is($route) ? 'bg-white bg-opacity-25' : 'hover:bg-white hover:bg-opacity-25';
@endphp

<a
    class="font-medium inline-flex items-center text-sm px-6 py-3 rounded transition ease-in duration-150 {{ $classes }}"
    href="{{ route($route) }}"
>
    {{ $slot }}
    @if($dropdown)
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    @endif
</a>
