<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    /**
     * Nueva instancia del controlador, permite que no se utilice esta sesión a menos que se esté logueado.
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth');
    }


    public function index(Request $request){
        $user = Auth::user();
        if(isset($user)){
            return "Logueado";
        }
        return view('login', array('res'=>2));
    }


    public function login(Request $request){

        if (Auth::attempt(['email' => $request->input('user'), 'password' => $request->input('pass')])) {
            // Authentication passed...

            return "WOWO";
           // return redirect()->intended('dashboard');
        }

    }

    /**
     * Función para registrar un nuevo usuario
     */
    public function registrar(Request $request){

        include 'php/conexion.php';
        $conec = conect();
        $archivo = "";
        $destino = "";

        if($request->input('Tuser') == 'Instructor')
        {

            $extension = substr($_FILES["Archivo"]["type"], (strlen($_FILES["Archivo"]["type"])-3), strlen($_FILES["Archivo"]["type"]));
            $NuevoNombre = 	$request->input('email').".".$extension;
            $archivo = $NuevoNombre;


            //	$archivo = $_FILES["Archivo"]["name"];
            $carpeta = "../CV/";

            if($archivo != "")
            {
                opendir($carpeta);
                $destino = $carpeta.$archivo;
                copy($_FILES['Archivo']['tmp_name'],$destino);
            }

        }
        else
        {
            $extension = substr($_FILES["Archivo1"]["type"], (strlen($_FILES["Archivo1"]["type"])-3), strlen($_FILES["Archivo1"]["type"]));
            if($extension == "peg"){
                $extension = "jpeg";
            }
            $NuevoNombre = 	$_POST['email'].".".$extension;
            $archivo = $NuevoNombre;
            //	$archivo = $_FILES["Archivo1"]["name"];
            $carpeta = "../img/Profile/";

            if($archivo != "")
            {
                opendir($carpeta);
                $destino = $carpeta.$archivo;
                copy($_FILES['Archivo1']['tmp_name'],$destino);
            }
        }
        if($_REQUEST['Tuser'] == 'Instructor')
        {
            //echo "entro a instruc";
            $Consulta = "INSERT INTO usuario (email,curriculum) VALUES ('$_POST[email]', '$destino');";
        }
        else
        {
            $Consulta = "INSERT INTO alumno (email,fotografia) VALUES ('$_POST[email]', '$destino');";
        }
        //  echo $Consulta;
        if(mysqli_query($conec,$Consulta))
        {
            //  echo $Consulta;
        }
        else
        {
            //	echo "hubo un error al enviar el mensaje intente de nuevo".mysqli_error();
        }


        User::create(array(
           'APaterno' => $_POST['apaterno'],
           'AMaterno' => $_POST['amaterno'],
           'Nombre' => $_POST['nombre'],
           'email' => $_POST['email'],
           'password' => $_POST['password'],
           'TUser' => $_POST['Tuser'],
           'Estado' => $_POST['estado'],
           'Municipio' => $_POST['municipio'],
           'TelOfi' => $_POST['telofi'],
           'TelCas' => $_POST['telcasa'],
           'Celular' => $_POST['celular'],
           'Sexo' => $_POST['sexo']
        ));



        //  echo $Consulta ."<br>";
        //  echo $sql;
        //


        mysqli_close($conec);
        //*/

    }

    public function checkuser(){
            dd(Auth::user());
    }

    public function registroView(Request $request){
        return view('usuario.registrar');
    }
}
