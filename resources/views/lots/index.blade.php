@php
    /** @var \App\Models\Allotment $allotment */
@endphp

<x-app-layout title="Lotes - Loteamento {{ $allotment->title }}">

    <x-slot name="header">
        Gerenciamento de lotes - Loteamento {{ $allotment->title }}
    </x-slot>

    <x-section>
        <livewire:lot-list :allotmentId="$allotment->id" />
    </x-section>

</x-app-layout>
