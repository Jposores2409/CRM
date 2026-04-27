<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CRM') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans::wght@400;500&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#0a0f1e] min-h-screen flex items-center justify-center overflow-hidden relative" style="font-family: 'DM Sans', sans-serif;">
            <div class="absolute -top-20 -left-16 w-72 h-72 rounded-full bg-cyan-400 opacity-29 blur-[80px] animate-pulse"></div>
            <div class="absolute -bottom-16 -right-10 w-52 h-52 rounded-full bg-blue-500 opacity-20 blur-[80px] animate-pulse [animation-delay:3s]"></div>
            <div class="relative z-10 w-full flex justify-center px-4">
                {{ $slot}}
            </div>
    </body>
</html>
