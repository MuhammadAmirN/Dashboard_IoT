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
        Schema::table('sensor_data', function (Blueprint $blueprint) {
            $blueprint->string('string_length')->nullable()->after('status_sensor')->comment('Label or length of the string used (e.g., Tali A, Tali B, or 10cm)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data', function (Blueprint $blueprint) {
            $blueprint->dropColumn('string_length');
        });
    }
};
