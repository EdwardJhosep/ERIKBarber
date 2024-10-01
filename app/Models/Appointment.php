<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'dni',
        'appointment_type',
        'appointment_time',
    ];

    // Relación con el modelo Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
