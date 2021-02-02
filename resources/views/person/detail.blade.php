<x-app-layout title="Editando detalhes de {{ $person->full_name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando detalhes de {{ $person->full_name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:person-detail-form :person="$person" />
    </x-section>

</x-app-layout>