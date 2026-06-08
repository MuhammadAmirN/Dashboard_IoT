<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // ID unik untuk satu kali percobaan
            $table->string('posisi_sensor'); // 'awal', 'tengah', 'akhir'
            $table->float('simpangan')->default(0); // 1, 0, -1
            $table->integer('waktu_ms'); // Timestamp dalam ms sejak awal mulai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_logs');
    }
};
