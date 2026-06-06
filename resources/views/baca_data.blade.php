@extends('layouts.app')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Baca Data (Komparasi)</h1>
    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 dark:bg-[#2A2D30] text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-[#3A3D40] hover:text-gray-900 dark:hover:text-white transition shadow-sm dark:shadow-lg border border-gray-200 dark:border-[#3A3D40]">
        Kembali ke Dashboard
    </a>
</div>

<!-- Controls -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <!-- Select 1 -->
    <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] rounded-2xl shadow-sm dark:shadow-lg p-6 transition-colors duration-300">
        <label class="block text-sm font-bold text-[#b4dc1f] dark:text-[#D2FF3A] mb-2">Data Grafik 1 (Hijau)</label>
        <select id="select-data-1" class="w-full bg-gray-50 dark:bg-[#0F1113] border border-gray-200 dark:border-[#2A2D30] text-gray-700 dark:text-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:border-[#D2FF3A] transition appearance-none">
            <option value="">-- Pilih Sesi Data --</option>
            @foreach($sessions as $session)
                <option value="{{ $session->session_id }}">Sesi {{ $session->session_id }} ({{ \Carbon\Carbon::parse($session->started_at)->format('d M H:i') }})</option>
            @endforeach
        </select>
    </div>

    <!-- Select 2 -->
    <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] rounded-2xl shadow-sm dark:shadow-lg p-6 transition-colors duration-300">
        <label class="block text-sm font-bold text-[#8C84FF] dark:text-[#B4AEFF] mb-2">Data Grafik 2 (Ungu)</label>
        <select id="select-data-2" class="w-full bg-gray-50 dark:bg-[#0F1113] border border-gray-200 dark:border-[#2A2D30] text-gray-700 dark:text-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:border-[#B4AEFF] transition appearance-none">
            <option value="">-- Pilih Sesi Data --</option>
            @foreach($sessions as $session)
                <option value="{{ $session->session_id }}">Sesi {{ $session->session_id }} ({{ \Carbon\Carbon::parse($session->started_at)->format('d M H:i') }})</option>
            @endforeach
        </select>
    </div>

    <!-- Select 3 -->
    <div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] rounded-2xl shadow-sm dark:shadow-lg p-6 transition-colors duration-300">
        <label class="block text-sm font-bold text-orange-500 dark:text-orange-400 mb-2">Data Grafik 3 (Oranye)</label>
        <select id="select-data-3" class="w-full bg-gray-50 dark:bg-[#0F1113] border border-gray-200 dark:border-[#2A2D30] text-gray-700 dark:text-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:border-orange-400 transition appearance-none">
            <option value="">-- Pilih Sesi Data --</option>
            @foreach($sessions as $session)
                <option value="{{ $session->session_id }}">Sesi {{ $session->session_id }} ({{ \Carbon\Carbon::parse($session->started_at)->format('d M H:i') }})</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Chart Card -->
<div class="bg-white dark:bg-[#1A1C1E] border border-gray-200 dark:border-[#2A2D30] p-6 rounded-[2rem] shadow-lg mt-2 text-gray-900 dark:text-white relative overflow-hidden min-h-[400px] flex flex-col transition-colors duration-300">
    <div class="flex justify-between items-center mb-6 z-10 relative">
        <div class="flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
            Perbandingan Grafik Simpangan Bandul
        </div>
        <button id="btn-reset" class="px-4 py-2 bg-gray-100 dark:bg-[#2A2D30] text-gray-700 dark:text-gray-300 rounded-full text-sm font-semibold hover:bg-gray-200 dark:hover:bg-[#3A3D40] transition">
            Reset Grafik
        </button>
    </div>

    <div class="flex-1 w-full z-10 relative h-64">
        <canvas id="compareChart"></canvas>
    </div>
    
    <!-- Decorative grid pattern background -->
    <div class="absolute bottom-0 left-0 w-full h-32 opacity-10 dark:opacity-5" style="background-image: repeating-linear-gradient(45deg, #888 25%, transparent 25%, transparent 75%, #888 75%, #888), repeating-linear-gradient(45deg, #888 25%, transparent 25%, transparent 75%, #888 75%, #888); background-position: 0 0, 10px 10px; background-size: 20px 20px;"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('compareChart').getContext('2d');

    // Create Gradients
    let gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, 'rgba(210, 255, 58, 0.4)');
    gradient1.addColorStop(1, 'rgba(210, 255, 58, 0)');

    let gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, 'rgba(180, 174, 255, 0.4)');
    gradient2.addColorStop(1, 'rgba(180, 174, 255, 0)');

    let gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient3.addColorStop(0, 'rgba(249, 115, 22, 0.4)'); // orange-500
    gradient3.addColorStop(1, 'rgba(249, 115, 22, 0)');

    // Inisialisasi Chart Kosong
    let compareChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // Waktu (ms) akan diisi dinamis
            datasets: [
                {
                    label: 'Data 1',
                    data: [],
                    borderColor: '#b4dc1f', // Dark: #D2FF3A
                    backgroundColor: gradient1,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0, // Sembunyikan titik agar lebih bersih jika data banyak
                    pointHoverRadius: 6,
                },
                {
                    label: 'Data 2',
                    data: [],
                    borderColor: '#8C84FF', // Dark: #B4AEFF
                    backgroundColor: gradient2,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                },
                {
                    label: 'Data 3',
                    data: [],
                    borderColor: '#f97316', // Dark: orange-500
                    backgroundColor: gradient3,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                }
            ]
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
                    display: true,
                    labels: { color: '#888' }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 10,
                }
            },
            scales: {
                y: {
                    min: -1.2,
                    max: 1.2,
                    ticks: {
                        color: '#888',
                        callback: function(value) {
                            if(value === 1) return 'Awal';
                            if(value === 0) return 'Tengah';
                            if(value === -1) return 'Akhir';
                            return '';
                        },
                        font: { size: 12, weight: 'bold' }
                    },
                    grid: {
                        color: 'rgba(128, 128, 128, 0.15)',
                        drawBorder: false,
                    }
                },
                x: {
                    ticks: { color: '#888' },
                    grid: { display: false }
                }
            }
        }
    });

    // Label arrays array of arrays for syncing X axis
    let allLabels = [[], [], []];

    // Fungsi Fetch dan Update
    async function fetchAndUpdate(datasetIndex, sessionId) {
        if (!sessionId) {
            compareChart.data.datasets[datasetIndex].data = [];
            compareChart.data.datasets[datasetIndex].label = `Data ${datasetIndex + 1}`;
            allLabels[datasetIndex] = [];
            recalculateLabels();
            compareChart.update();
            return;
        }

        try {
            const response = await fetch(`/api/baca-data/${sessionId}`);
            const data = await response.json();
            
            // Map data
            let simpanganData = [];
            let labels = [];

            data.forEach(log => {
                labels.push((log.waktu_ms / 1000).toFixed(2) + 's');
                simpanganData.push(log.simpangan);
            });

            allLabels[datasetIndex] = labels;
            recalculateLabels();

            // Update Dataset
            compareChart.data.datasets[datasetIndex].data = simpanganData;
            compareChart.data.datasets[datasetIndex].label = 'Sesi ' + sessionId;
            compareChart.update();

        } catch (error) {
            console.error("Gagal mengambil data:", error);
        }
    }

    function recalculateLabels() {
        let longest = [];
        for (let i = 0; i < allLabels.length; i++) {
            if (allLabels[i].length > longest.length) {
                longest = allLabels[i];
            }
        }
        compareChart.data.labels = longest;
    }

    // Event Listeners
    document.getElementById('select-data-1').addEventListener('change', function() {
        fetchAndUpdate(0, this.value);
    });

    document.getElementById('select-data-2').addEventListener('change', function() {
        fetchAndUpdate(1, this.value);
    });

    document.getElementById('select-data-3').addEventListener('change', function() {
        fetchAndUpdate(2, this.value);
    });

    // Reset
    document.getElementById('btn-reset').addEventListener('click', function() {
        document.getElementById('select-data-1').value = "";
        document.getElementById('select-data-2').value = "";
        document.getElementById('select-data-3').value = "";
        
        allLabels = [[], [], []];
        compareChart.data.labels = [];
        compareChart.data.datasets[0].data = [];
        compareChart.data.datasets[0].label = "Data 1";
        compareChart.data.datasets[1].data = [];
        compareChart.data.datasets[1].label = "Data 2";
        compareChart.data.datasets[2].data = [];
        compareChart.data.datasets[2].label = "Data 3";
        compareChart.update();
    });
});
</script>

@endsection
