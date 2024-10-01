<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('login');
    }

    // Maneja la autenticación del usuario
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Aquí defines el usuario permitido
        $allowedEmail = 'eriksuarez@gmail.com'; // Cambia esto al email del usuario permitido
        $allowedPassword = 'erik@2024'; // Cambia esto a la contraseña del usuario permitido

        // Verificar las credenciales
        if ($request->email === $allowedEmail && $request->password === $allowedPassword) {
            // Autenticación exitosa
            Auth::loginUsingId(1); // Asumiendo que el usuario tiene ID 1
            return redirect()->route('home'); // Redirigir a la página de inicio
        }

        // Si las credenciales son incorrectas
        return back()->withErrors(['email' => 'Las credenciales proporcionadas son incorrectas.']);
    }

    // Maneja el cierre de sesión
    public function logout()
    {
        Auth::logout();
        return redirect('login'); // Cambia esto a la ruta deseada tras cerrar sesión
    }
}
