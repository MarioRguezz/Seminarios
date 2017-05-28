<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamenApiController extends Controller
{
  public function respuesta(Request $request)
  {
      $val = 0;
      $total = 0;
      $isCorrect = false;
      $respuestas = $request->input('Respuestas');
      $Mat_Alumno = $request->input('Mat_Alumno');
      $IDTema = $request->input('IDTema');
      $cantidadRespuestas = count($respuestas);
      for ($i = 0; $i < $cantidadRespuestas; $i++) {
          $pregunta = Pregunta::where([['ID_Pregunta', '=', $respuestas[$i]["id"]]])->first();
          $preguntaJson = json_decode($pregunta->json);
          if($pregunta->tipo ==  "1"){
              if ($preguntaJson->respuestas[0] == $respuestas[$i]["respuestas"]) {
                  $val++;
              }
          } else if($pregunta->tipo ==  "2")   {
                if($preguntaJson->respuestas[0] == $respuestas[$i]["respuestas"]){
                    $val++;
              }
          } else if ($pregunta->tipo ==  "3"){
              //
              for($y=0; $y< count($preguntaJson->respuestas); $y++){
                  if($preguntaJson->respuestas[$y]->casilla == $respuestas[$i]["respuestas"][$y]["casilla"]  &&   $preguntaJson->respuestas[$y]->item   == $respuestas[$i]["respuestas"][$y]["item"]){
                      $isCorrect = true;
                  }else{
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
              $total = ($val * 100) / $cantidadRespuestas;
              $pregunta = ExamenCalificacion::where([['id_Tema', '=', $IDTema], ['Mat_Alumno', '=', $Mat_Alumno]])->first();
              $pregunta->Calificacion = $total;
              $pregunta->save();
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
