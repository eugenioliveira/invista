<x-app-layout title="Criando uma nova pessoa jurídica">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criando uma nova pessoa jurídica</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:create-company-form />
    </x-section>

</x-app-layout>