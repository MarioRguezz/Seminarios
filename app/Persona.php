<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Persona extends Model
{

    protected $table = 'persona';
    use SoftDeletes;

    protected $fillable = [
        'IdPersona', 'APaterno', 'AMaterno','Nombre','email','password','TUser','Estado','Municipio','TelOfi','TelCas',
        'Celular','Sexo','Status','Institucion'];


        public function persona(){
            return $this->belongsTo("App\Persona")->select(array(
                'IdPersona','Nombre', 'email'
            ));
        }



}
