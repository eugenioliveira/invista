<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ $title }} - Invista</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">

    <style type="text/css" media="print">
        div.page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>

</head>
<body class="font-sans antialiased">
<div>
    {{ $slot }}
</div>

</body>
</html>
