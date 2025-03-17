<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EventoResource;
use App\Models\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::all();
        return EventoResource::collection($eventos);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $evento = new Evento();

        $evento->nom_evento = $request->input('nom_evento');
        $evento->descripcion = $request->input('descripcion');
        $evento->duracion = $request->input('duracion');
        $evento->cupo = $request->input('cupo');
        $evento->ubicacion = $request->input('ubicacion');
        $evento->tipo_evento_id = $request->input('tipo_evento_id');
        $evento->tipo_practica_id = $request->input('tipo_practica_id');
        $evento->estado_id = $request->input('estado_id');


        try
        {
            $evento->save();
            $response = (new EventoResource($evento))
                        ->response()
                        ->setStatusCode(201);

        } catch (QueryException $ex)
        {
            $mensaje = 'Error al insertar el evento';
            $response = \response()
                        ->json(['error' => $mensaje], 400);
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
        //
    }
}
