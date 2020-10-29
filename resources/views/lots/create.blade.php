@php
    /** @var \App\Models\Allotment $allotment */
@endphp

<x-app-layout title="Criando um novo lote para o Loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Criando um novo lote para o Loteamento {{ $allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:create-lot-form :allotment="$allotment" />
    </x-section>

</x-app-layout>
