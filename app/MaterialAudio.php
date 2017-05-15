<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialAudio extends Model
{
    protected  $primaryKey = 'IDMAudio';
    protected  $table = 'material_audio';
    protected $fillable = [
        'id_Subtema',
        'ubica',
        'descarga'
    ];
}
