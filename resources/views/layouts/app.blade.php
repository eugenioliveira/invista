<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Navbar -->
            <div class="bg-primary shadow text-white">

                <div class="container mx-auto flex items-center justify-between py-4">
                    <!-- Left section of navbar -->
                    <div class="flex items-center">
                        <!-- logo -->
                        <a href="{{ route('home') }}" class="p-2 rounded bg-white flex items-center justify-center">
                            <x-logo width="40"></x-logo>
                            <h2 class="font-medium text-black uppercase">Caixeta <span class="text-primary">Vendas</span></h2>
                        </a>

                        <!-- Nav Links -->
                        <nav class="ml-8 flex space-x-1">
                            <x-nav-link route="home">Home</x-nav-link>

                            <x-dropdown :arrow="false">
                                <x-slot name="trigger">
                                    <x-nav-link route="allotments.index" :dropdown="true">Loteamentos</x-nav-link>
                                </x-slot>


                                <x-dropdown-link href="/">Gerenciar</x-dropdown-link>
                                <x-dropdown-link href="/">Novo</x-dropdown-link>
                            </x-dropdown>

                            <x-nav-link route="brokers.index">Corretores</x-nav-link>
                            <x-nav-link route="clients.index">Clientes</x-nav-link>
                            <x-nav-link route="sales.index">Vendas</x-nav-link>
                        </nav>
                    </div>

                    <!-- User dropdown -->
                    <x-user-dropdown />
                </div>

            </div>

            <!-- Page Heading -->

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
