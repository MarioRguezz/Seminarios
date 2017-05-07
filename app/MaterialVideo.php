<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialVideo extends Model
{
    protected  $primaryKey = 'IDMVideo';
    protected  $table = 'material_video';
    protected $fillable = [
        'id_Subtema',
        'ubica',
        'descarga'
    ];
}
