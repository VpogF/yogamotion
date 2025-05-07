<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use App\Models\Usuario;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventoResource;
use App\Http\Resources\UsuarioResource;
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

        $usuario = Usuario::with(['org_eventos.estado', 'org_eventos.tipoPractica', 'org_eventos.tipoEvento'])->where('id', $usuario_id)->first();
        return new UsuarioResource($usuario);
    }
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
    public function show($id)
    {
        $evento = Evento::find($id);  // Buscar el evento por su ID

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json($evento, 200);  // Retornar el evento encontrado
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

    public function apuntarse(Request $request, $eventoId)
    {
        $usuarioId = $request->input('usuario_id');

        if (!$usuarioId) {
            return response()->json(['message' => 'Falta el ID del usuario'], 400);
        }

        $evento = Evento::find($eventoId);
        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        // Verifica si hay cupo disponible
        if ($evento->cupo <= 0) {
            return response()->json(['message' => 'No hay más cupo disponible'], 400);
        }

        // Busca el usuario
        $usuario = Usuario::find($usuarioId);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Verifica si ya está apuntado
        if ($usuario->eventos()->where('evento_id', $eventoId)->exists()) {
            return response()->json(['message' => 'Ya estás apuntado'], 400);
        }

        // Inserta en la tabla intermedia con la fecha actual
        $usuario->eventos()->attach($eventoId, ['fecha' => now()]);

        // Disminuye el cupo
        $evento->cupo -= 1;
        $evento->save();

        return response()->json(['message' => 'Apuntado correctamente']);
    }


    public function desapuntarse($eventoId, Request $request)
    {
        $usuarioId = $request->usuario_id;

        // Obtener al usuario
        $usuario = Usuario::find($usuarioId);

        // Verificar si el usuario existe
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        // Verificar si el usuario está apuntado a este evento
        $evento = Evento::find($eventoId);

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado.'], 404);
        }

        // Desapuntar al usuario del evento (usamos detach)
        $usuario->eventos()->detach($eventoId);

        // Aumentar el cupo
        $evento->cupo += 1;
        $evento->save();

        return response()->json(['message' => 'Desapuntado del evento correctamente.']);
    }



    public function obtenerMisEventos($usuario_id)
    {
        $usuario = Usuario::with('eventos')->findOrFail($usuario_id);
        return EventoResource::collection($usuario->eventos);
    }

}
