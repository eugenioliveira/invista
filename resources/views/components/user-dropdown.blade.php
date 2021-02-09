@php
    /** @var \App\Models\User $currentUser */
@endphp
<x-dropdown alignment="right">
    <x-slot name="trigger">
        <button class="flex items-center focus:outline-none">
            <img src="{{ Auth::user()->profile_photo_url }}" class="w-10 h-10 rounded-lg border-2 border-gray-600" alt="">
            <div class="w-4 h-4 ml-1 opacity-75 transform transition duration-150" :class="{ 'rotate-180' : open }">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </button>
    </x-slot>


    <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-black w-full text-left px-4 py-1 hover:bg-yellow-200 text-sm transition ease-in duration-150" type="submit">Sair</button>
    </form>
</x-dropdown>
