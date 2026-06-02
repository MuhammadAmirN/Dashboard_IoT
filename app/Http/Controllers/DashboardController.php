<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SensorData;

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
