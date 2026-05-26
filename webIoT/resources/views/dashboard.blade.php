@extends('layouts.app')

@section('content')

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

        <p class="text-2xl font-bold text-green-500 mt-4">
            {{ $latest->status_sensor ?? 'Offline' }}
        </p>

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

@endsection