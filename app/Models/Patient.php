<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'note',
    ];

    // Relación: un paciente tiene muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
