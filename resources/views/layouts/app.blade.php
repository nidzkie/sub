<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }" @load="$watch('darkMode', (val) => document.documentElement.classList.toggle('dark', val))">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        
        <script>
            // Prevent flash of unstyled content in dark mode
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100">
        <x-banner />

        <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-slate-900 shadow dark:shadow-slate-900/50">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
