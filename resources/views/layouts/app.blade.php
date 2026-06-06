<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebIoT Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#1A1C1E] font-sans text-gray-900 antialiased h-screen flex overflow-hidden">

    <!-- Sidebar (Dark) -->
    <aside class="w-64 bg-[#1A1C1E] text-gray-300 flex flex-col justify-between p-6">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-10 text-white font-bold text-2xl">
                <div class="w-8 h-8 bg-[#D2FF3A] rounded-lg flex items-center justify-center text-black">
                    <!-- Icon placeholder -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                WebIoT
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white text-black font-semibold rounded-full shadow-sm' : 'hover:text-white transition' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </div>
                </a>

                <a href="{{ route('history') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('history') ? 'bg-white text-black font-semibold rounded-full shadow-sm' : 'hover:text-white transition' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Data Sensor
                    </div>
                </a>
            </nav>
        </div>


    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-[#F4F5F7] rounded-l-[2.5rem] p-8 flex flex-col overflow-y-auto">

        <!-- Top Header -->
        <header class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                    <img src="https://i.pravatar.cc/150?u=admin" alt="Admin" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">Admin WebIoT</h2>
                    <p class="text-sm text-gray-500">admin@webiot.com</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 bg-white rounded-full text-sm shadow-sm border-none focus:ring-2 focus:ring-[#D2FF3A] outline-none">
                    <svg class="w-4 h-4 absolute left-4 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm relative hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-[#D2FF3A] border-2 border-white rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- Dynamic Content -->
        <div class="flex-1">
            @yield('content')
        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>