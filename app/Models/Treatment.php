<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'base_price',
        'duration',
    ];

    // Relación muchos a muchos: un tratamiento puede estar en varias citas
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_treatment');
    }
}