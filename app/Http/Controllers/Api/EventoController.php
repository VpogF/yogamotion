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
        $user = Auth::user(); // Asegurate de tener autenticación con Sanctum o similar
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $evento = Evento::findOrFail($eventoId);

        // Insertar en tabla intermedia con attach
        $user->eventos()->attach($evento->id, ['fecha' => now()]);

        return response()->json(['message' => 'Te has apuntado correctamente.']);
    }
}
