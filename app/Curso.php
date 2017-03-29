<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Curso extends Model
{

    protected $table = 'durango.curso_participante';
    protected $fillable = [
        'Ide', 'id_Curso', 'Mat_Alumno','status'];


    protected $primaryKey = 'Ide';
/*
    public function persona(){
        return $this->belongsTo("App\Persona")->select(array(
            'IdPersona','Nombre', 'email'
        ));
    }*/



}
