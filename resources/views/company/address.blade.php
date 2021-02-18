<x-app-layout title="Editando endereço de {{ $company->name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando endereço de {{ $company->name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:address-form :adressable="$company" />
    </x-section>

</x-app-layout>