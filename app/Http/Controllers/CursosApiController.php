<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SubtemaVisto;

class CursosApiController extends Controller
{

    /**
     * get: Cursos
     * params:[api_token].
     * Devuelve la lista de cursos de acuerdo al token de API enviado.
     * @param Request $request
     */
    function get(Request $request) {
        $user = Auth::guard('api')->user();
        $cursos = null;
        $errors = [];
        if(isset($user)) {
            $cursos = $user->alumno->cursos;

            foreach($cursos as $curso){
             foreach($curso->temas as $tema){
               $curso->totalSubtemas += count($tema->subtemas);
             }
             foreach($curso->alumnos as $alumno){
               $subtemasvistos = SubtemaVisto::all()->where('id_Curso','=', $alumno->pivot->id_Curso)->where('Mat_Alumno','=', $alumno->Mat_Alumno)->where('Visto','!=','0');
               $alumno->subtemasVistos = count($subtemasvistos);
               if($curso->totalSubtemas == null ){
                 $curso->totalSubtemas = 0;
               }else{
               $alumno->totalSubtemas = $curso->totalSubtemas;
             }
             if($alumno->subtemasVistos != 0){
               if($alumno->totalSubtemas > 0) {
                 $curso->porcentaje =  ($alumno->subtemasVistos*100) / $alumno->totalSubtemas;
               }
             }else{
               $curso->porcentaje = 0;
             }
              unset($curso->temas);
              unset($curso->alumnos);

           }
         }
        }
        else {
            $errors[] = "Usuario no encontrado";
        }
        return response()->json(array(
            'success' => true,
            'errors' => $errors,
            'status' => 200,
            'data' => $cursos
        ));

    }
}
