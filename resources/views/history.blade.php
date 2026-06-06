@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white">Riwayat Data Sensor</h1>
    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#2A2D30] text-gray-300 rounded-xl hover:bg-[#3A3D40] hover:text-white transition shadow-lg border border-[#3A3D40]">
        Kembali ke Dashboard
    </a>
</div>

<!-- Container -->
<div class="bg-[#1A1C1E] border border-[#2A2D30] rounded-2xl shadow-lg p-6">
    
    <!-- Header: Search & Export -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <!-- Search Form -->
        <form action="{{ route('history') }}" method="GET" class="w-full md:w-1/2 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tali, status, ayunan..." 
                   class="w-full bg-[#0F1113] border border-[#2A2D30] text-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:border-[#D2FF3A] transition">
            <button type="submit" class="px-6 py-2 bg-[#D2FF3A] text-black font-semibold rounded-xl hover:bg-[#BFFF00] transition shadow-[0_0_15px_rgba(210,255,58,0.2)]">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('history') }}" class="px-4 py-2 bg-[#2A2D30] text-gray-300 rounded-xl hover:bg-gray-600 transition">Reset</a>
            @endif
        </form>

        <!-- Export Button -->
        <a href="{{ route('history.export', ['search' => request('search')]) }}" target="_blank" 
           class="w-full md:w-auto px-6 py-2 bg-gradient-to-r from-[#B4AEFF] to-[#8C84FF] text-white font-semibold rounded-xl hover:opacity-90 transition shadow-[0_0_15px_rgba(180,174,255,0.3)] flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export PDF
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-gray-300">
            <thead>
                <tr class="border-b border-[#2A2D30] text-gray-400">
                    <th class="py-3 px-4 font-medium">No</th>
                    <th class="py-3 px-4 font-medium">Tali</th>
                    <th class="py-3 px-4 font-medium">Jumlah Ayunan</th>
                    <th class="py-3 px-4 font-medium">Periode</th>
                    <th class="py-3 px-4 font-medium">Status</th>
                    <th class="py-3 px-4 font-medium">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($datasensor as $item)
                <tr class="border-b border-[#2A2D30] hover:bg-[#2A2D30]/50 transition">
                    <td class="py-3 px-4">{{ $loop->iteration + ($datasensor->currentPage() - 1) * $datasensor->perPage() }}</td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 bg-[#D2FF3A]/10 text-[#D2FF3A] border border-[#D2FF3A]/20 rounded-full text-xs font-semibold">
                            {{ $item->string_length ?? 'Default' }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $item->jumlah_ayunan }}</td>
                    <td class="py-3 px-4">{{ $item->periode }} s</td>
                    <td class="py-3 px-4">
                        @if(strtolower($item->status_sensor) == 'online')
                            <span class="text-green-400 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-400"></span> Online</span>
                        @else
                            <span class="text-red-400 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-400"></span> {{ $item->status_sensor }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-400">{{ $item->created_at->format('d M Y H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-500">
                        Data tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6 history-pagination">
        {{ $datasensor->links() }}
    </div>
</div>

<style>
/* Custom styling for Laravel Pagination in Dark Mode */
.history-pagination nav {
    background: transparent !important;
}
.history-pagination nav span,
.history-pagination nav a {
    background-color: #2A2D30 !important;
    border-color: #3A3D40 !important;
    color: #D1D5DB !important;
}
.history-pagination nav a:hover {
    background-color: #3A3D40 !important;
}
.history-pagination nav span[aria-current="page"] span {
    background-color: #D2FF3A !important;
    border-color: #D2FF3A !important;
    color: #1A1C1E !important;
    font-weight: bold;
}
</style>

@endsection
