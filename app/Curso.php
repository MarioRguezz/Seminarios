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

    //muchos a muchos
    public function alumnos(){
            return $this->belongsToMany('App\Alumno','durango.curso_participante','id_Curso', 'Mat_Alumno')->withPivot('status');
        }



}
