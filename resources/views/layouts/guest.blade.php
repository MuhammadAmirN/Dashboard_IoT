<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>WebIoT - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-[#F4F5F7] dark:bg-[#0F1113] text-gray-900 dark:text-gray-100 transition-colors duration-300">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" class="flex items-center gap-3 text-gray-900 dark:text-white font-bold text-3xl mb-8">
                    <div class="w-10 h-10 bg-[#D2FF3A] rounded-xl flex items-center justify-center text-black shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    WebIoT
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] shadow-xl overflow-hidden rounded-2xl transition-colors duration-300">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
