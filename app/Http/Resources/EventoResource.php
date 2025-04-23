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
            'fecha_evento' => $this->fecha_evento,

            // Relación con Tipo de Práctica
            'tipo_practica' => $this->tipoPractica ? [
                'id' => $this->tipoPractica->id,
                'nom_practica' => $this->tipoPractica->nom_practica
            ] : null,

            // Relación con Estado del Evento
            'estado' => $this->estado ? [
                'id' => $this->estado->id,
                'nombre' => $this->estado->estado
            ] : null,

            // Relación con Tipo de Evento
            'tipo_evento' => $this->tipoEvento ? [
                'id' => $this->tipoEvento->id,
                'nombre' => $this->tipoEvento->nombre
            ] : null,

            // Relación con Usuario Organizador
            'usuarios' => $this->whenLoaded('usuarios', function () {
                return $this->usuarios->map(function ($usuario) {
                    return [
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'email' => $usuario->email
                    ];
                });
            }),
        ];
    }
}
