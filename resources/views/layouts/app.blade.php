<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'CRM') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f0f4f8] min-h-screen" style="font-family: 'DM Sans', sans-serif;">

    {{-- Orbes de fondo --}}
    <div class="fixed -top-20 -right-16 w-72 h-72 rounded-full bg-cyan-300 opacity-10 blur-[80px] pointer-events-none"></div>
    <div class="fixed -bottom-16 -left-10 w-52 h-52 rounded-full bg-blue-400 opacity-10 blur-[80px] pointer-events-none"></div>

    @include('layouts.navigation')

    <main class="relative z-10">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>