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

        return response()->json([
            'message' => 'Data sensor berhasil disimpan',
        ], 200);
    }
}
