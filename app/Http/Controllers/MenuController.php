<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Asegúrate de que este sea el modelo correcto

class MenuController extends Controller
{
    // Método para mostrar la página de inicio
    public function index()
    {
        return view('welcome'); // Asegúrate de tener una vista llamada 'inicio.blade.php'
    }

    // Método para mostrar la página de servicios
    public function servicios()
    {
        // Obtener todos los servicios de la base de datos
        $services = Service::all(); // Asegúrate de que el modelo 'Service' esté correctamente importado

        // Pasar los servicios a la vista
        return view('servicios', compact('services'));
    }
    // Método para mostrar la página de acerca de
    public function acerca()
    {
        return view('acerca'); // Asegúrate de tener una vista llamada 'acerca.blade.php'
    }


}