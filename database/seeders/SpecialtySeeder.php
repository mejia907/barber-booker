<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialty::create([
            'name' => 'Barbero',
            'description' => 'Especialista en cortes de cabello',
        ]);

        Specialty::create([
            'name' => 'Manicurista',
            'description' => 'Especialista en cuidado de las uñas',
        ]);
    }
}
