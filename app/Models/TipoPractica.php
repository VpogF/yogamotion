<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPractica extends Model
{
    use HasFactory;

    protected $table = 'tipo_practica';
    protected $primaryKey = 'id';
    public $incrementing = 'true';
    public $timestamps = 'false';


    /**
     * Get all of the comments for the TipoEvento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evento()
    {
        return $this->hasMany(Evento::class, 'tipo_practica_id');
    }
}
