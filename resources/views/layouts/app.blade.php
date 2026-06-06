<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebIoT Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme Toggle Script (Runs early to prevent FOUC) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-[#F4F5F7] dark:bg-[#0F1113] font-sans text-gray-900 dark:text-gray-100 antialiased h-screen flex overflow-hidden transition-colors duration-300">

    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-[#1A1C1E] border-r border-gray-200 dark:border-[#2A2D30] text-gray-700 dark:text-gray-300 flex flex-col justify-between p-6 transition-colors duration-300">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-10 text-gray-900 dark:text-white font-bold text-2xl">
                <div class="w-8 h-8 bg-[#D2FF3A] rounded-lg flex items-center justify-center text-black shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                WebIoT
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-white text-black font-semibold rounded-full shadow-sm' : 'hover:bg-gray-50 dark:hover:bg-white/10 dark:hover:text-white rounded-full transition' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </div>
                </a>

                <a href="{{ route('history') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('history') ? 'bg-gray-100 dark:bg-white text-black font-semibold rounded-full shadow-sm' : 'hover:bg-gray-50 dark:hover:bg-white/10 dark:hover:text-white rounded-full transition' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Data Sensor
                    </div>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-[#F4F5F7] dark:bg-[#0F1113] p-8 flex flex-col overflow-y-auto transition-colors duration-300">

        <!-- Top Header -->
        <header class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden border-2 border-white dark:border-[#2A2D30] shadow-sm">
                    <img src="https://i.pravatar.cc/150?u=admin" alt="Admin" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight text-gray-900 dark:text-white">Admin WebIoT</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">admin@webiot.com</p>
                </div>
            </div>

            <!-- Theme Toggle Button -->
            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="w-10 h-10 bg-white dark:bg-[#2A2D30] rounded-full flex items-center justify-center shadow-sm border border-gray-200 dark:border-[#3A3D40] hover:bg-gray-50 dark:hover:bg-[#3A3D40] transition">
                    <!-- Sun Icon (shown in dark mode) -->
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-[#D2FF3A]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    <!-- Moon Icon (shown in light mode) -->
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
            </div>
        </header>

        <!-- Dynamic Content -->
        <div class="flex-1">
            @yield('content')
        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function() {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('theme')) {
            if (localStorage.getItem('theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    });
</script>

</body>
</html>