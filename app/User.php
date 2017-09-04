<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ExamenCalificacion;
use App\Curso;

class User extends Authenticatable implements CanResetPassword
{
    use SoftDeletes, Notifiable;

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


        protected $table = 'persona';
        protected  $primaryKey = "IdPersona";

        protected $hidden = [
            'password',
            'remember_token'
        ];


        protected $fillable = ['APaterno', 'AMaterno','Nombre','email','password','TUser','Estado','Municipio','TelOfi','TelCas',
            'Celular','Sexo','Status','Institucion'];



        public function setPasswordAttribute($value) {
            $this->attributes['password'] = bcrypt($value);
        }

        public function save(array $options = array())
        {
            if(empty($this->api_token)) {
                $this->api_token = str_random(60);
            }
            return parent::save($options);
        }

        public function alumno() {
            return $this->hasOne('App\Alumno', 'IdPersona', 'IdPersona');
        }

        public function instructor() {
            return $this->hasOne('App\Instructor', 'email', 'email');
        }

        public function cliente_administrador() {
            return $this->hasOne('App\ClienteAdministrador', 'id_persona', 'IdPersona');
        }



        


}
