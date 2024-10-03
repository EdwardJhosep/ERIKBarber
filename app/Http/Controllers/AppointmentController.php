<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    public function crearCitasEnBlanco(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date', // Validar que se recibe una fecha válida
        ]);

        $fechaSeleccionada = $request->input('fecha'); // Recibe la fecha del formulario
        $fecha = Carbon::parse($fechaSeleccionada);

        // Hora de inicio y fin
        $horaInicio = 9; // 9 AM
        $horaFin = 21; // 9 PM

        // Crear citas en blanco si no existen
        for ($hora = $horaInicio; $hora < $horaFin; $hora++) {
            for ($i = 1; $i <= 2; $i++) {
                $existeCita = Appointment::where('appointment_date', $fecha->toDateString())
                    ->where('appointment_time', "{$hora}:00:00")
                    ->count();

                if ($existeCita < 2) { 
                    Appointment::create([
                        'phone_number' => '',
                        'appointment_date' => $fecha->toDateString(),
                        'appointment_time' => "{$hora}:00:00",
                        'appointment_type' => '',
                        'status' => 'libre',
                        'fotopagocita' => null,
                    ]);
                }
            }
        }

        // Obtener todas las citas para la fecha seleccionada
        $citas = Appointment::where('appointment_date', $fecha->toDateString())->get();

        // Devolver la vista con las citas
        return view('welcome', ['citas' => $citas, 'fecha' => $fechaSeleccionada]);
    }

    public function actualizarCita(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'cita_id' => 'required|integer|exists:appointments,id',
            'phone_number' => 'nullable|string|max:255',
            'fotopagocita' => 'nullable|image|max:2048', // Ajusta el tamaño máximo según sea necesario
        ]);
    
        // Buscar la cita por ID
        $cita = Appointment::find($request->input('cita_id'));
    
        // Actualizar los campos de la cita
        if ($request->filled('phone_number')) {
            $cita->phone_number = $request->input('phone_number');
        }
    
        // Manejar la carga de la imagen de pago
        if ($request->hasFile('fotopagocita')) {
            // Almacenar la nueva imagen en la carpeta public/pagos
            $ruta = $request->file('fotopagocita')->store('pagos', 'public'); // Almacena la imagen en public/pagos
            $cita->fotopagocita = $ruta; // Guarda la ruta relativa en la base de datos
        }
    
        // Cambiar el estado a "pendiente"
        $cita->status = 'pendiente';
    
        // Verificar si hay citas pendientes con el mismo número de teléfono
        $existePendiente = Appointment::where('phone_number', $cita->phone_number)
            ->where('status', 'pendiente')
            ->exists();
    
        if ($existePendiente) {
            // Si hay una cita pendiente, redirigir con un mensaje de error
            return redirect()->route('welcome')->with('error', 'Tienes citas pendidntes para este numero.');
        }
    
        // Si la cita anterior estaba confirmada, permitir la creación de nuevas citas en blanco
        if ($cita->status === 'confirmado') {
            $this->crearCitasEnBlanco(new Request(['fecha' => $cita->appointment_date]));
        }
    
        // Guardar los cambios
        $cita->save();
    
        // Redirigir de nuevo a la vista de citas con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Cita Creada con éxito.');
    } 
}
