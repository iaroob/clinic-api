<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TreatmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí registramos todas las rutas de la API de la clínica dental.
| Rutas protegidas con Sanctum y rutas públicas (login).
|
*/

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren token)
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Info del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Pacientes
    Route::get('/patients', [PatientController::class, 'index']);       // Listar pacientes
    Route::post('/patients', [PatientController::class, 'store']);      // Crear paciente
    Route::get('/patients/{patient}', [PatientController::class, 'show']); // Ver paciente

    // Citas
    Route::get('/appointments', [AppointmentController::class, 'index']); // Listar citas (filtrar por día con ?date=YYYY-MM-DD)
    Route::post('/appointments', [AppointmentController::class, 'store']); // Crear cita
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']); // Ver cita

    // Tratamientos
    Route::get('/treatments', [TreatmentController::class, 'index']);   // Listar tratamientos
});