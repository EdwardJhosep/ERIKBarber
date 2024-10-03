<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'numero_de_celular', // Campo para el número de celular
        'appointment_time', // Campo para la fecha y hora de la cita
        'appointment_type', // Campo para el tipo de cita
        'status',

    ];
}
