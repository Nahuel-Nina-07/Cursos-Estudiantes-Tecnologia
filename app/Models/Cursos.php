<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $fillable = ['grado', 'descripcion'];

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiantes::class, 'estudiantes_cursos', 'curso_id', 'estudiante_id');
    }
}
