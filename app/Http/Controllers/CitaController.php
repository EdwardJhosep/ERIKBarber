<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class CitaController extends Controller
{
    public function index()
    {
        // Obtener solo los registros de la tabla appointments con estado "pendiente"
        $appointments = Appointment::where('status', 'pendiente')->get();

        // Pasar los datos a la vista appointments
        return view('appointments', compact('appointments')); 
    }
    public function confirm($id)
    {
        // Buscar la cita por su ID
        $appointment = Appointment::findOrFail($id);
        
        // Cambiar el estado de la cita a "confirmado"
        $appointment->status = 'confirmado';
        $appointment->save();

        // Redireccionar de nuevo a la lista de citas con un mensaje de éxito
        return redirect()->route('appointments')->with('success', 'Cita confirmada correctamente.');
    }
}
