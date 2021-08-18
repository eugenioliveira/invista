@php
    /** @var \App\Models\Allotment $allotment */
@endphp

<x-app-layout title="Lotes - Loteamento {{ $allotment->title }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Lotes - Loteamento {{ $allotment->title }}</x-header-text>
            @if(\Auth::user()->isAdmin())
                <div>
                    <x-button-link href="{{ route('lot.create', $allotment->id) }}">Criar novo</x-button-link>
                    <x-button-link href="{{ route('lots.import', $allotment->id) }}" class="ml-3">Importar
                    </x-button-link>
                </div>
            @endif
        </div>
    </x-slot>

    <x-section>
        <livewire:manage-lots :allotment="$allotment"/>
    </x-section>

</x-app-layout>
