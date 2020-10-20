<x-app-layout>

    <x-slot name="title">Editando loteamento</x-slot>
    <x-slot name="header">Atualizando informações de {{ $allotment->title }}</x-slot>

    <x-section>
        <livewire:allotment-form :allotment="$allotment" />
    </x-section>

</x-app-layout>
