@props(['title', 'route'])

@php
    $classes = Request::is($route . '*') ? 'bg-white bg-opacity-25' : 'hover:bg-white hover:bg-opacity-25'
@endphp

<x-dropdown :arrow="false">
    <x-slot name="trigger">
        <button
            class="flex items-center font-medium text-sm px-6 py-3 rounded transition ease-in duration-150 focus:outline-none focus:bg-white focus:bg-opacity-25 {{ $classes }}">
            <span>{{ $title }}</span>
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
        </button>
    </x-slot>

    {{ $slot }}
</x-dropdown>
