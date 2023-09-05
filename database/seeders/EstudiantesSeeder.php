<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table("estudiantes")->insert([
                'ci' => rand(1000000, 9999999), 
                'nombre' => "Estudiante $i",
            ]);
        }
    }
}
