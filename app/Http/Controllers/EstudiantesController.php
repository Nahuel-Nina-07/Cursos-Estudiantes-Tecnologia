<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiantes;
use App\Models\Cursos;
use App\Models\EstudianteCursos;

class EstudiantesController extends Controller
{
    public function estudiantesQuintoGrado()
    {
        $estudiantesQuintoGrado = Estudiantes::whereHas('cursos', function ($query) {
            $query->where('Grado', 5);
        })->get();

        return response()->json($estudiantesQuintoGrado);
    }

    public function estudiantesConGrado()
    {
        $estudiantesConGrado = Estudiantes::with('cursos')->get();

        return response()->json($estudiantesConGrado);
    }

    public function estudiantesSextoGrado()
    {
        $estudiantesSextoGrado = Estudiantes::whereHas('cursos', function ($query) {
            $query->where('Grado', 5);
        })->take(5)->get();

        return response()->json($estudiantesSextoGrado);
    }

    public function guardarEstudianteConCurso(Request $request)
    {
        // Validación de los datos ingresados
        $request->validate([
            'CI' => 'required|integer',
            'Nombre' => 'required|string',
            'Grado' => 'required|integer',
        ]);

        // Crear el estudiante
        $estudiante = Estudiantes::create([
            'CI' => $request->CI,
            'Nombre' => $request->Nombre,
        ]);

        // Buscar el curso correspondiente
        $curso = Cursos::where('Grado', $request->Grado)->first();

        if (!$curso) {
            return response()->json(['message' => 'No se encontró un curso correspondiente.'], 404);
        }

        // Asociar el estudiante al curso
        $estudiante->cursos()->attach($curso);

        return response()->json(['message' => 'Estudiante guardado con éxito.']);
    }

    public function crearEstudianteYAgregarACurso(Request $request) 
    {
        $estudiante = Estudiantes::create([
            'CI' => $request->input('CI'),
            'Nombre' => $request->input('Nombre'),
        ]);
    
        $curso = Cursos::find($request->input('curso_id'));
    
        if (!$curso) {
            $estudiante->delete(); // Elimina el estudiante creado si el curso no se encuentra
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
    
        $curso->estudiantes()->attach($estudiante);
    
        return response()->json(['message' => 'Estudiante creado y agregado al curso exitosamente'], 201);
    }
    public function agregarEstudianteACurso(Request $request)
    {
        // Valida los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string',
            'ci' => 'required|integer',
            'grado' => 'required|integer',
        ]);

        // Busca el curso por su grado
        $curso = Cursos::where('grado', $request->grado)->first();

        // Si el curso no existe, crea uno nuevo
        if (!$curso) {
            $curso = Cursos::create([
                'grado' => $request->grado,
                'descripcion' => 'Descripción del curso', // Agrega una descripción si es necesario
            ]);
        }

        // Crea un nuevo estudiante
        $estudiante = Estudiantes::create([
            'nombre' => $request->nombre,
            'ci' => $request->ci,
        ]);

        // Asocia el estudiante al curso
        $curso->estudiantes()->attach($estudiante);

        return response()->json(['message' => 'Estudiante agregado al curso con éxito'], 200);
    }

    public function estudiantesCIDescendente()
    {
        $estudiantesConGrado = Estudiantes::orderBy('CI', 'desc') // Ordena por CI en forma descendente
        ->select('CI', 'Nombre') // Selecciona los campos CI y Nombre
        ->get();

        return response()->json($estudiantesConGrado);
    }
}
