<?php

namespace App\Http\Controllers;

use App\Examen;
use App\Pregunta;
use App\Subtema;
use App\Tema;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $id = $request->input('id');

        //Obtener subtema
        $subtema = Subtema::find($idSubtema);
        $tema = Tema::where('id_Tema', $idTema)->first();
        $orden = Subtema::where('id_Tema', $idTema)->orderBy('Orden', 'desc')->first()->Orden;

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

        $examen = Examen::find($id);

        if(isset($examen)){
            $examen->id_Tema = $idTema;
            $examen->id_Subtema = $subtema->IDes;
            $examen->save();
        }
        else {
            $examen = Examen::create([
                "ID_Examen" => substr($idTema,0, 2).'ex'.rand(1000, 9999),
                "IDes" => $subtema->IDes,
                "id_Tema" => $idTema,
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

        return response()->json([
            "id" => $examen->Idesx,
            "idSubtema" => $subtema->IDes,
            "preguntas" => $preguntasIds
        ]);
    }


    public function examenDatos(Request $request){
        include 'php/conexion.php';
        //$accion = $_GET['accion'];
        $tipoPer = $_SESSION["tipoP"];
        $email = $_SESSION["email"];
        $IDTema = $_GET['IDTema'];
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

        return view('examen.examenCreacion', array('IDTema' => $IDTema));


    }


}

