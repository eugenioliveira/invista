@php
    /** @var \App\Models\Allotment $allotment */
@endphp

<x-app-layout title="Importação de lotes - Loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Importação de lotes - Loteamento {{ $allotment->title }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <livewire:lots-import :allotment="$allotment" />
    </x-section>

</x-app-layout>
