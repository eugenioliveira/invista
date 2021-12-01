@php
    /** @var \App\Models\Lot $lot */
    /** @var \App\Models\Proposal $proposal */
@endphp
<x-app-layout title="Editando proposta #{{ $proposal->id }} | {{ $proposal->lot->identification }} - Loteamento {{ $proposal->lot->allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando proposta #{{ $proposal->id }} | {{ $proposal->lot->identification }} - Loteamento {{ $proposal->lot->allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:proposal-wizard :lot="$proposal->lot" :proposal="$proposal" />
    </x-section>

</x-app-layout>