<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cursos;


class Estudiantes extends Model
{
    use HasFactory;

    protected $fillable = ['ci', 'nombre'];

    public function cursos()
    {
        return $this->belongsToMany(Cursos::class, 'estudiantes_cursos', 'estudiante_id', 'curso_id');
    }
}
