<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SensorData;
use App\Models\SensorLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MuridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $users[] = User::updateOrCreate(
                ['email' => "murid{$i}@murid.com"],
                [
                    'name' => "Murid-$i",
                    'password' => Hash::make('11223344'),
                    'role' => 'murid'
                ]
            );
        }

        // Buat akun Guru juga agar punya data sendiri (atau ambil yang sudah ada)
        $guru = User::firstOrCreate(
            ['email' => 'guru@guru.com'],
            [
                'name' => 'Guru IPA',
                'password' => Hash::make('11223344'), // Ubah sesuai kebutuhan jika sebelumnya beda
                'role' => 'guru'
            ]
        );
        $users[] = $guru;

        foreach ($users as $user) {

            // Create some dummy sensor data for each user
            for ($j = 0; $j < 3; $j++) {
                $session_id = Str::uuid()->toString();
                $tali = ['Tali A', 'Tali B', 'Tali C'][rand(0, 2)];
                $ayunan = rand(10, 20);
                $periode = rand(100, 250) / 100; // 1.00 to 2.50

                $sensorData = SensorData::create([
                    'user_id' => $user->id,
                    'string_length' => $tali,
                    'status_sensor' => 'Online',
                    'jumlah_ayunan' => $ayunan,
                    'periode' => $periode,
                    'created_at' => now()->subDays(rand(0, 5))->subHours(rand(1, 10))
                ]);

                // Create logs for this session (simulasi ayunan dengan redaman)
                $waktu = 0;
                $total_swings = 10;
                $damping_factor = 0.3; // Faktor redaman

                for ($swing = 0; $swing < $total_swings; $swing++) {
                    $amplitude = exp(-$swing * $damping_factor);
                    
                    if ($swing == 0) {
                        // Titik Awal
                        SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => $amplitude, 'posisi_sensor' => 1]);
                    }
                    
                    // Tengah
                    $waktu += ($periode * 1000) * 0.25;
                    SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => 0, 'posisi_sensor' => 2]);
                    
                    // Akhir (Negative amplitude)
                    $waktu += ($periode * 1000) * 0.25;
                    $mid_amplitude = exp(-($swing + 0.5) * $damping_factor);
                    SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => -$mid_amplitude, 'posisi_sensor' => 3]);
                    
                    // Tengah
                    $waktu += ($periode * 1000) * 0.25;
                    SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => 0, 'posisi_sensor' => 2]);
                    
                    // Awal (Amplitude for next swing)
                    $waktu += ($periode * 1000) * 0.25;
                    $next_amplitude = exp(-($swing + 1) * $damping_factor);
                    
                    // Jika ini swing terakhir, ayunan berhenti di tengah, jadi tidak perlu Awal lagi
                    if ($swing < $total_swings - 1) {
                        SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => $next_amplitude, 'posisi_sensor' => 1]);
                    }
                }
                
                // Berhenti sepenuhnya di tengah
                $waktu += ($periode * 1000) * 0.25;
                SensorLog::create(['session_id' => $session_id, 'user_id' => $user->id, 'waktu_ms' => $waktu, 'simpangan' => 0, 'posisi_sensor' => 2]);
            }
        }
    }
}
