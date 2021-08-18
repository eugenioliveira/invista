<x-app-layout title="Reservando o lote {{ $lot->identification }} - Loteamento {{ $lot->allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Reservando o lote {{ $lot->identification }} - Loteamento {{ $lot->allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:reserve-lot-form :lot="$lot" />
    </x-section>

</x-app-layout>