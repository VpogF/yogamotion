<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TipoUsuarioResource;
use App\Models\TipoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos_usuario = TipoUsuario::all();
        return TipoUsuarioResource::collection($tipos_usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        //
    }
}
