<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteAdministrador extends Model
{

    protected $table = "cliente_administrador";
    protected $fillable = [
        'id_persona',
        'codigo',
        'fecha_expiracion',
        'no_licencias'
    ];


    public function instructores() {
        return $this->hasMany('App\Instructor', 'id_cliente_administrador', 'id');
    }

    public function alumnos() {
        return $this->hasMany('App\Alumno', 'id_cliente_administrador', 'id');
    }

    public function datos(){
        return $this->hasOne('App\Persona','IdPersona','id_persona');
    }
}
