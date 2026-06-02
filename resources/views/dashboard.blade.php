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

<!-- Chart -->
<div class="bg-white p-6 rounded-2xl shadow-lg mb-8">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">
        Grafik Periode Bandul
    </h2>

    <div class="h-96">
        <canvas id="sensorChart"></canvas>
    </div>

</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-lg p-6">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">
        Riwayat Data Sensor
    </h2>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="border-b">

                    <th class="py-3">No</th>
                    <th class="py-3">Jumlah Ayunan</th>
                    <th class="py-3">Periode</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Waktu</th>

                </tr>
            </thead>

            <tbody>

                @foreach ($datasensor as $item)

                <tr class="border-b hover:bg-blue-50 transition">

                    <td class="py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="py-3">
                        {{ $item->jumlah_ayunan }}
                    </td>

                    <td class="py-3">
                        {{ $item->periode }} s
                    </td>

                    <td class="py-3">
                        {{ $item->status_sensor }}
                    </td>

                    <td class="py-3">
                        {{ $item->created_at }}
                    </td>

                </tr>

                @endforeach

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
// Auto-refresh setiap 10 detik
    setInterval(() => {
        location.reload();
    }, 10000);

</script>

@endsection