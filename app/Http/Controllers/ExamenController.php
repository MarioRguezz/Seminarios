<?php

namespace App\Http\Controllers;

use App\Examen;
use App\ExamenCalificacion;
use App\Pregunta;
use App\Subtema;
use App\Tema;
use App\Alumno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    //

    /**
     * Nueva instancia del controlador, permite que no se utilice esta sesión a menos que se esté logueado.
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }


    public function index(Request $request){
        $user = Auth::user();
        if(isset($user)){
            return view('examen.examenCreacion');
        }else {
            return view('login', array('res' => 2));
        }
    }

    public function guardar(Request $request) {
        $idTema = $request->input('idTema');
        $preguntas = $request->input('preguntas');
        $idSubtema = $request->input('idSubtema');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $actividad = $request->input('actividad');
        $id = $request->input('id');
        $IDCurso = DB::table('curso_tema')->where('id_Tema', '=', $idTema)->get()->first()->id_Curso;


    //   $consulta = "SELECT P.APaterno, P.AMaterno, P.Nombre, P.email, CP.Mat_Alumno JOIN curso_participante CP ON A.Mat_Alumno = CP.Mat_Alumno JOIN Persona P ON A.email = P.email WHERE CP.id_Curso = '$IDCurso'";
       $users = DB::table('alumno')
                   ->join('curso_participante', 'alumno.Mat_Alumno', '=', 'curso_participante.Mat_Alumno')
                   ->join('persona', 'alumno.email', '=', 'persona.email')
                   ->where('curso_participante.id_Curso','=',$IDCurso)
                   ->select('persona.*', 'curso_participante.Mat_Alumno')
                   ->get();

        //Obtener subtema
        /*$subtema = Subtema::find($idSubtema);
        $tema = Tema::where('id_Tema', $idTema)->first();
        $orden = Subtema::where('id_Tema', $idTema)->orderBy('Orden', 'desc')->first(); //->Orden;
        $subtemaId = null;
        if($actividad == "true") {
          if(isset($subtema)) {
              $subtema->Nombre = $nombre;
              $subtema->Descrip = $descripcion;
              $subtema->id_Tema = $idTema;
              $subtema->id_Subtema = substr($idTema,0, 2).'st'.rand(1000, 9999);
              $subtema->id_Curso = $tema->id_Curso;
              $subtema->Orden = $orden;
              $subtema->save();
          }
          else {
              $subtema = Subtema::create([
                  "Nombre" => $nombre,
                  "Descrip" => $descripcion,
                  "id_Tema" => $idTema,
                  "id_Subtema" => substr($idTema,0, 2).'st'.rand(1000, 9999),
                  "id_Curso" => $tema->id_Curso,
                  "Orden" => $orden
              ]);
          }

          $subtemaId = $subtema->IDes;
        }*/

        $examen = Examen::find($id);

        if(isset($examen)){
            $examen->id_Tema = $idTema;
            $examen->id_Subtema = $subtemaId;
            $examen->save();
        }
        else {
          /*  $examen = Examen::create([
                "ID_Examen" => substr($idTema,0, 2).'ex'.rand(1000, 9999),
                "id_Subtema" => $subtemaId,
                "id_Tema" => $idTema
            ]);*/
            $examen = Examen::create([
                  "ID_Examen" => substr($idTema,0, 2).'ex'.rand(1000, 9999),
                  "id_Subtema" => null,
                  "id_Tema" => $idTema
              ]);

        }

        $preguntasIds = [];

        foreach ($preguntas as $pregunta) {
            $titulo = $pregunta["titulo"];
            $tipo = $pregunta["tipo"];
            $idExamen = $examen["Idesx"];
            $idSubtema = substr($idExamen,0, 2).'st'.rand(1000, 9999);

            unset($pregunta["titulo"]);
            unset($pregunta["tipo"]);
            unset($pregunta["Idesx"]);

            $preg = Pregunta::find($pregunta["id"]);
            if(isset($preg)) {
                $preg->titulo = $titulo;
                $preg->tipo = $tipo;
                $preg->ID_Examen = $idExamen;
                $preg->ID_Subtema = $idSubtema;
                $preg->json = json_encode($pregunta);
                $preg->save();
            }
            else {
               $preg = Pregunta::create([
                    "titulo" => $titulo,
                    "tipo" => $tipo,
                    "ID_Examen" => $idExamen,
                    "ID_Subtema" => $idSubtema,
                    "json" => json_encode($pregunta)
                ]);
            }

            $preguntasIds[] = $preg->ID_Pregunta;
        }

        foreach ($users as $user) {
          DB::table('habilita_exam')->insert(
         ['IDTema' => $idTema, 'Mat_Alu' =>  $user->Mat_Alumno , 'Status' => 'ACTIVO']);
        }

//$users = DB::table('users')->select('name', 'email as user_email')->get();
    /*    DB::table('habilita_exam')->insert(
    ['IDTema' => $idTema, 'Mat_Alu' => , 'Status' => 'ACTIVO']);
*/
      /*  $sql = "SELECT Status FROM habilita_exam WHERE Mat_Alu = '$Alumno' AND IDTema = '$Tema';";
        $resultadoses = mysqli_query($conex,$sql);
        $rowses = mysqli_fetch_array($resultadoses);


        if($rowses['Status'] == ""){

        	$consulta = "INSERT INTO habilita_exam (IDTema, Mat_Alu, Status) Values('$Tema', '$Alumno', 'ACTIVO');";
        	if(mysqli_query( $conex,$consulta))
        	{	}
        	else
        	{*/




        return response()->json([
            "id" => $examen->Idesx,
            "idSubtema" => isset($subtema) ? $subtema->IDes : null,
            "preguntas" => $preguntasIds
        ]);
    }



    public function eliminar(Request $request) {
        
        $IDTema = $_POST['IDTema'];
        $IDCurso = $_POST['IDCurso'];

        $examen = Examen::where('id_Tema', $IDTema)->first();
        Pregunta::where('ID_Examen', $examen->Idesx)->delete();
        $examen->delete();

        return redirect()->back();
    }


    public function examenDatos(Request $request){
        include 'php/conexion.php';
        //$accion = $_GET['accion'];
        $tipoPer = $_SESSION["tipoP"];
        $email = $_SESSION["email"];
        $IDTema = $_GET['IDTema'];
        $tipo = $_GET['type'];

        if(isset($_SESSION['tipoP'])) {
        }
        else {
            echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';
            echo "<script>location.href='login.php'</script>";
        }

        if($tipoPer == "Alumno") {
            logout();
            echo '<script>alert("Acceso denegado... Sitio exclusivo para Instructores y administradores")</script> ';
            echo "<script>location.href='login.php'</script>";
        }
        $conexia = conect();
        $queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
        $resultadoses = mysqli_query($conexia,$queryxe);
        $rowses = mysqli_fetch_array($resultadoses);
        if($rowses['Status'] == "BAJA") {
            logout();
            echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
            echo "<script>location.href='login.php'</script>";
        }

        $IDCurso = $_POST['IDCurso'];
        //$queryze = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$IDCurso';";
        $queryze = "SELECT * FROM curso_tema WHERE id_Curso = '$IDCurso';";
        $resultas = mysqli_query($conexia,$queryze);
        $NumRow = mysqli_num_rows($resultas);

        $queryzexa = "SELECT * FROM curso WHERE id_Curso = '$IDCurso';";
        $resultasa = mysqli_query($conexia,$queryzexa);
        $row = mysqli_fetch_array($resultasa);

        $examen = Examen::where('id_Tema', $request->IDTema)->get()->first();

        if(!isset($examen)) {
          return view('examen.examenCreacion', array('IDTema' => $IDTema, 'tipo' => $tipo));
        }
        else {
          return view('examen.examenCreacion', array('active' => false));
        }



    }


    public function actividad(Request $request){
        // $examen = new Examen;
        $idTema =   $request->input('Tema') ;
        $tema = Tema::where([['id_Tema', '=', $idTema]])->first();
        $examen = $tema->examen;
        $preguntas = $examen->preguntas;
        //$pregunta = Pregunta::where([['ID_Examen', '=', $idExamen]])->get();
        //return $preguntas;
        return view('examenAlumno', array('preguntas' => $preguntas));
    }

    public function examen(Request $request){
       // $examen = new Examen;
        $idTema =   $request->input('IDTema') ;
        $tema = Tema::where([['id_Tema', '=', $idTema]])->first();
        $examen = $tema->examen;
        $preguntas = $examen->preguntas;
        //$pregunta = Pregunta::where([['ID_Examen', '=', $idExamen]])->get();
        //return $preguntas;
        return view('examenAlumno', array('preguntas' => $preguntas));
    }

    public function respuesta(Request $request)
    {
        $val = 0;
        $total = 0;
        $isCorrect = false;
        $respuestas = $request->input('respuestas');
        $Mat_Alumno = $request->input('Mat_Alumno');
        $IDTema = $request->input('IDTema');
        $cantidadRespuestas = count($respuestas);
        for ($i = 0; $i < $cantidadRespuestas; $i++) {
            $pregunta = Pregunta::where([['ID_Pregunta', '=', $respuestas[$i]["id_pregunta"]]])->first();
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

        return $total;
       // return $val;
    }

    public function diploma(Request $request, $cve_alumno, $cve_tema ){
      $alumno = Alumno::where([['Mat_Alumno', '=', $cve_alumno]])->first();
      $tema = Tema::where([['id_Tema', '=', $cve_tema]])->first();
    //  $alumno->datos->Nombre; APaterno, AMaterno $tema->Curso
        return view('examen.diploma', ['alumno'=> $alumno, 'tema' => $tema]);
    }


}
