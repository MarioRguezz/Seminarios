<?php

namespace App\Http\Controllers;

use App\ClienteAdministrador;
use App\Instructor;
use App\User;
use App\Alumno;
use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\DeclareDeclare;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

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


    /**
     * Método que devuelve la vista principal, o el login en caso correspondiente.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $user = Auth::user();
        if(isset($user)){
            $band = 0;
            if($user->Status == "BAJA" && $user->TUser == "Instructor"){
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
            'codigo_cliente' => 'required'
        ]);

        $adminCliente = ClienteAdministrador::where('codigo', $request->input('codigo_cliente'))->get()->first();

        if(!isset($adminCliente)) {
            return view('usuario.registrar', ['errors' => collect(['El código de cliente es inválido']), 'request' => $request]);
        }


        /**
         * Si se registra un instructor, se valida que se haya subido un currículum y se guarda.
         */
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
        //Caso contrario (alumno), se carga una imagen que acompañará el perfil.
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

         //Generación de instructores o alumnos.
        if($request->input('Tuser') == 'Instructor')
        {
            //echo "entro a instruc";
            Instructor::create(array(
                "email" => $request->input('email'),
                "curriculum" => url($path.$filename),
                "id_cliente_administrador" => $adminCliente->id
            ));       

        }
        else
        {
            $alumno = Alumno::create(array(
               "email" => $request->input('email'),
                "fotografia" => url($path.$filename),
                "id_cliente_administrador" => $adminCliente->id
            ));

            $max = Alumno::max('Mat_Alumno');
            $alumno->Mat_Alumno = $max + 1;
            $alumno->save();
        }

        //Inserción en base de datos para realizar el registro del usuario.
        User::create(array(
           'APaterno' => $request->input('apaterno'),
           'AMaterno' => $request->input('amaterno'),
           'Nombre' => $request->input('nombre'),
           'email' => $request->input('email'),
           'password' => $request->input('password'),
           'TUser' => $request->input('Tuser'),
           'Estado' => $request->input('estado'),
           'Municipio' => $request->input('municipio'),
           'TelOfi' => $request->input('telofi'),
           'TelCas' => $request->input('telcasa'),
           'Celular' => $request->input('celular'),
           'Sexo' => $request->input('sexo')
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
    public function registroView(Request $request) {
        return view('usuario.registrar');
    }


    public function administradoresView(Request $request) {
        $administradores = ClienteAdministrador::paginate(10);

        return view ('usuario.administradores', ['administradores' => $administradores]);
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



    /**
     * Controlador para cambio de status.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function status(Request $request){
       $matAlumno =  $request->input('Mat_Alumno');
       $idCurso =   $request->input('id_Curso');

       $curso = Curso::where([
            ['Mat_Alumno', '=', $matAlumno],
            ['id_Curso', '=', $idCurso]
        ])->first();

       if($curso->status  == 1 ){
           $curso->status = 0;
           $curso->save();
       }else{
           $curso->status = 1;
           $curso->save();
       }
        return  $curso->status ;


    }
    public function validar(Request $request){
        $idCurso =  $request->input('idCurso');
        $email =   $request->input('email') ;
        $alumno = Alumno::where([['email', '=', $email]])->first();
        $curso = new Curso;
        $curso->Mat_Alumno= $alumno->Mat_Alumno;
        $curso->id_Curso = $idCurso;
        $curso->status = '1';
        $curso->save();
        //INSERT INTO curso_participante (id_curso, Mat_Alumno, status) VALUES ('$_POST[IDCurso]', '$_POST[Mat_Alumno]', '0');"
       // return  $emails;
      return view('usuario.aceptar');
    }



}
