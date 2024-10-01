<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    public function about()
{
    $barbers = Barber::all(); // Obtén todos los barberos
    return view('acerca', compact('barbers')); // Pasa la lista de barberos a la vista
}

    // Método para mostrar el formulario de agregar un barbero y la lista de barberos
    public function create()
    {
        $barbers = Barber::all(); // Obtiene todos los barberos
        return view('add_barber', compact('barbers')); // Pasa la lista a la vista
    }

    // Método para almacenar los datos del nuevo barbero
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Guardar el nuevo barbero
        $barber = new Barber();
        $barber->name = $request->input('name');
        $barber->specialty = $request->input('specialty');

        // Manejar la foto si se ha subido
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('barbers', 'public');
            $barber->photo = $path;
        }

        $barber->save();

        // Redirigir a la misma vista con un mensaje de éxito
        return redirect()->back()->with('success', 'Barbero agregado exitosamente.');
    }

    // Método para eliminar un barbero
    public function destroy($id)
{
    $barber = Barber::findOrFail($id);
    
    // Eliminar la foto del disco si existe
    if ($barber->photo) {
        // Obtener la ruta completa de la foto
        $photoPath = public_path('storage/' . $barber->photo);
        
        // Verificar si el archivo existe y eliminarlo
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }

    $barber->delete(); // Eliminar el barbero de la base de datos

    return redirect()->back()->with('success', 'Barbero eliminado exitosamente.');
}

}
