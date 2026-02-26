<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Listar todos los pacientes
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->json([
            'message' => 'Listado de pacientes',
            'patients' => $patients
        ], 200);
    }

    /**
     * Crear un nuevo paciente
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:patients,email',
            'phone'      => 'required|string|max:20',
            'note'       => 'nullable|string',
        ]);

        // Crear paciente
        $patient = Patient::create($validated);

        return response()->json([
            'message' => 'Paciente creado correctamente',
            'patient' => $patient
        ], 201);
    }

    /**
     * Ver un paciente específico
     */
    public function show(Patient $patient)
    {
        return response()->json([
            'message' => 'Detalle del paciente',
            'patient' => $patient
        ], 200);
    }
}