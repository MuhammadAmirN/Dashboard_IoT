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

        return view('dashboard', compact(
            'latest',
            'datasensor',
            ));
    }
}
