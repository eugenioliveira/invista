<x-app-layout title="Dashboard">

    <x-slot name="header">Seja bem-vindo, {{ Auth::user()->name }}</x-slot>

    <x-section>
        {{-- Dashboard Cards --}}
        @include('home.partials.cards')

        {{-- Sales Graph --}}
        <livewire:sales-chart-component />

    </x-section>

</x-app-layout>
