<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alumno extends Model
{

    protected $table = 'durango.alumno';

    protected $primaryKey = 'Mat_Alumno';

    protected $fillable = [
        'Id', 'Mat_Alumno', 'fotografia','profesion','institucion','adscripcion','email','constancia','estatus'];


    public function cursos() {
        return $this->belongsToMany('App\Curso', 'durango.curso_participante', 'Mat_Alumno', 'id_Curso');
    }

}
