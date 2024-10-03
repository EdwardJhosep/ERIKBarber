<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('appointment_date', Carbon::today())->get(); // Obtiene citas para hoy
        return view('appointments', compact('appointments')); // Pasa las citas a la vista
    }

    public function createBlankAppointments()
    {
        // Establece la fecha de inicio (hoy)
        $startDate = Carbon::today();
        $datesToCheck = [$startDate, $startDate->copy()->addDay()]; // Hoy y mañana

        // Verifica si ya existen citas para los días a crear
        $appointmentsExist = false;

        foreach ($datesToCheck as $date) {
            // Comprueba si ya existen citas para esa fecha
            if (Appointment::where('appointment_date', $date)->exists()) {
                $appointmentsExist = true;
                break; // Si existe al menos una cita, salimos del bucle
            }
        }

        // Si no hay citas existentes, procede a crear las citas en blanco
        if (!$appointmentsExist) {
            // Crea citas en blanco para hoy y mañana
            for ($i = 0; $i < 2; $i++) { // Solo dos días: hoy y mañana
                $date = $datesToCheck[$i]; // Calcula la fecha para hoy y mañana
                
                for ($hour = 9; $hour < 21; $hour++) { // De 9 AM a 9 PM
                    // Crea dos citas en blanco a la misma hora
                    $appointmentTime = Carbon::createFromTime($hour, 0, 0); // Ambas citas a la misma hora

                    // Verifica cuántas citas ya existen para esa fecha y hora
                    $exists = Appointment::where('appointment_date', $date)
                        ->where('appointment_time', $appointmentTime->toTimeString())
                        ->count(); // Contamos las citas que existen en esa fecha y hora
                    
                    // Crea las citas solo si hay menos de 2 citas
                    if ($exists < 2) { // Verifica si hay menos de 2 citas para esa hora
                        // Crea la primera cita
                        Appointment::create([
                            'phone_number' => '', // Dejar vacío
                            'appointment_date' => $date,
                            'appointment_time' => $appointmentTime->toTimeString(),
                            'appointment_type' => '', // Dejar vacío
                            'status' => 'pending', // Estado inicial
                            'fotopagocita' => null, // Dejar vacío
                        ]);

                        // Crea la segunda cita (la misma hora)
                        Appointment::create([
                            'phone_number' => '', // Dejar vacío
                            'appointment_date' => $date,
                            'appointment_time' => $appointmentTime->toTimeString(),
                            'appointment_type' => '', // Dejar vacío
                            'status' => 'pending', // Estado inicial
                            'fotopagocita' => null, // Dejar vacío
                        ]);
                    }
                }
            }

            return redirect()->route('appointments.index')->with('success', 'Citas en blanco creadas exitosamente.');
        } else {
            return redirect()->route('appointments.index')->with('info', 'Ya existen citas para hoy o mañana. No se crearon nuevas citas en blanco.');
        }
    }

    public function nextDay()
    {
        // Obtiene la fecha actual y le suma un día
        $nextDay = Carbon::today()->addDay();

        // Obtiene las citas para el día siguiente
        $appointments = Appointment::where('appointment_date', $nextDay)->get();

        // Pasa las citas del día siguiente a la vista
        return view('appointments', compact('appointments'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id); // Encuentra la cita por ID
        return view('edit_appointment', compact('appointment')); // Pasa la cita a la vista
    }

    // Método para actualizar la cita
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'fotopagocita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $appointment = Appointment::findOrFail($id); // Encuentra la cita por ID
        $appointment->phone_number = $request->input('phone_number'); // Actualiza el número de teléfono

        // Maneja la carga de la foto de pago
        if ($request->hasFile('fotopagocita')) {
            $path = $request->file('fotopagocita')->store('payment_photos', 'public');
            $appointment->fotopagocita = $path; // Actualiza la foto de pago
        }

        $appointment->status = 'pendiente'; // Cambia el estado a 'pendiente'
        $appointment->save(); // Guarda los cambios

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada exitosamente.');
    }
}
