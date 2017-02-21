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

            return redirect("/");
           // return redirect()->intended('dashboard');
        }

    }

    /**
     * Función para registrar un nuevo usuario
     */
    public function registrar(Request $request){

        /**
         * Validaciones realizadas al inicio para saber qué campos son obligatorios.
         */
        $this->validate($request, [
            'apaterno' => 'required',
            'nombre' => 'required',
            'email' => 'required|email|unique:persona',
            'password' => 'required',
            'Tuser' => 'required',

        ]);

        /**
         * Código de PHP puro
         * TODO: Se puede mejorar en una nueva versión utilizando Laravel.
         */
        include 'php/conexion.php';
        $conec = conect();
        $archivo = "";
        $destino = "";

        if($request->input('Tuser') == 'Instructor')
        {

            if ($request->hasFile('Archivo')) {
                if($request->file('Archivo')->isValid()){
                    $extension = $request->file('Archivo')->getClientOriginalExtension();
                    $path = "CV/";
                    $filename= uniqid("usuario_") . "." . $extension;
                    $request->file('Archivo1')->move($path ,  $filename);

                }
            }


        }
        else
        {
            if ($request->hasFile('Archivo1')) {
                if($request->file('Archivo1')->isValid()){
                    $extension = $request->file('Archivo1')->getClientOriginalExtension();
                    $path = "img/Profile/";
                    $filename= uniqid("usuario_") . "." . $extension;
                    $request->file('Archivo1')->move($path ,  $filename);

                }
            }
        }
        if($_REQUEST['Tuser'] == 'Instructor')
        {
            //echo "entro a instruc";
            $Consulta = "INSERT INTO usuario (email,curriculum) VALUES ('$_POST[email]', '".url($path.$filename)."');";
        }
        else
        {
            $Consulta = "INSERT INTO alumno (email,fotografia) VALUES ('$_POST[email]', '".url($path.$filename)."');";
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
        mysqli_close($conec);
        //Fin de código puro PHP, consideración para mejorar

        //Inserción en base de datos para realizar el registro del usuario.
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

        return redirect('/');

        //*/

    }

    public function checkuser(){
            dd(Auth::user());
    }

    public function registroView(Request $request){
        return view('usuario.registrar');
    }
}
