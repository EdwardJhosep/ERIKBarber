<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Especificar la tabla asociada, si el nombre no sigue la convención
    protected $table = 'appointments';

    // Definir los campos que se pueden asignar en masa
    protected $fillable = [
        'phone_number',          // Número de celular
        'appointment_date',      // Fecha de la cita
        'appointment_time',      // Hora de la cita
        'appointment_type',      // Tipo de cita
        'status',                // Estado de la cita
        'fotopagocita',         // Foto del pago de la cita
    ];
}
