<?php

namespace App\Http\Controllers;

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


    public function examenDatos(Request $request){
        include 'php/conexion.php';
        //$accion = $_GET['accion'];
        $tipoPer = $_SESSION["tipoP"];
        $email = $_SESSION["email"];
        $IDTema = $_POST['IDTema'];
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

