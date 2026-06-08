<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorController extends Controller
{
    public function store(Request $request)

    {
        $request->validate([
            'jumlah_ayunan' => 'required',
            'periode' => 'required',
            'status_sensor' => 'required',                                                                                                                                                                                  
        ]);

        SensorData::create([
            'jumlah_ayunan' => $request->jumlah_ayunan,
            'periode' => $request->periode,
            'status_sensor' => $request->status_sensor,
            'string_length' => $request->string_length ?? 'Default',
        ]);

        // Menyimpan log riwayat 3 sensor (jika dikirim oleh ESP32)
        if ($request->has('sensor_logs') && is_array($request->sensor_logs)) {
            $sessionId = \Illuminate\Support\Str::random(10);
            foreach ($request->sensor_logs as $log) {
                \App\Models\SensorLog::create([
                    'session_id' => $sessionId,
                    'posisi_sensor' => $log['posisi_sensor'],
                    'waktu_ms' => $log['waktu_ms'],
                    'simpangan' => $log['simpangan'] ?? 0,
                ]);
            }
        }

        return response()->json([
            'message' => 'Data sensor berhasil disimpan',
        ], 200);
    }
}
