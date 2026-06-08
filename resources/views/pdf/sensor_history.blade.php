<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Sensor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
            color: #111;
        }
        .header p {
            margin: 5px 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .badge {
            background-color: #e0e0e0;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .footer {
            text-align: right;
            font-size: 10px;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Riwayat Data Sensor Bandul</h2>
        <p>Praktikum Fisika (Bandul Matematis Berbasis IoT)</p>
        <p>Tanggal Export: {{ now()->format('d F Y H:i:s') }}</p>
        @if(request('search'))
            <p><strong>Filter Pencarian:</strong> "{{ request('search') }}"</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tali</th>
                <th width="20%">Jumlah Ayunan</th>
                <th width="15%">Periode</th>
                <th width="15%">Status</th>
                <th width="30%">Waktu Catat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datasensor as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span class="badge">{{ $item->string_length ?? 'Default' }}</span></td>
                <td>{{ $item->jumlah_ayunan }} kali</td>
                <td>{{ $item->periode }} detik</td>
                <td>{{ $item->status_sensor }}</td>
                <td>{{ $item->created_at->format('d M Y H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Tidak ada data sensor yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem Dashboard IoT pada {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
