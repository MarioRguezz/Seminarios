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

    public function materialdoc() {
        return $this->hasMany("App\MaterialDoc", 'id_Subtema', 'id_Subtema');
    }

    public function materialaudio() {
        return $this->hasMany("App\MaterialAudio", 'id_Subtema', 'id_Subtema');
    }

    public function materialvideo() {
        return $this->hasMany("App\MaterialVideo", 'id_Subtema', 'id_Subtema');
    }

    public function tema() {
        return $this->belongsTo('App\Tema', 'id_Tema', 'id_Tema');
    }


  /*  public function  subtemavisto() {
        return $this->belongsToMany('App\Tema','byondb.subtema_visto','id_Subtema', 'id_Tema')->withPivot('Visto');
    }*/
}
