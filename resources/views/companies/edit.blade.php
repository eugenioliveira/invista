<x-app-layout title="Editando informações de {{ $company->name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando informações de {{ $company->name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:edit-company-form :company="$company" />
    </x-section>

</x-app-layout>