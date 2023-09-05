<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstudiantesCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $estudiantesIds = DB::table('estudiantes')->pluck('id');
        $cursosIds = DB::table('cursos')->pluck('id');

        foreach ($estudiantesIds as $estudianteId) {
            $cursosAsignados = $cursosIds->random(rand(1, 6));

            foreach ($cursosAsignados as $cursoId) {
                DB::table("estudiantes_cursos")->insert([
                    'estudiante_id' => $estudianteId,
                    'curso_id' => $cursoId,
                ]);
            }
        }
    }
}
