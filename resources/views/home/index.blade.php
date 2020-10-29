<x-app-layout title="Dashboard">

    <x-slot name="header">
        <x-header-text>Seja bem-vindo, {{ Auth::user()->name }}</x-header-text>
    </x-slot>

    <x-section>
        {{-- Dashboard Cards --}}
        @include('home.partials.cards')

        {{-- Sales Graph --}}
        <livewire:sales-chart-component />

    </x-section>

</x-app-layout>
