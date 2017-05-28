<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Subtema;
use App\SubtemaVisto;
use App\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemasApiController extends Controller
{


    /**
     * get: Temas
     * params: [api_token, id_Curso].
     * Método que devuelve los temas asociados a un curso. Es necesario estar autenticado como usuario (api_token) para
     * poder consultar esta información.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request) {
        $idCurso = $request->input('id_Curso');
        $curso = Curso::find($idCurso);
        $errors = [];
        $temas = null;
        $status = 200;
        $success = true;
        if(isset($curso)) {
            $temas = $curso->temas;
        }
        else {
            $errors[] = "No se ha encontrado el curso";
            $status = 404;
            $success = false;
        }

        return response()->json(array(
            'success' => $success,
            'status' => $status,
            'errors' => $errors,
            'data' => $temas
        ));
    }


    /**
     * get: Subtemas
     * params: [api_token, IDex].
     * Método que devuelve los subtemas a partir del IDex de un tema dado (llave primaria).
     * La lista de subtemas solo puede devolverse cuando se provee un api token válido.
     * Cada subtema contiene información básica del mismo, así como la información sobre documento, audio o video.
     * @param Request $request
     */
    public function subtemas(Request $request) {
        //Nótese que es la llave primaria de la tabla (curso_tema).
        $idTema = $request->input('IDex');
        $user = Auth::guard('api')->user();
        $tema = Tema::find($idTema);
        $matAlumno = $user->alumno->Mat_Alumno;
        $errors = [];
        $status = 200;
        $subtemas = null;
        $success = true;
        if(isset($tema)) {
            $subtemas = $tema->subtemas;

            foreach($subtemas as $subtema) {
              $visto = SubtemaVisto::where('Mat_Alumno', $matAlumno)->where('id_Subtema', $subtema->id_Subtema)->get()->first();
              if(isset($visto)) {
                $subtema->visto = true;
              }
              else {
                $subtema->visto = false;
              }
            }
        }
        else {
            $status = 404;
            $success = false;
            $errors[] = "El tema no se encuentra registrado";
        }

        return response()->json(array(
            "success" => $success,
            "errors" => $errors,
            "status" => $status,
            "data" => $subtemas
        ));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function examen(Request $request) {
        //Nótese que es la llave primaria de la tabla (curso_tema).
        $idTema = $request->input('IDex');
        $tema = Tema::find($idTema);
        $errors = [];
        $status = 200;
        $examen = null;
        $success = true;
        if(isset($tema)) {
            $examen = $tema->examen;
        }
        else {
            $status = 404;
            $success = false;
            $errors[] = "El tema no se encuentra registrado";
        }

        return response()->json(array(
            "success" => $success,
            "errors" => $errors,
            "status" => $status,
            "data" => $examen
        ));
    }


    public function subtemavisto(Request $request) {
        $Mat_Alumno = $request->Mat_Alumno;

        $IdSubtema = $request->IdSubtema;
        $subtema = Subtema::where("id_Subtema", $IdSubtema)->get()->first();
        $tema = $subtema->tema;
        $curso = $tema->Curso;

        $orden = Subtema::where('id_Tema', $tema->id_Tema)->max('orden') + 1;
        SubtemaVisto::create(array(
            'id_Curso' => $curso->id_Curso,
            'id_Tema' => $tema->id_Tema,
            'id_Subtema' => $IdSubtema,
            'Mat_Alumno' => $Mat_Alumno,
            'Visto' => 1,
            'Orden' => $orden
        ));

        return response()->json(array(
            'data' => true,
            'success'=> true,
            'status' => 200,
            'errors' => []
        ));

    }
}
