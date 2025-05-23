<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EstadoController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\TipoEventoController;
use App\Http\Controllers\Api\TipoUsuarioController;
use App\Http\Controllers\Api\TipoPracticaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('usuario', UsuarioController::class);
Route::apiResource('tipousuario', TipoUsuarioController::class);
Route::apiResource('evento', EventoController::class);
Route::get('/usuario/{usuario_id}/eventos', [EventoController::class, 'obtenerEventoUsuario']);
Route::get('/usuario/{usuario_id}/miseventos', [EventoController::class, 'obtenerMisEventos'])-> name('perfil');
Route::apiResource('tipoevento', TipoEventoController::class);
Route::apiResource('estado', EstadoController::class);
Route::apiResource('tipopractica', TipoPracticaController::class);
Route::post('/evento/{eventoId}/apuntarse', [EventoController::class, 'apuntarse'])->name('evento.apuntarse');
Route::post('/evento/{eventoId}/desapuntarse', [EventoController::class, 'desapuntarse']);


