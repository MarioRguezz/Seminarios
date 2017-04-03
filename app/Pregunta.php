<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $primaryKey = "ID_Pregunta";
    protected $table = "pregunta";
    protected $fillable =[
        "ID_Pregunta",
        "tipo",
        "ID_Examen",
        "ID_Subtema",
        "json",
        "titulo"
    ];
}
