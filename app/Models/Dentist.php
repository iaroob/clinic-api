<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty',
    ];

    // Relación: un dentista puede tener muchas citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}