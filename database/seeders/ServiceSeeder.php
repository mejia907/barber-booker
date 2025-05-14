<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías por nombre
        $barberia = Category::where('name', 'Barbería')->firstOrFail();
        $unas = Category::where('name', 'Uñas')->firstOrFail();
        $spa = Category::where('name', 'Spa')->firstOrFail();

        // Servicios de Barbería 
        $barberia->services()->createMany([
            [
                'name' => 'Corte de cabello',
                'description' => 'Corte profesional con tijera y máquina',
                'price' => 180.00,
                'duration' => 30, // minutos
            ],
            [
                'name' => 'Arreglo de barba',
                'description' => 'Perfilado y arreglo de barba con navaja',
                'price' => 120.00,
                'duration' => 20, // minutos
            ],
            [
                'name' => 'Corte + Barba',
                'description' => 'Combo completo de corte y arreglo de barba',
                'price' => 250.00,
                'duration' => 45, // minutos
            ],
        ]);

        // Servicios de Uñas (más específicos)
        $unas->services()->createMany([
            [
                'name' => 'Manicure básico',
                'description' => 'Limpieza, corte y esmaltado básico',
                'price' => 150.00,
                'duration' => 40,// minutos
            ],
            [
                'name' => 'Pedicure spa',
                'description' => 'Tratamiento completo para pies con exfoliación',
                'price' => 200.00,
                'duration' => 50,// minutos
            ],
            [
                'name' => 'Uñas acrílicas',
                'description' => 'Colocación de uñas acrílicas con diseño',
                'price' => 350.00,
                'duration' => 90,// minutos
            ],
        ]);

        // Servicios de Spa (corregidos para ser únicos)
        $spa->services()->createMany([
            [
                'name' => 'Masaje relajante',
                'description' => 'Sesión de 30 minutos de masaje descontracturante',
                'price' => 300.00,
                'duration' => 30,// minutos
            ],
            [
                'name' => 'Tratamiento facial',
                'description' => 'Limpieza facial profunda con productos premium',
                'price' => 280.00,
                'duration' => 45,// minutos
            ],
            [
                'name' => 'Día completo de spa',
                'description' => 'Paquete completo con todos los tratamientos',
                'price' => 800.00,
                'duration' => 180,// minutos
            ],
        ]);
    }
}
