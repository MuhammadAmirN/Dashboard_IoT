<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\SensorData;
use App\Models\SensorLog;

class MuridController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $latest = SensorData::where('user_id', $userId)->latest()->first();
        
        // Data untuk Chart (hanya milik murid ini)
        $chartData = SensorData::where('user_id', $userId)
            ->latest()
            ->take(15)
            ->get()
            ->reverse();

        // Data Log Sensor untuk Grafik Redaman (berdasarkan latest data)
        $sensorLogs = [];
        if ($latest) {
            // Kita butuh tau session_id dari percobaan terbaru murid ini
            // Asumsikan kita punya mekanisme untuk menautkan session_id ke user_id
            // Untuk saat ini, mari cari log yang user_id nya sesuai dengan murid
            // Note: sensor_logs juga memiliki user_id sekarang
            $latestLogSession = SensorLog::where('user_id', $userId)->latest('id')->first();
            
            if ($latestLogSession) {
                $sensorLogs = SensorLog::where('session_id', $latestLogSession->session_id)
                    ->orderBy('waktu_ms', 'asc')
                    ->get();
            }
        }

        // Ringkasan per Tali (hanya milik murid)
        $summary = SensorData::where('user_id', $userId)
            ->selectRaw('string_length, AVG(periode) as avg_periode, SUM(jumlah_ayunan) as total_ayunan')
            ->groupBy('string_length')
            ->get();

        $status = 'Offline';
        if ($latest && $latest->created_at->diffInSeconds(now()) < 15) {
            $status = 'Online';
        }

        return view('murid.dashboard', compact(
            'latest',
            'chartData',
            'sensorLogs',
            'status',
            'summary'
        ));
    }
}
