<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    /**
     * Nueva instancia del controlador, permite que no se utilice esta sesión a menos que se esté logueado.
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
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


        $sql = "INSERT INTO persona (APaterno, AMaterno, Nombre, email, password, TUser, Estado, Municipio, TelOfi, TelCas,Celular, Sexo) VALUES ('$_POST[apaterno]', '$_POST[amaterno]', '$_POST[nombre]', '$_POST[email]', '$_POST[password]', '$_REQUEST[Tuser]', '$_POST[estado]', '$_POST[municipio]', '$_POST[telofi]', '$_POST[telcasa]', '$_POST[celular]', '$_REQUEST[sexo]');";
        //  echo $Consulta ."<br>";
        //  echo $sql;
        //
        if(mysqli_query($conec,$sql))
        {
            echo '<script>

					swal({
					title: "Su solicitud ha sido enviada, por favor espere respuesta del administrador",
					text: "de clic en el boton para continuar",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#00FF00",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },



					</script>';


        }
        else
        {
            /*
            echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
            $accion="VACIO";
            echo "<script>location.href='Registro.php'</script>";
            //*/
            echo '<script>

					swal({
					title: "Hubo un error, intentelo más tarde",
					text: "de clic en el boton para continuar",
					type: "error",
					showCancelButton: false,
					confirmButtonColor: "#FF0000",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },


					</script>';

        }

        mysqli_close($conec);
        //*/

    }


    public function registroView(Request $request){
        return view('usuario.registrar');
    }
}
