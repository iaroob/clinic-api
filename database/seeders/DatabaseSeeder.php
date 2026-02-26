<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dentist;
use App\Models\Treatment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
    }
}
