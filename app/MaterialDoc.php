<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialDoc extends Model
{
    protected  $primaryKey = 'IDMDoc';
    protected  $table = 'material_doc';
    protected $fillable = [
        'id_Subtema',
        'ubica',
        'descarga'
    ];
}
