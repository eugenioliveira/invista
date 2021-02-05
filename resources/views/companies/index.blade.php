@php
    /** @var \App\Models\Company $company */
@endphp

<x-app-layout title="Pessoas jurídicas cadastradas">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Pessoas jurídicas cadastradas</x-header-text>
            <div>
                <x-button-link href="{{ route('companies.create') }}">Criar nova</x-button-link>
            </div>
        </div>
    </x-slot>

    <x-section>
        <livewire:companies-list />
    </x-section>

</x-app-layout>