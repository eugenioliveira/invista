<x-app-layout title="Criar usuário">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criar novo usuário</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:create-user-form />
    </x-section>

</x-app-layout>
