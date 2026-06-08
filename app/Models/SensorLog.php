<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'posisi_sensor',
        'simpangan',
        'waktu_ms',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
