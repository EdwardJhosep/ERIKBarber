<?php

namespace App\Http\Controllers;

use App\Models\Service; 
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;
class AppointmentController extends Controller
{
    public function index()
    {
        // Obtener solo las citas pendientes, incluyendo el servicio relacionado
        $appointments = Appointment::with('service')
            ->where('appointment_type', 'pendiente') // Filtrar solo citas pendientes
            ->get();

        // Pasar las citas a la vista
        return view('appointments', compact('appointments'));
    }

    public function update(Request $request, $id)
    {
        // Encontrar la cita por ID
        $appointment = Appointment::findOrFail($id);

        // Actualizar el tipo de cita a "terminada"
        $appointment->appointment_type = 'terminada';        
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita marcada como terminada.');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'dni' => 'required|string|max:255',
            'appointment_date' => 'required|date', // Validar la fecha
            'appointment_time' => 'required|date_format:H:i', // Validar la hora
            'service_id' => 'required|exists:services,id',
        ]);
    
        // Combinar la fecha y la hora
        $appointmentDateTime = $request->appointment_date . ' ' . $request->appointment_time;
    
        // Asegurarse de que la fecha y hora están en el formato correcto
        $appointmentDateTime = Carbon::createFromFormat('Y-m-d H:i', $appointmentDateTime);
    
        // Verificar si ya existe una cita para el mismo DNI
        if (Appointment::where('dni', $request->dni)
            ->where('appointment_type', 'pendiente')
            ->exists()) {
            return redirect()->route('servicios')->with('error', 'Ya existe una cita pendiente para este DNI.');
        }
    
        // Obtener la hora completa de la cita
        $hourStart = $appointmentDateTime->copy()->startOfHour(); // Inicio de la hora
        $hourEnd = $hourStart->copy()->addHour(); // Fin de la hora
    
        // Contar citas en el rango de esta hora
        $countAtSameHour = Appointment::where('appointment_time', '>=', $hourStart)
            ->where('appointment_time', '<', $hourEnd)
            ->where('appointment_type', 'pendiente')
            ->count();
    
        // Verificar si ya hay 2 citas en esta hora
        if ($countAtSameHour >= 2) {
            // Si ya hay 2 citas en esta hora, no permitir la creación
            return redirect()->route('servicios')->with('error', 'Solo se permiten dos citas por hora.');
        }
    
        // Verificar si hay otra cita para el mismo servicio en un rango de dos horas
        $twoHoursLater = $appointmentDateTime->copy()->addHours(2);
        if (Appointment::where('service_id', $request->service_id)
            ->where('appointment_time', '>=', $appointmentDateTime)
            ->where('appointment_time', '<=', $twoHoursLater)
            ->where('appointment_type', 'pendiente')
            ->exists()) {
            return redirect()->route('servicios')->with('error', 'Solo se permite una cita para este servicio cada dos horas selcione otra hora por favor.');
        }
    
        // Crear una nueva cita
        try {
            $appointment = new Appointment();
            $appointment->dni = $request->dni;
            $appointment->appointment_time = $appointmentDateTime; // Usar Carbon para combinar
            $appointment->service_id = $request->service_id;
            $appointment->appointment_type = 'pendiente';
            $appointment->save();
    
            return redirect()->route('servicios')->with('success', 'Cita creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('servicios')->with('error', 'Error al crear la cita. Por favor, inténtalo de nuevo.');
        }
    }
    
    
    public function consult(Request $request)
    {
        $dni = $request->input('dni');
    
        // Realiza tu lógica para obtener la cita aquí
        $appointments = Appointment::where('dni', $dni)->get();
    
        // Obtén los servicios
        $services = Service::all(); // Asegúrate de que el modelo Service esté correctamente importado
    
        return view('servicios', compact('services', 'appointments'));
    }
    
    

 
}
