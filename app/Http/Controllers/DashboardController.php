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

    public function history(Request $request)
    {
        $query = SensorData::with('user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('string_length', 'like', "%{$search}%")
                  ->orWhere('status_sensor', 'like', "%{$search}%")
                  ->orWhere('jumlah_ayunan', 'like', "%{$search}%");
        }

        $datasensor = $query->latest()->paginate(15)->appends($request->query());
        return view('history', compact('datasensor'));
    }

    public function exportPdf(Request $request)
    {
        $query = SensorData::with('user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('string_length', 'like', "%{$search}%")
                  ->orWhere('status_sensor', 'like', "%{$search}%")
                  ->orWhere('jumlah_ayunan', 'like', "%{$search}%");
        }

        $datasensor = $query->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.sensor_history', compact('datasensor'));
        return $pdf->download('Data-Sensor-'.now()->format('Y-md-His').'.pdf');
    }

    public function bacaData()
    {
        // Ambil daftar session unik dari tabel sensor_logs
        // Menggunakan groupBy pada DB driver tertentu (seperti strict mode) mungkin butuh trik
        // Kita bisa ambil distinct session_id
        $sessions = SensorLog::select('session_id', \DB::raw('MIN(created_at) as started_at'), \DB::raw('COUNT(*) as total_data'))
            ->groupBy('session_id')
            ->orderBy('started_at', 'desc')
            ->get();

        return view('baca_data', compact('sessions'));
    }

    public function getSensorLogs($session_id)
    {
        $logs = SensorLog::where('session_id', $session_id)
            ->orderBy('waktu_ms', 'asc')
            ->get();
            
        return response()->json($logs);
    }
}
