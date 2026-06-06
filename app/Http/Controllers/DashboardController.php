<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SensorData;
use App\Models\SensorLog;

class DashboardController extends Controller
{
    public function index()
    {
        $latest = SensorData::latest()->first();
        
        // Data untuk Chart
        $chartData = SensorData::latest()
            ->take(15)
            ->get()
            ->reverse();

        // Data Log Sensor untuk Grafik Redaman
        $latestLogSession = SensorLog::latest('id')->first();
        $sensorLogs = [];
        if ($latestLogSession) {
            $sensorLogs = SensorLog::where('session_id', $latestLogSession->session_id)
                ->orderBy('waktu_ms', 'asc')
                ->get();
        }

        // Ringkasan per Tali
        $summary = SensorData::selectRaw('string_length, AVG(periode) as avg_periode, SUM(jumlah_ayunan) as total_ayunan')
            ->groupBy('string_length')
            ->get();

        $status = 'Offline';
        if ($latest && $latest->created_at->diffInSeconds(now()) < 15) {
            $status = 'Online';
        }

        return view('dashboard', compact(
            'latest',
            'chartData',
            'sensorLogs',
            'status',
            'summary'
        ));
    }

    public function history()
    {
        $datasensor = SensorData::latest()->paginate(15);
        return view('history', compact('datasensor'));
    }
}
