<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TipoPracticaResource;
use App\Models\TipoPractica;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoPracticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoPractica = TipoPractica::all();
        return TipoPracticaResource::collection($tipoPractica);
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
    public function show(TipoPractica $tipoPractica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoPractica $tipoPractica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoPractica $tipoPractica)
    {
        //
    }
}
