<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full w-screen">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Invista</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>
<body class="m-0 p-0 h-full w-screen">

{{ $slot }}

{{-- Livewire --}}
@livewireScripts
{{-- Page scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
{{-- Stacked Scripts --}}
@stack('scripts')
</body>
</html>
