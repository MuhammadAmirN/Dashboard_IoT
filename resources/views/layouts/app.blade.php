<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web IoT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-blue-50">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white shadow-xl">

            <div class="p-6 text-2xl font-bold border-b border-blue-500">
                WebIoT
            </div>

            <nav class="mt-6">

                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : 'hover:bg-blue-500' }} transition">
                    Dashboard
                </a>

                <a href="{{ route('history') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('history') ? 'bg-blue-700' : 'hover:bg-blue-500' }} transition">
                    Data Sensor
                </a>

                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-500 transition">
                    Grafik
                </a>

                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-500 transition">
                    Tentang Alat
                </a>

            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">

            <!-- Navbar -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">

                <h1 class="text-2xl font-bold text-blue-700">
                    Dashboard IoT
                </h1>

                <div class="text-gray-600">
                    Bandul Matematis
                </div>

            </header>

            <!-- Content -->
            <section class="p-6 overflow-y-auto">

                @yield('content')

            </section>

        </main>

    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>