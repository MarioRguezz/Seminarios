<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SubtemaVisto extends Model
{

    protected $table = 'durango.subtema_visto';
    protected $fillable = ['id_Curso', 'id_Tema','id_Subtema', 'Mat_Amuno', 'Visto','Orden'];
    protected $primaryKey = 'Idexo';

}
