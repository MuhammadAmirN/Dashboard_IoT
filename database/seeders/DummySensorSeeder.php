<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SensorLog;
use App\Models\SensorData;
use Carbon\Carbon;

class DummySensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data log sebelumnya
        SensorLog::truncate();

        // Parameter untuk 4 sesi yang berbeda
        $sessions = [
            [
                'id' => 'SESI-001',
                'tali' => 'Tali A',
                'periode' => 1.5,
                'damping' => 0.0005, // Seberapa cepat berhenti (makin besar makin cepat)
                'duration_ms' => 10000,
            ],
            [
                'id' => 'SESI-002',
                'tali' => 'Tali B',
                'periode' => 2.0,
                'damping' => 0.0008,
                'duration_ms' => 12000,
            ],
            [
                'id' => 'SESI-003',
                'tali' => 'Tali C',
                'periode' => 1.2,
                'damping' => 0.0003,
                'duration_ms' => 8000,
            ],
            [
                'id' => 'SESI-004',
                'tali' => 'Tali A',
                'periode' => 1.55,
                'damping' => 0.0006,
                'duration_ms' => 11000,
            ]
        ];

        foreach ($sessions as $index => $sess) {
            $session_id = $sess['id'];
            $waktu_ms = 0;
            $interval = 50; // sampel setiap 50 ms
            $ayunan = 0;
            
            $base_time = Carbon::now()->subHours(4 - $index);

            // Simulasikan gelombang sinus teredam
            while ($waktu_ms <= $sess['duration_ms']) {
                $time_sec = $waktu_ms / 1000;
                
                // Amplitudo awal = 1, berkurang sesuai damping
                $amplitude = exp(-$sess['damping'] * $waktu_ms);
                
                // 2 * pi * (1 / periode) * t
                $simpangan = $amplitude * cos(2 * M_PI * (1 / $sess['periode']) * $time_sec);

                // Klasifikasi posisi untuk log (hanya estimasi sederhana)
                $posisi = 'tengah';
                if ($simpangan > 0.8) $posisi = 'awal';
                if ($simpangan < -0.8) $posisi = 'akhir';

                SensorLog::create([
                    'session_id' => $session_id,
                    'posisi_sensor' => $posisi,
                    'simpangan' => $simpangan,
                    'waktu_ms' => $waktu_ms,
                    'created_at' => $base_time->copy()->addMilliseconds($waktu_ms),
                    'updated_at' => $base_time->copy()->addMilliseconds($waktu_ms),
                ]);

                // Hitung ayunan sederhana (setiap melewati 1 periode penuh)
                if ($waktu_ms > 0 && ($waktu_ms % ($sess['periode'] * 1000)) < $interval) {
                    $ayunan++;
                }

                $waktu_ms += $interval;
            }

            // Buat record di SensorData juga agar konsisten
            SensorData::create([
                'jumlah_ayunan' => $ayunan,
                'periode' => $sess['periode'],
                'status_sensor' => 'Online',
                'string_length' => $sess['tali'],
                'created_at' => $base_time,
                'updated_at' => $base_time,
            ]);
        }
    }
}
