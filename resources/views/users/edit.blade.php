<x-app-layout title="Editar usuário {{ $user->name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editar usuário {{ $user->name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        {{ $user->name }}
    </x-section>

</x-app-layout>
