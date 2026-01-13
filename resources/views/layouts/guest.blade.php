<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
<script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        {{ $slot }}
    </div>

</body>
</html>
