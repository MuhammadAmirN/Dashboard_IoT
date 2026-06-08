<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorController extends Controller
{
    public function latest()
{
    $latest = SensorData::latest()->first();

    return response()->json([
        'success' => true,
        'data' => $latest
    ]);
}
    public function store(Request $request)
    {
        $request->validate([
    'jumlah_ayunan' => 'required|integer',
    'periode' => 'required|numeric',
    'status_sensor' => 'required|string',
]);

        $sensorData = SensorData::create([
            'jumlah_ayunan' => $request->jumlah_ayunan,
            'periode' => $request->periode,
            'status_sensor' => $request->status_sensor,
            'string_length' => $request->string_length ?? 'Default',
        ]);

        // LOGIKA BARU: Menangani log grafik (untuk simulasi manual atau real-time)
        $sessionId = null;

        // Cek apakah ada session yang masih aktif (kurang dari 30 detik yang lalu)
        $lastLog = \App\Models\SensorLog::latest('id')->first();
        if ($lastLog && $lastLog->created_at->diffInSeconds(now()) < 30) {
            $sessionId = $lastLog->session_id;
        } else {
            $sessionId = \Illuminate\Support\Str::random(10);
        }

        // 1. Jika kirim data tunggal (untuk simulasi manual Thunder Client)
        if ($request->has('simpangan')) {
            \App\Models\SensorLog::create([
                'session_id' => $sessionId,
                'posisi_sensor' => 1, // Default
                'waktu_ms' => now()->timestamp * 1000,
                'simpangan' => $request->simpangan,
            ]);
        }

        // 2. Jika kirim data banyak sekaligus (untuk alat/ESP32)
        if ($request->has('sensor_logs') && is_array($request->sensor_logs)) {
            foreach ($request->sensor_logs as $log) {
                \App\Models\SensorLog::create([
                    'session_id' => $sessionId,
                    'posisi_sensor' => $log['posisi_sensor'] ?? '1', // Default '1' jika tidak ada
                    'waktu_ms' => $log['waktu_ms'],
                    'simpangan' => $log['simpangan'] ?? 0,
                ]);
            }
        }

        return response()->json([
    'success' => true,
    'message' => 'Data sensor berhasil disimpan',
    'session_id' => $sessionId,
    'data' => $sensorData
], 201);
    }
}
