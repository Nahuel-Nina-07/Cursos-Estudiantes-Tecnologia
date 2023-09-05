<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $materias = ['Materia 1', 'Materia 2', 'Materia 3', 'Materia 4', 'Materia 5', 'Materia 6'];

        for ($i = 1; $i <= 10; $i++) {
            DB::table("cursos")->insert([
                'grado' => rand(1, 6), // Grado aleatorio entre 1 y 6
                'descripcion' => $materias[array_rand($materias)],
            ]);
        }
    }
}
