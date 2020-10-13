<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seja bem-vindo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <x-section>
        <!-- Stat Cards -->
        @include('home.partials.cards')

        <!-- Sales Graph -->
        <x-card class="mt-4 p-4">
            Teste
        </x-card>

    </x-section>

</x-app-layout>
