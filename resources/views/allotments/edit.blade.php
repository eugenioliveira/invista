<x-app-layout title="Editando loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <x-header-text>Atualizando informações de {{ $allotment->title }}</x-header-text>
    </x-slot>

    <x-section>
        <livewire:allotment-form :allotment="$allotment" />
    </x-section>

</x-app-layout>
