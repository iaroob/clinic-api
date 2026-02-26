<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Legacy\Database;
use App\Legacy\AppointmentLegacy;

class AppointmentController extends Controller
{
    protected $legacy;

    public function __construct()
    {
        // Inicializamos el legacy
        $db = new Database();
        $this->legacy = new AppointmentLegacy($db);
    }

    /**
     * Listar citas por día
     * Usa query param ?date=YYYY-MM-DD
     */
    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));

        $appointments = $this->legacy->getByDate($date);

        return response()->json([
            'date' => $date,
            'appointments' => $appointments
        ], 200);
    }

    /**
     * Crear nueva cita usando el legacy
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|integer|exists:patients,id',
            'dentista_id' => 'required|integer|exists:dentists,id',
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'duracion' => 'nullable|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $result = $this->legacy->create($request->all());

        if ($result['status'] === 'success') {
            return response()->json([
                'message' => 'Cita creada correctamente',
                'appointment_id' => $result['appointment_id']
            ], 201);
        }

        return response()->json([
            'message' => $result['message']
        ], 400);
    }

    /**
     * Mostrar detalles de una cita
     */
    public function show($appointmentId)
    {
        $appointment = $this->legacy->getById($appointmentId);

        if (!$appointment) {
            return response()->json([
                'message' => 'Cita no encontrada'
            ], 404);
        }

        return response()->json([
            'appointment' => $appointment
        ], 200);
    }
}