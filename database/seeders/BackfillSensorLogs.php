<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SensorLog;
use App\Models\SensorData;
use Carbon\Carbon;

class BackfillSensorLogs extends Seeder
{
    public function run(): void
    {
        SensorLog::truncate();

        $allData = SensorData::all();
        $counter = 1;

        foreach ($allData as $data) {
            $session_id = 'SESI-HIST-' . str_pad($counter, 3, '0', STR_PAD_LEFT);
            $counter++;

            $waktu_ms = 0;
            $interval = 50; 
            $periode = $data->periode > 0 ? $data->periode : 1.5;
            $duration_ms = ($data->jumlah_ayunan > 0 ? $data->jumlah_ayunan : 5) * $periode * 1000;
            if ($duration_ms > 20000) $duration_ms = 20000; // Cap to 20s to avoid huge graphs

            // Basic damping
            $damping = 0.0005;

            while ($waktu_ms <= $duration_ms) {
                $time_sec = $waktu_ms / 1000;
                $amplitude = exp(-$damping * $waktu_ms);
                $simpangan = $amplitude * cos(2 * M_PI * (1 / $periode) * $time_sec);

                $posisi = 'tengah';
                if ($simpangan > 0.8) $posisi = 'awal';
                if ($simpangan < -0.8) $posisi = 'akhir';

                SensorLog::create([
                    'session_id' => $session_id,
                    'posisi_sensor' => $posisi,
                    'simpangan' => $simpangan,
                    'waktu_ms' => $waktu_ms,
                    'created_at' => $data->created_at->copy()->addMilliseconds($waktu_ms),
                    'updated_at' => $data->created_at->copy()->addMilliseconds($waktu_ms),
                ]);

                $waktu_ms += $interval;
            }
        }
    }
}
