@extends('layouts.app')

@section('content')

<!-- Card Dashboard -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Jumlah Ayunan -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Jumlah Ayunan
        </h2>

        <p class="text-4xl font-bold text-blue-600 mt-4">
            {{ $latest->jumlah_ayunan ?? 0 }}
        </p>

    </div>

    <!-- Periode -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Periode
        </h2>

        <p class="text-4xl font-bold text-blue-600 mt-4">
            {{ $latest->periode ?? 0 }} s
        </p>

    </div>

    <!-- Status -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Status Sensor
        </h2>

        <p class="text-2xl font-bold mt-4
        {{ $status == 'Online' ? 'text-green-500' : 'text-red-500' }}">

        {{ $status }}

    </p>
    </div>

</div>

<!-- Pemilihan Panjang Tali -->
<div class="bg-white p-6 rounded-2xl shadow-lg mb-8">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Pilih Panjang Tali (Aktif)</h2>
    <div class="flex flex-wrap gap-4">
        <button class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-md focus:ring-4 focus:ring-blue-300 font-bold text-sm">Tali A</button>
        <button class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-md focus:ring-4 focus:ring-blue-300 font-bold text-sm">Tali B</button>
        <button class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-md focus:ring-4 focus:ring-blue-300 font-bold text-sm">Tali C</button>
    </div>
    <p class="mt-4 text-sm text-gray-500 italic">*Data sensor yang masuk akan ditandai dengan label tali yang dipilih.</p>
</div>

<!-- Chart -->
<div class="bg-white p-6 rounded-2xl shadow-lg mb-8">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">
        Grafik Periode Bandul
    </h2>

    <div class="h-96">
        <canvas id="sensorChart"></canvas>
    </div>

</div>

<!-- Alat & Komponen -->
<div class="bg-white p-6 rounded-2xl shadow-lg mb-8 text-center">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Alat & Komponen yang Digunakan</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="p-4 border border-blue-100 rounded-xl bg-blue-50">
            <p class="font-bold text-blue-800">ESP32 / NodeMCU</p>
            <p class="text-xs text-gray-500">Otak Utama & WiFi</p>
        </div>
        <div class="p-4 border border-blue-100 rounded-xl bg-blue-50">
            <p class="font-bold text-blue-800">Sensor FC-51</p>
            <p class="text-xs text-gray-500">Deteksi Ayunan (IR)</p>
        </div>
        <div class="p-4 border border-blue-100 rounded-xl bg-blue-50">
            <p class="font-bold text-blue-800">Bandul Matematis</p>
            <p class="text-xs text-gray-500">Objek Percobaan</p>
        </div>
        <div class="p-4 border border-blue-100 rounded-xl bg-blue-50">
            <p class="font-bold text-blue-800">Kabel Jumper</p>
            <p class="text-xs text-gray-500">Koneksi Rangkaian</p>
        </div>
    </div>
</div>

<!-- Table Summary Comparison -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-8">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-700">
            Perbandingan Antar Tali
        </h2>
        <a href="{{ route('history') }}" class="text-blue-600 hover:underline font-semibold">
            Lihat Semua Riwayat &rarr;
        </a>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="border-b text-gray-600">
                    <th class="py-3 px-4">Panjang Tali</th>
                    <th class="py-3 px-4 text-center">Waktu (10 Ayunan)</th>
                    <th class="py-3 px-4 text-center">Waktu Rata-rata</th>
                    <th class="py-3 px-4 text-center">Periode (T)</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($summary as $item)
                <tr class="border-b hover:bg-blue-50 transition">
                    <td class="py-4 px-4">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold text-sm shadow-sm">
                            {{ $item->string_length ?? 'Default' }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-center font-semibold text-gray-700">
                        {{ number_format($item->avg_periode * 10, 2) }} s
                    </td>
                    <td class="py-4 px-4 text-center font-semibold text-gray-700">
                        {{ number_format($item->avg_periode, 3) }} s
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="text-blue-600 font-bold">
                            {{ number_format($item->avg_periode, 2) }} t/detik
                        </span>
                    </td>
                </tr>
                @endforeach
                @if($summary->isEmpty())
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-400 italic">Belum ada data perbandingan tali.</td>
                </tr>
                @endif
            </tbody>

        </table>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('sensorChart');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: [
                @foreach ($chartData as $item)
                    '{{ $item->created_at->format('H:i:s') }}',
                @endforeach
            ],

            datasets: [{
                label: 'Periode Bandul',

                data: [
                    @foreach ($chartData as $item)
                        {{ $item->periode }},
                    @endforeach
                ],

                borderWidth: 3,
                borderColor: 'rgba(59, 130, 246, 1)', // Biru Tailwind
                backgroundColor: 'rgba(59, 130, 246, 0.2)', // Transparan untuk efek gelombang
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)'
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});

</script>

<script>
// Auto-refresh dimatikan sementara untuk transisi ke Real-time
/*
    setInterval(() => {
        location.reload();
    }, 10000);
*/
</script>

@endsection