<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom_evento' => $this->nom_evento,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion,
            'duracion' => $this->duracion,
            'cupo' => $this->cupo,
            'precio' => $this->precio,

            // Relación con Tipo de Práctica
            'tipo_practica' => $this->tipoPractica ? [
                'id' => $this->tipoPractica->id,
                'nom_practica' => $this->tipoPractica->nom_practica
            ] : null,

            // Relación con Estado del Evento
            'estado' => $this->estado ? [
                'id' => $this->estado->id,
                'nombre' => $this->estado->nombre
            ] : null,

            // Relación con Tipo de Evento
            'tipo_evento' => $this->tipoEvento ? [
                'id' => $this->tipoEvento->id,
                'nombre' => $this->tipoEvento->nombre
            ] : null,

            // Relación con Usuario Organizador
            'usuarios' => $this->usuarios->map(function ($usuario) {
                return [
                    'id' => $usuario->id,
                    'nombre' => $usuario->nombre,
                    'email' => $usuario->email
                ];
            }),
        ];



        // return [
        //     'id' => $this->id,
        //     'nom_evento' => $this->nom_evento,
        //     'descripcion' => $this->descripcion,
        //     'ubicacion' => $this->ubicacion,
        //     'duracion' => $this->duracion,
        //     'cupo' => $this->cupo,
        //     'precio' => $this->precio,
        //     // Relación tipoPractica
        //     'tipo_practica' => [
        //         'id' => $this->tipoPractica->id,
        //         'nom_practica' => $this->tipoPractica->nom_practica,
        //     ],
        //     'usuario_organizador' => $this->usuarios()->first() ? [
        //         'id' => $this->usuarios()->first()->id,
        //         'nombre' => $this->usuarios()->first()->nombre,
        //         'email' => $this->usuarios()->first()->email,
        //     ] : null,
        // ];
        // return parent::toArray($request);
    }
}
