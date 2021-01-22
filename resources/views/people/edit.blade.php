<x-app-layout title="Editando pessoa">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criando uma nova pessoa física</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:edit-person-form :person="$person" />
    </x-section>

</x-app-layout>