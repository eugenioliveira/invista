<x-app-layout title="Gerenciando os sócios da empresa {{ $company->name }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Gerenciando os sócios da empresa {{ $company->name }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:company-shareholders-form :company="$company" />
    </x-section>

</x-app-layout>