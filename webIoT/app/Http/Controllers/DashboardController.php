<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SensorData;

class DashboardController extends Controller
{
    public function index()
    {
        $latest = SensorData::latest()->first();
        $datasensor = SensorData::latest()->get();
        $chartData = SensorData::latest()
            ->take(10)
            ->get()
            ->reverse();

        return view('dashboard', compact(
            'latest',
            'datasensor',
            'chartData',

            ));
    }
}
