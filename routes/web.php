<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

// Ruta para la página de inicio
Route::get('/', [MenuController::class, 'index'])->name('welcome');

// Rutas para el menú
Route::get('/servicios', [MenuController::class, 'servicios'])->name('servicios');
Route::get('/acerca', [MenuController::class, 'acerca'])->name('acerca');

// Rutas para el inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para la página de inicio (home)
Route::get('/home', [ServiceController::class, 'index'])->name('home');

// Rutas para gestionar barberos
Route::get('/add-barber', [BarberController::class, 'create'])->name('add_barber');
Route::post('/save-barber', [BarberController::class, 'store'])->name('barbers.store');
Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy');
Route::get('/acerca', [BarberController::class, 'about'])->name('acerca');

// Rutas para gestionar servicios
Route::post('/save-service', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


// Definición de rutas
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
Route::post('/crear-citas-en-blanco', [AppointmentController::class, 'crearCitasEnBlanco'])->name('crearCitasEnBlanco');
Route::post('/editar-cita', [AppointmentController::class, 'actualizarCita'])->name('actualizarCita');
use App\Http\Controllers\CitaController;
Route::post('/appointments/{id}/cancel', [CitaController::class, 'cancel'])->name('appointments.cancel');
Route::get('/appointments', [CitaController::class, 'index'])->name('appointments');
Route::post('/appointments/confirm/{id}', [CitaController::class, 'confirm'])->name('appointments.confirm');
Route::get('/confirmed-appointments', [CitaController::class, 'showConfirmedAppointments'])->name('confirmed.appointments');
