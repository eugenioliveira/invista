<x-dropdown>
    <x-slot name="trigger">
        <button class="focus:outline-none">
            <img src="{{ Auth::user()->profile_photo_url }}" class="w-10 h-10 rounded-lg" alt="">
        </button>
    </x-slot>


    <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
    <x-dropdown-link href="/">Sair</x-dropdown-link>
</x-dropdown>
