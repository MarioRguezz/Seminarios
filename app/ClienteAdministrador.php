<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteAdministrador extends Model
{

    protected $table = "durango.cliente_administrador";
    protected $fillable = [
        'codigo'
    ];
}
