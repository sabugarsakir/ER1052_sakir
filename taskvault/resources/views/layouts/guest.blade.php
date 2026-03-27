<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskVault') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .glass-card {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            }
        </style>
    </head>
    <body class="font-sans text-gray-200 antialiased bg-gray-900 min-h-screen relative overflow-hidden">
        <!-- Background gradients -->
        <div class="absolute top-0 -left-64 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-64 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-64 left-1/2 w-96 h-96 bg-pink-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-4000"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div>
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                        TV
                    </div>
                    <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">TaskVault</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-8 glass-card overflow-hidden sm:rounded-2xl transition-all duration-300 hover:shadow-2xl hover:border-gray-600">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
