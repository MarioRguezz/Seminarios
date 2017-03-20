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
            $band = 0;
            if($user->Status == "BAJA"){
                $this->logout();
                return view('login', array('res' => 1));
            }
            if($user->TUser == "Instructor")
            {
                $band = 1;
            }

            if($user->TUser == "Alumno")
            {
                $band = 2;
            }

            if($user->TUser == "Administrador")
            {
                $band = 3;
            }
            return view('principal', ['band' => $band]);
        }else {
            return view('login', array('res' => 2));
        }
    }


    /**
     * Controlador para logueo de usuarios.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request){
        session_start();
        if (Auth::attempt(['email' => $request->input('user'), 'password' => $request->input('pass')])) {
            // Authentication passed...
            $user = Auth::user();
            $_SESSION["tipoP"] = $user->TUser;
            $_SESSION["email"] = $request->input('user');

            return redirect("/");
        }
        else{
            //El 0 indica que se imprime el mensaje de Usuario y/o contraseña incorrecto.
            return view('login', array('res' => 0));
        }

    }

    /**
     * Método para registrar un nuevo usuario.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
                    $request->file('Archivo')->move($path ,  $filename);

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

    /**
     * Función de prueba.
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function checkuser(){
           return Auth::user();
    }


    public function verificarCorreo(Request $request){
        //$user= $_POST['email'];
        $email =   $request->input('email');
        $user = User::where('email', $email)->first();
        if(isset($user)){
            return 1;
        }
        return 2;
    }


    /**
     * Retorno de la vista de registro.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registroView(Request $request){
        return view('usuario.registrar');
    }


    /**
     * Función para cerrar la sesión de un usuario.
     * @param Request $request
     */
    public function logout(){
        $user = Auth::user();
        session_start();
        unset($_SESSION['tipoP']);
        unset($_SESSION['email']);
        unset($_SESSION["IDExam"]);
        session_destroy();

        Auth::logout();

        return redirect('/');

    }
}
