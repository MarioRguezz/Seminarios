<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alumno extends Model
{

    protected $table = 'durango.alumno';

    protected $fillable = [
        'Id', 'Mat_Alumno', 'fotografia','profesion','institucion','adscripcion','email','constancia','estatus'];



}
