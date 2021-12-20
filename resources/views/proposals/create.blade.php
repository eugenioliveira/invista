@php
    /** @var \App\Models\Lot $lot */
@endphp
<x-app-layout title="Fazendo uma nova proposta para o lote {{ $lot->identification }} - Loteamento {{ $lot->allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Fazendo uma nova proposta para o lote {{ $lot->identification }} - Loteamento {{ $lot->allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:proposal.wizard :lot="$lot" />
    </x-section>

</x-app-layout>