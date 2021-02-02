<x-app-layout title="Editando informações de {{ $person->full_name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando informações de {{ $person->full_name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:edit-person-form :person="$person" />
    </x-section>

</x-app-layout>