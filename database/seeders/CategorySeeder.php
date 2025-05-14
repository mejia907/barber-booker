<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Barbería',
            'description' => 'Barbería',
            'color' => '#1E40AF'
        ]);

        Category::create([
            'name' => 'Uñas',
            'description' => 'Uñas',
            'color' => '#D946EF'
        ]);

        Category::create([
            'name' => 'Spa',
            'description' => 'Cuidado Personal',
            'color' => '#10B981'
        ]);
    }
}
