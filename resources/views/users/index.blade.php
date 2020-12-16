<x-app-layout title="Gerenciamento de usuários">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Gerenciamento de usuários</x-header-text>
            <div>
                <x-button-link href="{{ route('users.create') }}">Criar novo</x-button-link>
            </div>
        </div>
    </x-slot>

    <x-section>
        <livewire:user-list />
    </x-section>

</x-app-layout>
