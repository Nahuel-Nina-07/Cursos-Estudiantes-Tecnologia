<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiantesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('estudiantes/ci-descendente', [EstudiantesController::class, 'estudiantesCIDescendente']);

Route::get('estudiantes/quinto-grado', [EstudiantesController::class, 'estudiantesQuintoGrado']);
Route::get('estudiantes', [EstudiantesController::class, 'estudiantesConGrado']);
Route::get('estudiantes/sexto-grado', [EstudiantesController::class, 'estudiantesSextoGrado']);
Route::post("/insertar", [EstudiantesController::class, "agregarEstudianteACurso"]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
