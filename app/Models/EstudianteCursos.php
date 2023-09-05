<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteCursos extends Model
{
    use HasFactory;
    protected $table = 'estudiantes_cursos';

    protected $fillable = ['estudiante_id', 'curso_id'];
}
