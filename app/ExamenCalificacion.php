<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenCalificacion extends Model
{
    protected $primaryKey = "Indexs1";
    protected $table = "examen_alumno";
    protected $fillable =[
        "Indexs1",
        "ID_Examen",
        "Mat_Alumno",
        "id_Tema",
        "Calificacion",
        "Fecha"
    ];
}
