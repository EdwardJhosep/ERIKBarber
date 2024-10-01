<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarberController;

// Ruta para la página de inicio
Route::get('/', [MenuController::class, 'index'])->name('welcome');

// Rutas para el menú

Route::get('/servicios', [MenuController::class, 'servicios'])->name('servicios');
Route::get('/acerca', [MenuController::class, 'acerca'])->name('acerca');
Route::get('/contacto', [MenuController::class, 'contacto'])->name('contacto');

// Rutas para el inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para la página de inicio (home)
Route::get('/home', function () {
    return view('home'); // Asegúrate de que 'home' es el nombre correcto de tu vista
})->name('home');


Route::get('/add-barber', function () {
    return view('add-barber'); // Crea esta vista para agregar barberos
});

Route::get('/appointments', function () {
    return view('appointments'); // Crea esta vista para ver citas
});


Route::get('/add-barber', [BarberController::class, 'create'])->name('add_barber');
Route::post('/save-barber', [BarberController::class, 'store'])->name('barbers.store');
Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy');
Route::get('/acerca', [BarberController::class, 'about'])->name('acerca');

use App\Http\Controllers\ServiceController;

Route::get('/home', [ServiceController::class, 'index'])->name('home');
Route::post('/save-service', [ServiceController::class, 'store']);
Route::get('/services/{id}/edit', [ServiceController::class, 'edit']);
Route::put('/services/{id}', [ServiceController::class, 'update']);
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
use App\Http\Controllers\AppointmentController;

// Rutas para citas
Route::get('/appointments', function () {
    return view('appointments'); // Asegúrate de que esta vista exista
})->name('appointments.index');

Route::get('/appointments/create/{service_id}', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');

Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::post('/appointments/consult', [AppointmentController::class, 'consult'])->name('appointments.consult');
