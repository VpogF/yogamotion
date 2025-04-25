<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;



    /**
     * The roles that belong to the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_has_evento',
            'evento_id',
            'usuario_id'
        )->withPivot('fecha');
    }

    public function organizador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }


    /**
     * Get the tipoPractica that owns the Evento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoPractica()
    {
        return $this->belongsTo(TipoPractica::class, 'tipo_practica_id');
    }

    /**
     * Get the user that owns the Evento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class, 'tipo_evento_id');
    }

    /**
     * Get the user that owns the Evento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
