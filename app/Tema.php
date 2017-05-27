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
        return $this->hasOne("App\Examen", "id_Tema", "id_Tema")
            ->with('preguntas');
    }

    public function subtemas() {
        return $this->hasMany('App\Subtema', 'id_Tema', 'id_Tema')
            ->with('materialaudio')
            ->with('materialdoc')
            ->with('materialvideo')
            ->orderBy('Orden');
    }
        public function Curso() {
            return $this->belongsTo('App\Curso', 'id_Curso');
        }
}
