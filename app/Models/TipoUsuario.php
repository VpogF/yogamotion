<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuario';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

   //parte 1

   /**
    * Get all of the comments for the TipoUsuario
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function usuario()
   {
       return $this->hasMany(Usuario::class, 'tipo_usuario_id');
   }
}
