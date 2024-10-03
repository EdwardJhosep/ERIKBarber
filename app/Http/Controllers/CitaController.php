<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    public function showConfirmedAppointments() {
        $confirmedAppointments = Appointment::where('status', 'confirmado')->get();
        return view('citas_confirmadas', compact('confirmedAppointments'));
    }

    public function cancel($id)
    {
        // Buscar la cita por su ID
        $appointment = Appointment::findOrFail($id);
        
        // Verificar si existe una imagen de pago y eliminar el archivo físico
        if ($appointment->fotopagocita) {
            // Eliminar el archivo de la carpeta de pagos si existe
            Storage::disk('public')->delete($appointment->fotopagocita);
        }
    
        // Cambiar el estado de la cita a "libre", el número de teléfono a vacío y eliminar la foto de pago
        $appointment->status = 'libre';
        $appointment->phone_number = '';
        $appointment->fotopagocita = null; // Eliminar la referencia en la base de datos
        $appointment->save();
    
        // Redireccionar de nuevo a la lista de citas con un mensaje de éxito
        return redirect()->route('appointments')->with('success', 'Cita cancelada correctamente.');
    }
    

    
}
