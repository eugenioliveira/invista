<x-app-layout title="Criando uma nova pessoa física">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criando uma nova pessoa física</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:create-person-form key="person-component" />
    </x-section>

</x-app-layout>