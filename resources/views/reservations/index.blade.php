<x-app-layout title="Listagem de reservas">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Listagem de reservas</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:reservations-list></livewire:reservations-list>
    </x-section>

</x-app-layout>