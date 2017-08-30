<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alumno extends Model
{

    protected $table = 'alumno';

    protected $primaryKey = 'Mat_Alumno';

    protected $fillable = [
        'Id', 'Mat_Alumno', 'fotografia','profesion','institucion','adscripcion','email','constancia','estatus', 'id_cliente_administrador', 'IdPersona'];


    public function cursos() {
        return $this->belongsToMany('App\Curso', 'curso_participante', 'Mat_Alumno', 'id_Curso');
    }

    public function datos()
    {
        return $this->hasOne('App\Persona','email','email');
    }

    public function clienteAdministrador() {
        return $this->belongsTo('App\ClienteAdministrador', 'id_cliente_administrador', 'id');
    }

    public function calificacionCurso($idCurso) {
            $curso = Curso::find($idCurso);
            $temas = $curso->temas;
            $matAlumno = 
            $cf = 0;
            $count = 0;
            foreach($temas as $tema) {
                $calif = ExamenCalificacion::where('id_Tema', $tema->id_Tema)->where('Mat_Alumno', $this->Mat_Alumno)->first();
                if($calif) {
                    $count ++;
                    $cf += $calif->Calificacion;
                }
            }
            $cf = $cf / ($count == 0 ? 1 :$count);
            return $cf;
            
        }

}
