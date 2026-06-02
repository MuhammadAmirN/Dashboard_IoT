@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-800">Riwayat Data Sensor</h1>
    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
        Kembali ke Dashboard
    </a>
</div>

<!-- Table History -->
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Tali</th>
                    <th class="py-3 px-4">Jumlah Ayunan</th>
                    <th class="py-3 px-4">Periode</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datasensor as $item)
                <tr class="border-b hover:bg-blue-50 transition">
                    <td class="py-3 px-4">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                            {{ $item->string_length ?? 'Default' }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $item->jumlah_ayunan }}</td>
                    <td class="py-3 px-4">{{ $item->periode }} s</td>
                    <td class="py-3 px-4">{{ $item->status_sensor }}</td>
                    <td class="py-3 px-4">{{ $item->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $datasensor->links() }}
    </div>
</div>

@endsection
