@extends('layouts.app')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-6">
    <div>
        <h1 class="text-4xl font-bold mb-2 text-gray-900 dark:text-white">WebIoT Dashboard</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">Pantau alat bandul matematis secara realtime!</p>
    </div>
    <div class="flex items-center gap-2 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] px-4 py-2 rounded-full shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 transition-colors duration-300">
        <span>{{ now()->format('d M, Y') }}</span>
        <span class="text-gray-300 dark:text-gray-600">|</span>
        <span>Hari Ini &or;</span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Card 1: Jumlah Ayunan (Besar Kiri) -->
    <div class="lg:col-span-1 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[320px] transition-colors duration-300">
        <div>
            <div class="flex justify-between items-start mb-2">
                <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Jumlah Ayunan
                </div>
                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                </button>
            </div>
            <div class="flex items-baseline gap-2 mt-2">
                <h3 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $latest->jumlah_ayunan ?? 0 }}</h3>
                <span class="text-sm font-bold bg-[#D2FF3A] text-black px-2 py-0.5 rounded-md shadow-sm">+1</span>
            </div>
        </div>

        <!-- Decorative Circles matching mockup -->
        <div class="relative h-44 mt-4">
            <div class="absolute left-0 top-0 w-[120px] h-[120px] bg-[#B4AEFF] rounded-full flex flex-col items-center justify-center shadow-sm z-10 text-black">
                <span class="text-3xl font-bold">{{ $latest->jumlah_ayunan ?? 0 }}</span>
                <span class="text-xs">ayunan</span>
            </div>
            <div class="absolute left-[90px] top-[10px] w-[100px] h-[100px] bg-gray-900 dark:bg-[#0F1113] rounded-full flex flex-col items-center justify-center shadow-lg z-20 text-white">
                <span class="text-2xl font-bold">{{ number_format($latest->periode ?? 0, 1) }}<span class="text-sm">s</span></span>
                <span class="text-xs text-gray-300">periode</span>
            </div>
            <div class="absolute left-[65px] top-[90px] w-[80px] h-[80px] bg-[#D2FF3A] rounded-full flex flex-col items-center justify-center shadow-md z-30 text-black border border-[#BFFF00]">
                <span class="text-sm font-bold">{{ $latest->string_length ?? 'Tali' }}</span>
            </div>
        </div>

        <!-- Progress Bars bottom -->
        <div class="space-y-4 mt-6">
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800 dark:text-gray-200">
                    <span>45%</span>
                    <span class="text-gray-500 dark:text-gray-400 text-xs font-medium flex items-center gap-1">Ayunan <div class="w-2 h-2 rounded-full bg-[#B4AEFF]"></div></span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                    <div class="bg-[#B4AEFF] h-2 rounded-full" style="width: 45%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800 dark:text-gray-200">
                    <span>30%</span>
                    <span class="text-gray-500 dark:text-gray-400 text-xs font-medium flex items-center gap-1">Standby <div class="w-2 h-2 rounded-full bg-gray-900 dark:bg-white"></div></span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                    <div class="bg-gray-900 dark:bg-white h-2 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800 dark:text-gray-200">
                    <span>25%</span>
                    <span class="text-gray-500 dark:text-gray-400 text-xs font-medium flex items-center gap-1">Delay <div class="w-2 h-2 rounded-full bg-[#D2FF3A]"></div></span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                    <div class="bg-[#D2FF3A] h-2 rounded-full" style="width: 25%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side Grid (2 cols inside) -->
    <div class="lg:col-span-2 flex flex-col gap-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card 2: Periode (Kanan Atas 1) -->
            <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-sm flex flex-col justify-between h-44 transition-colors duration-300">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Periode
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="flex items-end justify-between mt-auto">
                    <div>
                        <span class="text-5xl font-bold text-gray-900 dark:text-white">{{ number_format($latest->periode ?? 0, 1) }}</span>
                        <span class="text-gray-500 dark:text-gray-400 font-medium ml-1">detik</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium">Avg</p>
                        <p class="font-bold text-gray-800 dark:text-gray-300 text-sm">1.5 s</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Status Sensor (Kanan Atas 2) -->
            <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-sm flex flex-col justify-between h-44 transition-colors duration-300">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Status
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="flex items-end justify-between mt-auto">
                    <div>
                        <span class="text-4xl font-bold {{ $status == 'Online' ? 'text-gray-900 dark:text-white' : 'text-red-500' }}">{{ $status }}</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-1">Koneksi</p>
                        <div class="w-16 h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full ml-auto">
                            <div class="h-1.5 rounded-full {{ $status == 'Online' ? 'bg-[#D2FF3A]' : 'bg-red-500' }} w-full shadow-sm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Wellness Index Mockup / Panjang Tali -->
        <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-sm flex-1 flex flex-col justify-between min-h-[180px] transition-colors duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Pemilihan Tali
                </div>
                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                </button>
            </div>
            
            <div class="flex items-center gap-4">
                <h3 class="text-4xl font-bold text-gray-900 dark:text-white">Tali A</h3>
                <span class="text-sm font-bold bg-[#D2FF3A] text-black px-2 py-0.5 rounded-md shadow-sm">Aktif</span>
            </div>
            
            <div class="mt-4 flex gap-2">
                <div class="flex-1 h-12 bg-gray-50 dark:bg-white/5 rounded-xl border-2 border-[#D2FF3A] flex items-center justify-center font-bold text-gray-900 dark:text-white cursor-pointer transition">Tali A</div>
                <div class="flex-1 h-12 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-semibold cursor-pointer hover:bg-gray-100 dark:hover:bg-white/10 transition">Tali B</div>
                <div class="flex-1 h-12 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-semibold cursor-pointer hover:bg-gray-100 dark:hover:bg-white/10 transition">Tali C</div>
            </div>
        </div>

    </div>

    <!-- Card 5: Dark Chart Card (Full width bottom) -->
    <div class="lg:col-span-3 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-lg mt-2 text-gray-900 dark:text-white relative overflow-hidden min-h-[300px] flex flex-col transition-colors duration-300">
        <div class="flex justify-between items-center mb-6 z-10 relative">
            <div class="flex items-center gap-2 font-semibold">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                Visualisasi Pergerakan Bandul (Simpangan)
            </div>
            <div class="px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-sm transition-colors duration-300 {{ $status == 'Online' ? 'bg-[#D2FF3A]/20 border border-[#D2FF3A]/30 text-green-800 dark:text-[#D2FF3A]' : 'bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 text-red-600 dark:text-red-400' }}">
                @if($status == 'Online')
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Live Data
                @else
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Data Terakhir (Offline)
                @endif
            </div>
        </div>
        
        <div class="flex gap-10 mb-6 z-10 relative">
            <div>
                <span class="text-4xl font-bold text-[#b4dc1f] dark:text-[#D2FF3A] border-l-4 border-[#b4dc1f] dark:border-[#D2FF3A] pl-3">{{ number_format($latest->periode ?? 0, 2) }}<span class="text-2xl">s</span></span>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 pl-4">Periode Terakhir</p>
            </div>
            <div>
                <span class="text-4xl font-bold text-[#8C84FF] dark:text-[#B4AEFF] border-l-4 border-[#8C84FF] dark:border-[#B4AEFF] pl-3">{{ $latest->jumlah_ayunan ?? 0 }}</span>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 pl-4">Total Ayunan</p>
            </div>
        </div>

        <div class="flex-1 w-full z-10 relative h-40">
            <canvas id="sensorChart"></canvas>
        </div>
        
        <!-- Decorative grid pattern background -->
        <div class="absolute bottom-0 left-0 w-full h-32 opacity-10 dark:opacity-5" style="background-image: repeating-linear-gradient(45deg, #888 25%, transparent 25%, transparent 75%, #888 75%, #888), repeating-linear-gradient(45deg, #888 25%, transparent 25%, transparent 75%, #888 75%, #888); background-position: 0 0, 10px 10px; background-size: 20px 20px;"></div>
    </div>

    <!-- Perbandingan Antar Tali -->
    <div class="lg:col-span-3 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] rounded-[2rem] shadow-lg p-6 mb-2 transition-colors duration-300">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-[#B4AEFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Perbandingan Antar Tali
            </h2>
            <a href="{{ route('history') }}" class="text-sm font-bold text-[#8C84FF] hover:text-[#B4AEFF] transition">
                Lihat Semua Riwayat &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800 text-gray-500 dark:text-gray-400 text-sm">
                        <th class="py-4 px-4 font-semibold">Panjang Tali</th>
                        <th class="py-4 px-4 text-center font-semibold">Waktu (10 Ayunan)</th>
                        <th class="py-4 px-4 text-center font-semibold">Waktu Rata-rata</th>
                        <th class="py-4 px-4 text-center font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-300">
                    <tr class="border-b border-gray-50 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-white/5 transition">
                        <td class="py-4 px-4 font-bold">Tali A (20cm)</td>
                        <td class="py-4 px-4 text-center">9.12 detik</td>
                        <td class="py-4 px-4 text-center text-[#8C84FF] font-bold">0.91 s</td>
                        <td class="py-4 px-4 text-center">
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 rounded-full text-xs font-bold">Stabil</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-white/5 transition">
                        <td class="py-4 px-4 font-bold">Tali B (30cm)</td>
                        <td class="py-4 px-4 text-center">11.05 detik</td>
                        <td class="py-4 px-4 text-center text-[#8C84FF] font-bold">1.10 s</td>
                        <td class="py-4 px-4 text-center">
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 rounded-full text-xs font-bold">Stabil</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition">
                        <td class="py-4 px-4 font-bold">Tali C (40cm)</td>
                        <td class="py-4 px-4 text-center">12.80 detik</td>
                        <td class="py-4 px-4 text-center text-[#8C84FF] font-bold">1.28 s</td>
                        <td class="py-4 px-4 text-center">
                            <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-500/20 text-yellow-700 dark:text-yellow-400 rounded-full text-xs font-bold">Variasi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Alat & Komponen -->
    <div class="lg:col-span-3 bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-8 rounded-[2rem] shadow-lg text-center transition-colors duration-300">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Alat & Komponen yang Digunakan</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="p-6 border border-gray-100 dark:border-gray-800 rounded-[2rem] bg-gray-50 dark:bg-white/5 hover:border-[#B4AEFF] transition-colors group">
                <div class="w-12 h-12 bg-[#B4AEFF]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#B4AEFF] transition-colors">
                    <svg class="w-6 h-6 text-[#B4AEFF] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                </div>
                <p class="font-bold text-gray-900 dark:text-white">ESP32 / NodeMCU</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Otak Utama & WiFi</p>
            </div>
            <div class="p-6 border border-gray-100 dark:border-gray-800 rounded-[2rem] bg-gray-50 dark:bg-white/5 hover:border-[#D2FF3A] transition-colors group">
                <div class="w-12 h-12 bg-[#D2FF3A]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#D2FF3A] transition-colors">
                    <svg class="w-6 h-6 text-[#D2FF3A] group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <p class="font-bold text-gray-900 dark:text-white">Sensor FC-51</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Deteksi Ayunan (IR)</p>
            </div>
            <div class="p-6 border border-gray-100 dark:border-gray-800 rounded-[2rem] bg-gray-50 dark:bg-white/5 hover:border-[#8C84FF] transition-colors group">
                <div class="w-12 h-12 bg-[#8C84FF]/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#8C84FF] transition-colors">
                    <svg class="w-6 h-6 text-[#8C84FF] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="font-bold text-gray-900 dark:text-white">Bandul Matematis</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Objek Percobaan</p>
            </div>
            <div class="p-6 border border-gray-100 dark:border-gray-800 rounded-[2rem] bg-gray-50 dark:bg-white/5 hover:border-gray-400 transition-colors group">
                <div class="w-12 h-12 bg-gray-200 dark:bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gray-400 transition-colors">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </div>
                <p class="font-bold text-gray-900 dark:text-white">Kabel Jumper</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Koneksi Rangkaian</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('sensorChart').getContext('2d');

    // Create gradient
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(140, 132, 255, 0.3)'); // Soft Purple
    gradient.addColorStop(1, 'rgba(140, 132, 255, 0)');

    // Data Aktual dari Database (SensorLogs)
    let labels = [];
    let dataSimpangan = [];
    
    @isset($sensorLogs)
    @foreach ($sensorLogs as $log)
        labels.push('{{ number_format($log->waktu_ms / 1000, 1) }}s');
        dataSimpangan.push({{ $log->simpangan }});
    @endforeach
    @endisset

    // Fallback jika tidak ada data log
    if (dataSimpangan.length === 0) {
        labels = ['0s', '1s', '2s'];
        dataSimpangan = [0, 0, 0];
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Simpangan (cm)',
                data: dataSimpangan,
                borderColor: '#8C84FF', 
                backgroundColor: gradient,
                fill: true,
                tension: 0.3, // Karakteristik gelombang fisik yang realistis
                borderWidth: 1, // Garis sangat tipis untuk kepadatan tinggi
                pointRadius: 0,
                pointHoverRadius: 0, // Matikan hover point agar tidak mengganggu visualisasi rapat
                spanGaps: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false, // Matikan animasi untuk performa data ribuan titik
            interaction: {
                mode: 'none', // Matikan interaksi untuk tampilan statis yang bersih
                intersect: false,
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false } // Matikan tooltip agar fokus pada bentuk gelombang
            },
            scales: {
                y: {
                    min: -15,
                    max: 15,
                    grid: {
                        color: (context) => context.tick.value === 0 ? 'rgba(0,0,0,0.4)' : 'rgba(0,0,0,0.03)',
                        lineWidth: (context) => context.tick.value === 0 ? 1.5 : 1,
                        drawBorder: false,
                    },
                    ticks: { color: '#bbb', font: { size: 10 } }
                },
                x: {
                    display: true,
                    ticks: {
                        color: '#bbb',
                        font: { size: 8 },
                        autoSkip: true,
                        maxTicksLimit: 30 
                    },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

@endsection