<x-app-layout title="Editando endereço de {{ $person->full_name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando endereço de {{ $person->full_name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:address-form :adressable="$person" />
    </x-section>

</x-app-layout>