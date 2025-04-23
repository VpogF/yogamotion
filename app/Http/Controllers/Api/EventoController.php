<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use App\Models\Usuario;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventoResource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $eventos = Evento::with('tipoPractica')->get();
        return EventoResource::collection($eventos);
    }
    public function obtenerEventoUsuario($usuario_id)
    {
        // Verifica que el usuario existe
        $usuario = Usuario::find($usuario_id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener los eventos asociados con el usuario y cargar las relaciones 'estado' y 'usuarios'
        $eventos = Evento::whereHas('usuarios', function (Builder $query) use ($usuario_id) {
            $query->where('usuario_id', '=', $usuario_id);
        })
            ->with(['usuarios', 'estado'])  // Cargar relación con usuarios y estado
            ->get();

        // Verificar si se encontraron eventos
        if ($eventos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron eventos para este usuario'], 200);
        }

        // Retornar los eventos
        return EventoResource::collection($eventos);
    }
    // {
    //     // Verifica que el usuario existe
    //     $usuario = Usuario::find($usuario_id);
    //     if (!$usuario) {
    //         return response()->json(['error' => 'Usuario no encontrado'], 404);
    //     }

    //     // Obtener los eventos asociados con el usuario
    //     $eventos = Evento::whereHas('usuarios', function (Builder $query) use ($usuario_id) {
    //         $query->where('usuario_id', '=', $usuario_id);
    //     })
    //         ->with('usuarios')  // Cargar relación con usuarios
    //         ->get();

    //     // Verificar si se encontraron eventos
    //     if ($eventos->isEmpty()) {
    //         return response()->json(['message' => 'No se encontraron eventos para este usuario'], 200);
    //     }

    //     // Retornar los eventos
    //     return EventoResource::collection($eventos);
    // }


    public function get()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        // Crear nuevo evento
        $evento = new Evento();
        $evento->nom_evento = $request->input('nom_evento');
        $evento->descripcion = $request->input('descripcion');
        $evento->duracion = $request->input('duracion');
        $evento->cupo = $request->input('cupo');
        $evento->precio = $request->input('precio');
        $evento->ubicacion = $request->input('ubicacion');
        $evento->tipo_evento_id = $request->input('tipo_evento_id');
        $evento->tipo_practica_id = $request->input('tipo_practica_id');
        $evento->estado_id = $request->input('estado_id');
        $evento->fecha_evento = $request->input('fecha_evento');
        $evento->usuario_id = $request->input('usuario_id'); // 👈 Se guarda directamente en la tabla eventos

        try {
            // Guardar el evento
            $evento->save();

            // Retornar el evento como recurso
            $response = (new EventoResource($evento))
                ->response()
                ->setStatusCode(201);

        } catch (QueryException $ex) {
            $mensaje = 'Error al insertar el evento';
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
{
    try {
        $evento->usuarios()->detach(); // si hay relación con usuarios
        $evento->delete();

        return response()->json(['mensaje' => 'Evento eliminado correctamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al eliminar el evento: ' . $e->getMessage()], 500);
    }
}
}
