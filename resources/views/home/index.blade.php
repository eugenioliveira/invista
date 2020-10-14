<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seja bem-vindo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <x-section>
        {{-- Dashboard Cards --}}
        @include('home.partials.cards')

        {{-- Sales Graph --}}
        <livewire:sales-graph-component />

    </x-section>

</x-app-layout>
