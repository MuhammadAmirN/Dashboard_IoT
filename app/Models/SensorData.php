<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $table= 'sensor_data';
    protected $fillable = [
        'jumlah_ayunan',
        'periode',
        'status_sensor',
    ];
}
