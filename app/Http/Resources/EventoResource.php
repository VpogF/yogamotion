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
            // Relación tipoPractica
            'tipo_practica' => [
                'id' => $this->tipoPractica->id,
                'nom_practica' => $this->tipoPractica->nom_practica,
            ],
        ];
        // return parent::toArray($request);
    }
}
