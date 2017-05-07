<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Curso extends Model
{

    protected $table = 'durango.curso';
    protected $fillable = [ 'id_Curso', 'nombre', 'estatus'];


    protected $primaryKey = 'id_Curso';
/*
    public function persona(){
        return $this->belongsTo("App\Persona")->select(array(
            'IdPersona','Nombre', 'email'
        ));
    }*/

    public function temas() {
        return $this->hasMany('App\Tema', 'id_Curso');
    }

}
