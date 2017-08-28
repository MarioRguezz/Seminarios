<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SubtemaVisto extends Model
{

    protected $table = 'subtema_visto';
    protected $fillable = ['id_Curso', 'id_Tema','id_Subtema', 'Mat_Alumno', 'Visto','Orden'];
    protected $primaryKey = 'Idexo';

}
