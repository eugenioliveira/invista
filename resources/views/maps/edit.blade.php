@php
    /** @var \App\Models\Allotment $allotment */
@endphp

<x-app-layout title="Editando mapa do loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Editando mapa do loteamento {{ $allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:edit-map-form :allotment="$allotment"/>
    </x-section>

</x-app-layout>
