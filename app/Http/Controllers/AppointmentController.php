<?php

namespace App\Http\Controllers;

use App\Models\Appointment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    // Mostrar la lista de citas y el formulario para crear nuevas citas
    public function index()
    {  
        $appointments = Appointment::all(); // Obtener todas las citas
        return view('appointments', compact('appointments')); // Pasar las citas a la vista
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'phone_number' => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string', // Cambiar a 'string' en lugar de 'time'
            'appointment_type' => 'required|string',
            'fotopagocita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);
    
        // Manejar la carga de la foto del pago
        $photoPath = null;
        if ($request->hasFile('fotopagocita')) {
            $photoPath = $request->file('fotopagocita')->store('uploads', 'public'); // Almacenar la imagen
        }
    
        // Crear una nueva cita
        Appointment::create([
            'phone_number' => $request->phone_number,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'appointment_type' => $request->appointment_type,
            'fotopagocita' => $photoPath,
            'status' => 'pendiente', // Estado inicial de la cita
        ]);
    
        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('appointments.index')->with('success', 'Cita creada exitosamente.');
    }
    
}
