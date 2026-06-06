<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SensorLog;
use Illuminate\Support\Str;

class SensorLogSeeder extends Seeder
{
    public function run()
    {
        SensorLog::truncate();

        // Simulasi redaman (Damped harmonic oscillation)
        // Kita simulasikan 1 sesi praktikum ayunan
        $sessionId = Str::random(8);
        
        $T_awal = 1.1; // Periode awal (detik)
        $waktu_ms = 0; // ms berjalan
        
        $jumlah_siklus = 8;
        $amplitudo = 1.0;
        $damping_factor = 0.85; // amplitudo berkurang 15% setiap ayunan
        
        $data = [];

        for ($i = 0; $i < $jumlah_siklus; $i++) {
            $T = $T_awal + ($i * 0.05); // Periode makin lama makin pelan
            
            $waktu_per_titik = ($T * 1000) / 4; // Waktu antara Awal->Tengah, Tengah->Akhir, dll.
            
            if ($amplitudo < 0.1) break; // Berhenti jika sudah terlalu pelan

            // 1 Siklus Penuh: Awal -> Tengah -> Akhir -> Tengah
            
            // Titik Awal
            $data[] = [
                'session_id' => $sessionId,
                'posisi_sensor' => 'awal',
                'simpangan' => $amplitudo,
                'waktu_ms' => $waktu_ms,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $waktu_ms += $waktu_per_titik;
            
            // Titik Tengah 1
            $data[] = [
                'session_id' => $sessionId,
                'posisi_sensor' => 'tengah',
                'simpangan' => 0,
                'waktu_ms' => $waktu_ms,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $waktu_ms += $waktu_per_titik;
            
            // Titik Akhir
            $data[] = [
                'session_id' => $sessionId,
                'posisi_sensor' => 'akhir',
                'simpangan' => -$amplitudo,
                'waktu_ms' => $waktu_ms,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $waktu_ms += $waktu_per_titik;
            
            // Titik Tengah 2
            $data[] = [
                'session_id' => $sessionId,
                'posisi_sensor' => 'tengah',
                'simpangan' => 0,
                'waktu_ms' => $waktu_ms,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $waktu_ms += $waktu_per_titik;

            // Kurangi amplitudo untuk siklus berikutnya
            $amplitudo *= $damping_factor;
        }

        // Titik Awal (Siklus terakhir berhenti / hampir berhenti)
        $data[] = [
            'session_id' => $sessionId,
            'posisi_sensor' => 'awal',
            'simpangan' => $amplitudo,
            'waktu_ms' => $waktu_ms,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        SensorLog::insert($data);
    }
}
