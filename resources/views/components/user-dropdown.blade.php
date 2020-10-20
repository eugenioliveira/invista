@php
/** @var \App\Models\User $currentUser */
@endphp
<x-dropdown>
    <x-slot name="trigger">
        <button class="flex items-center focus:outline-none">
            <img src="{{ Auth::user()->profile_photo_url }}" class="w-10 h-10 rounded-lg border-2 border-gray-600" alt="">
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


    <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
    <x-dropdown-link href="/">Sair</x-dropdown-link>
</x-dropdown>
