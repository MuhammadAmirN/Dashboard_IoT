@extends('layouts.app')

@section('content')

<div class="flex justify-between items-end mb-6">
    <div>
        <h1 class="text-4xl font-bold mb-2">WebIoT Dashboard</h1>
        <p class="text-gray-500 text-sm">Pantau alat bandul matematis secara realtime!</p>
    </div>
    <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm text-sm font-semibold text-gray-700">
        <span>{{ now()->format('d M, Y') }}</span>
        <span class="text-gray-300">|</span>
        <span>Hari Ini &or;</span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Card 1: Jumlah Ayunan (Besar Kiri) -->
    <div class="lg:col-span-1 bg-white p-6 rounded-[2rem] shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[320px]">
        <div>
            <div class="flex justify-between items-start mb-2">
                <div class="flex items-center gap-2 text-gray-700 font-semibold">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Jumlah Ayunan
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                </button>
            </div>
            <div class="flex items-baseline gap-2 mt-2">
                <h3 class="text-4xl font-bold">{{ $latest->jumlah_ayunan ?? 0 }}</h3>
                <span class="text-sm font-bold bg-[#D2FF3A] text-black px-2 py-0.5 rounded-md">+1</span>
            </div>
        </div>

        <!-- Decorative Circles matching mockup -->
        <div class="relative h-44 mt-4">
            <div class="absolute left-0 top-0 w-[120px] h-[120px] bg-[#B4AEFF] rounded-full flex flex-col items-center justify-center shadow-sm z-10 text-black">
                <span class="text-3xl font-bold">{{ $latest->jumlah_ayunan ?? 0 }}</span>
                <span class="text-xs">ayunan</span>
            </div>
            <div class="absolute left-[90px] top-[10px] w-[100px] h-[100px] bg-[#1A1C1E] rounded-full flex flex-col items-center justify-center shadow-lg z-20 text-white">
                <span class="text-2xl font-bold">{{ number_format($latest->periode ?? 0, 1) }}<span class="text-sm">s</span></span>
                <span class="text-xs text-gray-300">periode</span>
            </div>
            <div class="absolute left-[65px] top-[90px] w-[80px] h-[80px] bg-[#D2FF3A] rounded-full flex flex-col items-center justify-center shadow-md z-30 text-black">
                <span class="text-sm font-bold">{{ $latest->string_length ?? 'Tali' }}</span>
            </div>
        </div>

        <!-- Progress Bars bottom -->
        <div class="space-y-4 mt-6">
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800">
                    <span>45%</span>
                    <span class="text-gray-400 text-xs font-medium flex items-center gap-1">Ayunan <div class="w-2 h-2 rounded-full bg-[#B4AEFF]"></div></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-[#B4AEFF] h-2 rounded-full" style="width: 45%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800">
                    <span>30%</span>
                    <span class="text-gray-400 text-xs font-medium flex items-center gap-1">Standby <div class="w-2 h-2 rounded-full bg-[#1A1C1E]"></div></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-[#1A1C1E] h-2 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm font-bold mb-1 text-gray-800">
                    <span>25%</span>
                    <span class="text-gray-400 text-xs font-medium flex items-center gap-1">Delay <div class="w-2 h-2 rounded-full bg-[#D2FF3A]"></div></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-[#D2FF3A] h-2 rounded-full" style="width: 25%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side Grid (2 cols inside) -->
    <div class="lg:col-span-2 flex flex-col gap-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card 2: Periode (Kanan Atas 1) -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm flex flex-col justify-between h-44">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-2 text-gray-700 font-semibold">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Periode
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="flex items-end justify-between mt-auto">
                    <div>
                        <span class="text-5xl font-bold">{{ number_format($latest->periode ?? 0, 1) }}</span>
                        <span class="text-gray-500 font-medium ml-1">detik</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-medium">Avg</p>
                        <p class="font-bold text-gray-800 text-sm">1.5 s</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Status Sensor (Kanan Atas 2) -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm flex flex-col justify-between h-44">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-2 text-gray-700 font-semibold">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Status
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="flex items-end justify-between mt-auto">
                    <div>
                        <span class="text-4xl font-bold {{ $status == 'Online' ? 'text-black' : 'text-red-500' }}">{{ $status }}</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-medium mb-1">Koneksi</p>
                        <div class="w-16 h-1.5 bg-gray-100 rounded-full ml-auto">
                            <div class="h-1.5 rounded-full {{ $status == 'Online' ? 'bg-[#D2FF3A]' : 'bg-red-500' }} w-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Wellness Index Mockup / Panjang Tali -->
        <div class="bg-white p-6 rounded-[2rem] shadow-sm flex-1 flex flex-col justify-between min-h-[180px]">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-2 text-gray-700 font-semibold">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Pemilihan Tali
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                </button>
            </div>
            
            <div class="flex items-center gap-4">
                <h3 class="text-4xl font-bold">Tali A</h3>
                <span class="text-sm font-bold bg-[#D2FF3A] text-black px-2 py-0.5 rounded-md">Aktif</span>
            </div>
            
            <div class="mt-4 flex gap-2">
                <div class="flex-1 h-12 bg-gray-50 rounded-xl border-2 border-[#D2FF3A] flex items-center justify-center font-bold cursor-pointer">Tali A</div>
                <div class="flex-1 h-12 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center text-gray-500 font-semibold cursor-pointer hover:bg-gray-100">Tali B</div>
                <div class="flex-1 h-12 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center text-gray-500 font-semibold cursor-pointer hover:bg-gray-100">Tali C</div>
            </div>
        </div>

    </div>

    <!-- Card 5: Dark Chart Card (Full width bottom) -->
    <div class="lg:col-span-3 bg-[#1A1C1E] p-6 rounded-[2rem] shadow-lg mt-2 text-white relative overflow-hidden min-h-[300px] flex flex-col">
        <div class="flex justify-between items-center mb-6 z-10 relative">
            <div class="flex items-center gap-2 font-semibold">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                Visualisasi Pergerakan Bandul (Simpangan)
            </div>
            <div class="bg-white/10 px-4 py-2 rounded-full text-sm flex items-center gap-2 cursor-pointer hover:bg-white/20 transition">
                Monthly
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
        
        <div class="flex gap-10 mb-6 z-10 relative">
            <div>
                <span class="text-4xl font-bold text-[#D2FF3A] border-l-4 border-[#D2FF3A] pl-3">{{ number_format($latest->periode ?? 0, 2) }}<span class="text-2xl">s</span></span>
                <p class="text-sm text-gray-400 mt-1 pl-4">Periode Terakhir</p>
            </div>
            <div>
                <span class="text-4xl font-bold text-[#B4AEFF] border-l-4 border-[#B4AEFF] pl-3">{{ $latest->jumlah_ayunan ?? 0 }}</span>
                <p class="text-sm text-gray-400 mt-1 pl-4">Total Ayunan</p>
            </div>
        </div>

        <div class="flex-1 w-full z-10 relative h-40">
            <canvas id="sensorChart"></canvas>
        </div>
        
        <!-- Decorative grid pattern background for the dark card -->
        <div class="absolute bottom-0 left-0 w-full h-32 opacity-10" style="background-image: repeating-linear-gradient(45deg, #ffffff 25%, transparent 25%, transparent 75%, #ffffff 75%, #ffffff), repeating-linear-gradient(45deg, #ffffff 25%, transparent 25%, transparent 75%, #ffffff 75%, #ffffff); background-position: 0 0, 10px 10px; background-size: 20px 20px;"></div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('sensorChart').getContext('2d');

    // Create gradient
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(210, 255, 58, 0.6)'); // #D2FF3A
    gradient.addColorStop(1, 'rgba(210, 255, 58, 0)');

    // Data Aktual dari Database (SensorLogs)
    let labels = [];
    let dataSimpangan = [];
    
    @isset($sensorLogs)
    @foreach ($sensorLogs as $log)
        labels.push('{{ number_format($log->waktu_ms / 1000, 2) }}s');
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
                label: 'Posisi Bandul',
                data: dataSimpangan,
                borderColor: '#D2FF3A',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4, // Tetap smooth dengan Bezier Curve
                borderWidth: 3,
                pointRadius: 4, // Tampilkan titik lokasi sensor memotong
                pointHoverRadius: 6,
                pointBackgroundColor: '#B4AEFF',
                pointBorderColor: '#1A1C1E',
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1A1C1E',
                    titleColor: '#fff',
                    bodyColor: '#D2FF3A',
                    borderColor: '#333',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: function(context) {
                            let val = context.raw;
                            if(val > 0.8) return 'Posisi: Titik Awal';
                            if(val < -0.8) return 'Posisi: Titik Akhir';
                            if(val >= -0.2 && val <= 0.2) return 'Posisi: Titik Tengah';
                            return 'Amplitudo: ' + val.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    min: -1.2,
                    max: 1.2,
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.6)',
                        callback: function(value) {
                            if(value === 1) return 'Awal';
                            if(value === 0) return 'Tengah';
                            if(value === -1) return 'Akhir';
                            return '';
                        },
                        font: { size: 12, weight: 'bold' }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false,
                    }
                },
                x: {
                    display: false, // Sembunyikan garis ms agar lebih bersih
                }
            }
        }
    });
});
</script>

@endsection