@php
    /** @var \App\Models\Lot $lot */
@endphp

<x-app-layout title="Editando lote {{ $lot->identification }}, loteamento {{ $lot->allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando lote {{ $lot->identification }}, loteamento {{ $lot->allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:edit-lot-form :lot="$lot"/>
    </x-section>

</x-app-layout>
