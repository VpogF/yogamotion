<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
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
        $eventos = Evento::whereHas('usuarios', function (Builder $query)use ($usuario_id) {
            $query->where('usuario_id', '=', $usuario_id);
        })->get();

        return EventoResource::collection($eventos);
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

        try {
            // Guardar el evento
            $evento->save();

            // Asociar usuario al evento (usando attach)
            if ($request->has('usuario_id')) {
                $evento->usuarios()->attach($request->input('usuario_id'), attributes: ['fecha' => now()]);
            }

            // Retornar el evento como recurso
            $response = (new EventoResource($evento))
                ->response()
                ->setStatusCode(201);

        } catch (QueryException $ex) {
            $mensaje = 'Error al insertar el evento';
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;

        // $evento = new Evento();

        // $evento->nom_evento = $request->input('nom_evento');
        // $evento->descripcion = $request->input('descripcion');
        // $evento->duracion = $request->input('duracion');
        // $evento->cupo = $request->input('cupo');
        // $evento->precio = $request->input('precio');
        // $evento->ubicacion = $request->input('ubicacion');
        // $evento->tipo_evento_id = $request->input('tipo_evento_id');
        // $evento->tipo_practica_id = $request->input('tipo_practica_id');
        // $evento->estado_id = $request->input('estado_id');


        // try
        // {
        //     $evento->save();
        //     $response = (new EventoResource($evento))
        //                 ->response()
        //                 ->setStatusCode(201);

        // } catch (QueryException $ex)
        // {
        //     $mensaje = 'Error al insertar el evento';
        //     $response = \response()
        //                 ->json(['error' => $mensaje], 400);
        // }

        // return $response;

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
        //
    }

    // public function obtenerEventosPorUsuario($usuarioId)
    // {

    //     // Obtener eventos donde el usuario_id coincide con el ID proporcionado
    //     $eventos = Evento::where('usuario_id', $usuarioId)->with('tipoPractica')->get();

    //     // Devolver los eventos en un formato adecuado con el recurso
    //     return EventoResource::collection($eventos);
    // }
}
