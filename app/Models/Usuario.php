<?php

namespace App\Models;

use App\Models\Evento;
use App\Models\TipoUsuario;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;


    //parte n

    /**
     * Get the user that owns the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_usuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    public function org_eventos()
    {
        return $this->hasMany(Evento::class, 'usuario_id');
    }

    /**
     * The roles that belong to the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eventos()
    {
        return $this->belongsToMany(
        Evento::class,
        'usuario_has_evento',
        'usuario_id',
        'evento_id'
        )->withPivot('fecha');
    }
}
