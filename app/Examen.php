<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $primaryKey = "Idesx";
    protected $table = "examen";
    protected $fillable = [
        "Idesx",
        "ID_Examen",
        "id_Tema",
        "id_Subtema"
    ];


    public function preguntas() {
        return $this->hasMany('App\Pregunta', 'ID_Examen', 'Idesx');
    }
}
