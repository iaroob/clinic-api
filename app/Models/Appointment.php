<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'start_time',
        'end_time',
        'reason',
    ];

    // Relación: cita pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relación: cita pertenece a un dentista
    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    // Relación muchos a muchos: cita puede tener varios tratamientos
    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'appointment_treatment');
    }
}