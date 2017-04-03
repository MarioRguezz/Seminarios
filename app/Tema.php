<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $primaryKey = "IDex";
    protected $table = "curso_tema";
    protected $fillable = [
        "IDex",
        "id_Curso",
        "id_Tema",
        "Nombre",
        "fecha"
    ];

    public function examen() {
        return $this->hasOne("App\Examen", "id_Tema", "id_Tema");
    }
}
