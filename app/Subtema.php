<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtema extends Model
{
    protected $primaryKey = "IDes";
    protected $table = "curso_subtema";
    protected $fillable = [
        "id_Curso",
        "id_Tema",
        "id_Subtema",
        "Nombre",
        "Descrip",
        "Orden"
    ];

    public function examen() {
        return $this->hasOne("App\Examen", "id_Subtema", "IDes");
    }
}
