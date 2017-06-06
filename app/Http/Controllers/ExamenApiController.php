<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tema;
use App\Pregunta;
use App\ExamenCalificacion;
use Carbon\Carbon;

class ExamenApiController extends Controller
{
  public function respuesta(Request $request)
  {
    $preguntasRevisadas = [];
      $val = 0;
      $total = 0;
      $isCorrect = false;
      $respuestas = json_decode($request->input('Respuestas'));
      $Mat_Alumno = $request->input('Mat_Alumno');
      $IDTema = $request->input('IDTema');
      $tema = Tema::where('id_Tema', $IDTema)->get()->first();
      $cantidadRespuestas = count($respuestas);
      $totalPreguntas = count($tema->examen->preguntas);
      for ($i = 0; $i < $cantidadRespuestas; $i++) {
          $pregunta = Pregunta::where([['ID_Pregunta', '=', $respuestas[$i]->id_pregunta]])->first();
          $preguntaJson = json_decode($pregunta->json);

          if(isset($pregunta) && !in_array($pregunta->ID_Pregunta, $preguntasRevisadas)) {
            $preguntasRevisadas[] = $pregunta->ID_Pregunta;
            if($pregunta->tipo ==  "1"){
                if ($preguntaJson->respuestas[0] == $respuestas[$i]->respuestas) {
                    $val++;
                }
            } else if($pregunta->tipo ==  "2") {
                  if($preguntaJson->respuestas[0] == $respuestas[$i]->respuestas){
                      $val++;
                }
            } else if ($pregunta->tipo ==  "3"){
                for($y=0; $y< count($preguntaJson->respuestas); $y++){
                  if($y <= count($respuestas[$i]->respuestas)) {
                    if($preguntaJson->respuestas[$y]->casilla == $respuestas[$i]->respuestas[$y]->casilla  &&   $preguntaJson->respuestas[$y]->item   == $respuestas[$i]->respuestas[$y]->item){
                        $isCorrect = true;
                    }else{
                        $isCorrect = false;
                    }
                  }
                  else {
                    $isCorrect = false;
                  }
                }
                if($isCorrect){
                    $val++;
                    $isCorrect = false;
                }
            }
            if($val == 0){
                $total = 0;
            }else {
               // $total = ($cantidadRespuestas * 100) / $val;
                $total = ($val * 100) / $totalPreguntas;
                $pregunta = ExamenCalificacion::where([['id_Tema', '=', $IDTema], ['Mat_Alumno', '=', $Mat_Alumno]])->first();
                if(!isset($pregunta)) {
                  $pregunta = ExamenCalificacion::create(array(
                    'id_Tema' => $IDTema,
                    'Mat_Alumno' => $Mat_Alumno,
                    'Calificacion' => $total,
                    'Fecha' => Carbon::now()->toDateString(),
                    'ID_Examen' => $tema->examen->ID_Examen
                  ));
                }
                $pregunta->Calificacion = $total;
                $pregunta->save();
            }
          }
      }

      return response()->json(array(
        'success' => true,
        'errors' => [],
        'data' => $total,
        'status' => 200
      ));
     // return $val;
  }
}
