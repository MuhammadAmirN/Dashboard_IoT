@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Jumlah Ayunan
        </h2>

        <p class="text-4xl font-bold text-blue-600 mt-4">
            25
        </p>

    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Periode
        </h2>

        <p class="text-4xl font-bold text-blue-600 mt-4">
            2.1 s
        </p>

    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-gray-500 text-lg">
            Status Sensor
        </h2>

        <p class="text-2xl font-bold text-green-500 mt-4">
            Aktif
        </p>

    </div>

</div>

@endsection