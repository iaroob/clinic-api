<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dentist;
use App\Models\Treatment;
use App\Models\Patient;    
use App\Models\Appointment;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario recepcionista
        User::create([
            'name' => 'Recepcionista',
            'email' => 'recepcionista@pruebasmulhacen.com',
            'password' => Hash::make('0dHGgfh49v'),
        ]);

        // Dentistas
        Dentist::insert([
            ['first_name' => 'Roberto', 'last_name' => 'García López', 'specialty' => 'Ortodoncia'],
            ['first_name' => 'Antonio', 'last_name' => 'Sánchez Castro', 'specialty' => 'Ortodoncia, Prótesis, Diagnosis'],
            ['first_name' => 'Miguel', 'last_name' => 'Díaz Romero', 'specialty' => 'Cirugía, General'],
            ['first_name' => 'Juan', 'last_name' => 'Torres Navarro', 'specialty' => 'Todas'],
        ]);

        // Tratamientos
        Treatment::insert([
            ['name' => 'Brackets', 'specialty' => 'Ortodoncia', 'base_price' => 3999.95, 'duration' => 45],
            ['name' => 'Composite', 'specialty' => 'Prótesis', 'base_price' => 680, 'duration' => 60],
            ['name' => 'Exp. Maxilar', 'specialty' => 'Cirugía', 'base_price' => 9000, 'duration' => 120],
            ['name' => 'Radiografía panorámica', 'specialty' => 'Diagnosis', 'base_price' => 50, 'duration' => 10],
            ['name' => 'Blanqueamiento', 'specialty' => 'General', 'base_price' => 199.62, 'duration' => 20],
        ]);

        // Pacientes
        Patient::insert([
            ['first_name' => 'Laura', 'last_name' => 'Martínez', 'email' => 'laura@example.com', 'phone' => '600123456', 'note' => 'Paciente con brackets'],
            ['first_name' => 'Carlos', 'last_name' => 'Gómez', 'email' => 'carlos@example.com', 'phone' => '600987654', 'note' => 'Paciente para blanqueamiento'],
        ]);

        // Citas
        Appointment::create([
            'patient_id' => 1,
            'dentist_id' => 1,
            'start' => Carbon::parse('2026-03-01 10:00:00'),
            'end' => Carbon::parse('2026-03-01 10:45:00'),
            'reason' => 'Revisión inicial',
        ]);

        Appointment::create([
            'patient_id' => 2,
            'dentist_id' => 2,
            'start' => Carbon::parse('2026-03-01 11:00:00'),
            'end' => Carbon::parse('2026-03-01 11:20:00'),
            'reason' => 'Blanqueamiento dental',
        ]);

        // Relación citas-tratamientos
        DB::table('appointment_treatment')->insert([
            ['appointment_id' => 1, 'treatment_id' => 1], // Brackets
            ['appointment_id' => 2, 'treatment_id' => 5], // Blanqueamiento
        ]);
    }
}