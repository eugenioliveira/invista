<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Caixeta Vendas</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gray-100">

        <header>
            {{-- Page Navbar --}}
            @include('partials.navbar')

            {{-- Page Heading --}}
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 xl:px-0">
                    {{ $header }}
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="container mx-auto flex-1">
            {{ $slot }}
        </main>

        {{-- Page footer --}}
        @include('partials.footer')
    </div>
    {{-- Apex Charts Library --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        Apex.chart = {
            locales: [{
                "name": "pt-br",
                "options": {
                    "months": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ],
                    "shortMonths": [
                        "Jan",
                        "Fev",
                        "Mar",
                        "Abr",
                        "Mai",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Set",
                        "Out",
                        "Nov",
                        "Dez"
                    ],
                    "days": [
                        "Domingo",
                        "Segunda",
                        "Terça",
                        "Quarta",
                        "Quinta",
                        "Sexta",
                        "Sábado"
                    ],
                    "shortDays": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                    "toolbar": {
                        "exportToSVG": "Baixar SVG",
                        "exportToPNG": "Baixar PNG",
                        "exportToCSV": "Baixar CSV",
                        "menu": "Menu",
                        "selection": "Selecionar",
                        "selectionZoom": "Selecionar Zoom",
                        "zoomIn": "Aumentar",
                        "zoomOut": "Diminuir",
                        "pan": "Navegação",
                        "reset": "Reiniciar Zoom"
                    }
                }
            }],
            defaultLocale: "pt-br"
        }
    </script>
    {{-- Modals --}}
    @stack('modals')
    {{-- Livewire --}}
    @livewireScripts
    {{-- Page scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Stacked scripts --}}
    @stack('scripts')
</body>
</html>
