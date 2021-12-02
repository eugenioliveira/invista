<x-app-layout title="Dashboard">

    <x-slot name="header">
        <x-header-text>Seja bem-vindo, {{ Auth::user()->name }}</x-header-text>
    </x-slot>

    <x-section>
        <div>
            @if(Auth::user()->isAdmin())
                {{-- Dashboard Cards --}}
                @include('home.partials.cards')

                {{-- Sale Graph --}}
                <livewire:sales-chart-component />
            @else
                @include('home.partials.basic-cards')
            @endif
        </div>

    </x-section>

</x-app-layout>
