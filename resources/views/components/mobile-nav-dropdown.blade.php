@props(['title', 'route'])

@php
    $classes = Request::is($route . '*') ? 'bg-white bg-opacity-25' : ''
@endphp

<div x-data="{ open: false }">
    <button x-on:click="open = !open" class="w-full flex space-x-1 items-center focus:outline-none font-medium text-sm rounded-md px-4 py-2 {{ $classes }}">
        <span>{{ $title }}</span>
        <div class="w-4 h-4 ml-1 opacity-75 transform transition duration-150" :class="{ 'rotate-180' : open }">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </button>

    <div
            x-show="open"
            x-transition:enter="transition transform origin-top duration-300"
            x-transition:enter-start="scale-y-0"
            x-transition:enter-end="scale-y-100"
            x-transition:leave="transition transform origin-top duration-200"
            x-transition:leave-start="scale-y-100"
            x-transition:leave-end="scale-y-0"
            class="bg-white bg-opacity-10 rounded-md ml-4 px-4 py-2 my-2 flex flex-col space-y-2"
    >
        {{ $slot }}
    </div>
</div>
