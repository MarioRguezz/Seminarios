<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{


    protected $table = "durango.usuario";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Mat_Usuario",
        "email",
        "cargo",
        "titular",
        "rol",
        "tipoinstructor",
        "semblanza",
        "curriculum",
        "procedencia",
        "estatus",
        "id_cliente_administrador"
    ];

    public function clienteAdministrador() {
        return $this->belongsTo('App\ClienteAdministrador', 'id_cliente_administrador', 'id');
    }
}
