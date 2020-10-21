<x-app-layout title="Editando loteamento {{ $allotment->title }}">

    <x-slot name="header">Atualizando informações de {{ $allotment->title }}</x-slot>

    <x-section>
        <livewire:allotment-form :allotment="$allotment" />
    </x-section>

</x-app-layout>
