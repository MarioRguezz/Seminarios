<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  /*  protected $fillable = [
        'name', 'email', 'password',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  /*  protected $hidden = [
        'password', 'remember_token',
    ];*/


        protected $table = 'durango.persona';

        protected $fillable = [
            'IdPersona', 'APaterno', 'AMaterno','Nombre','email','password','TUser','Estado','Municipio','TelOfi','TelCas',
            'Celular','Sexo','Status','Institucion'];


            public function persona(){
                return $this->belongsTo("App\Persona")->select(array(
                    'IdPersona','Nombre', 'email'
                ));
            }
}
