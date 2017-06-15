<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alumno extends Model
{

    protected $table = 'byondb.alumno';

    protected $primaryKey = 'Mat_Alumno';

    protected $fillable = [
        'Id', 'Mat_Alumno', 'fotografia','profesion','institucion','adscripcion','email','constancia','estatus', 'id_cliente_administrador', 'IdPersona'];


    public function cursos() {
        return $this->belongsToMany('App\Curso', 'byondb.curso_participante', 'Mat_Alumno', 'id_Curso');
    }

    public function datos()
    {
        return $this->hasOne('App\Persona','email','email');
    }

    public function clienteAdministrador() {
        return $this->belongsTo('App\ClienteAdministrador', 'id_cliente_administrador', 'id');
    }

}
