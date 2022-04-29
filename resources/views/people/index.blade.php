@php
    /** @var \App\Models\Person $person */
@endphp

<x-app-layout title="Pessoas físicas cadastradas">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Pessoas físicas cadastradas</x-header-text>
            <div>
                <x-button-link href="{{ route('person.create') }}">Criar nova</x-button-link>
            </div>
        </div>
    </x-slot>

    <x-section class="max-w-6xl">
        <livewire:people-list />
    </x-section>

</x-app-layout>