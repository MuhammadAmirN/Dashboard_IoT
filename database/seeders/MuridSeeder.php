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
        for ($i = 1; $i <= 5; $i++) {
            $user = User::updateOrCreate(
                ['email' => "murid{$i}@murid.com"],
                [
                    'name' => "Murid-$i",
                    'password' => Hash::make('11223344'),
                    'role' => 'murid'
                ]
            );

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

                // Create logs for this session
                $waktu = 0;
                for ($k = 0; $k < 15; $k++) {
                    $waktu += 100;
                    $simpangan = sin($waktu / 1000) * exp(-$waktu / 5000); // redaman mockup
                    SensorLog::create([
                        'session_id' => $session_id,
                        'user_id' => $user->id,
                        'waktu_ms' => $waktu,
                        'simpangan' => $simpangan,
                        'posisi_sensor' => 1
                    ]);
                }
            }
        }
    }
}
