<?php

namespace App\Http\Controllers;

use App\ClienteAdministrador;
use App\Instructor;
use App\Jobs\SendEmails;
use App\Alumno;
use App\QueuedEmail;
use App\Curso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\DeclareDeclare;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

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
        $now = Carbon::now('America/Mexico_City');
        $user = Auth::user();
        if(isset($user)){
            $band = 0;
          if($user->TUser == "Instructor" ){
            $ca =   ClienteAdministrador::where("id", $user->instructor->id_cliente_administrador)->get()->first();
              if($now >= $ca->fecha_expiracion ){
                $this->logout();
                return view('login', array('res' => 2));
              }
          }else if($user->TUser == "Alumno"){
            $ca =   ClienteAdministrador::where("id", $user->alumno->id_cliente_administrador)->get()->first();
            if($now >= $ca->fecha_expiracion ){
              $this->logout();
              return view('login', array('res' => 2));
            }
          }
            if($user->TUser == "AdminCliente" && $now >= $user->cliente_administrador->fecha_expiracion){
                $this->logout();
                return view('login', array('res' => 2));
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
            if($user->TUser == "AdminCliente")
            {
                $band = 4;
            }
            return view('principal', ['band' => $band, 'idPersona' => $user->IdPersona]);
        }else {
            return view('login', array('res' => 3));
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

        $path = null;
        $filename = null;
        /**
         * Validaciones realizadas al inicio para saber qué campos son obligatorios.
         */
        $this->validate($request, [
            'apaterno' => 'required',
            'nombre' => 'required',
            'email' => 'required|email|unique:persona',
            'password' => 'required',
          //  'Tuser' => 'required',
            'codigo_cliente' => 'required'
        ]);

        $adminCliente = ClienteAdministrador::where('codigo', $request->input('codigo_cliente'))->get()->first();

        if(!isset($adminCliente)) {
            return view('usuario.registrar', ['errors' => collect(['El código de cliente es inválido']), 'request' => $request]);
        }


        /**
         * Si se registra un instructor, se valida que se haya subido un currículum y se guarda.
         */
        //$request->input('Tuser')
        if('' == 'Instructor')
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

        //Inserción en base de datos para realizar el registro del usuario.
        $user = User::create(array(
            'APaterno' => $request->input('apaterno'),
            'AMaterno' => $request->input('amaterno'),
            'Nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'TUser' => 'Alumno',//$request->input('Tuser'),
            'Estado' => $request->input('estado'),
            'Municipio' => $request->input('municipio'),
            'TelOfi' => $request->input('telofi'),
            'TelCas' => $request->input('telcasa'),
            'Celular' => $request->input('celular'),
            'Sexo' => $request->input('sexo')
        ));

         //Generación de instructores o alumnos.
         //$request->input('Tuser')
        if('' == 'Instructor')
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
          /*  $alumno = Alumno::create(array(
               "email" => $request->input('email'),
                "fotografia" => url($path.$filename),
                "id_cliente_administrador" => $adminCliente->id,
                "IdPersona" => $user->IdPersona
            ));

            $max = Alumno::max('Mat_Alumno');
            $alumno->Mat_Alumno = $max + 1;*/
            $max = Alumno::max('Mat_Alumno');
            $alumno = Alumno::create(array(
               "email" => $request->input('email'),
                "id_cliente_administrador" => $adminCliente->id,
                "Mat_Alumno" =>  ($max + 1),
                "IdPersona" => $user->IdPersona
            ));
            if($path && $filename) {
                $alumno->fotografia = url($path.$filename);
            }
            $alumno->save();
            $email = $alumno->email;

            Mail::send('emails.bienvenido', ['email' => $request->input('email')], function($message) use ($email)
                {
                    $message->from('contacto@byond.com', 'Byond');
                    $message->to($email, 'Usuario')->subject("Nuevo registro en Byond");
            });
        }

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
        $email = $request->email;
        $codigo = $request->codigo_administrador;
        return view('usuario.registrar', ['email' => $email, 'codigo' => $codigo]);
    }


    public function administradoresView(Request $request) {
        $administradores = ClienteAdministrador::paginate(10);
        foreach($administradores as $administrador){
          $administrador->restante =  $administrador->no_licencias - (count($administrador->alumnos)+count($administrador->instructores));
        }
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

/*
Vista editar al cliente administrador con datos
 */
    public function editarView(Request $request, $cve_usuario){
      $administradores = ClienteAdministrador::all()->where('id_persona','=',$cve_usuario)->first();
      $usuarios = User::all()->where('IdPersona','=',$cve_usuario)->first();
      return view('usuario.editar', ['administrador'=> $administradores, 'usuario'=> $usuarios]);
    }


    /*
    Vista editar al cliente administrador sin datos
     */
    public function editaremptyView(Request $request){
      return view('usuario.editarEmpty');
    }

    /*
    Vista para nuevo CA
     */
    public function NuevoRegistro(Request $request){
       $nombre = $request->input('nombre');
       $email = $request->input('email');
       $amaterno = $request->input('amaterno');
       $apaterno = $request->input('apaterno');
       $sexo = $request->input('sexo');
       $telofi = $request->input('telofi');
       $telcasa = $request->input('telcasa');
       $celular = $request->input('celular');
       $estado = $request->input('estado');
       $municipio = $request->input('municipio');
       $fecha = $request->input('fecha');
       $licencia = $request->input('licencia');
       $password = $request->input('password');
       $user = User::create([
           "APaterno" => $apaterno,
           "AMaterno" => $amaterno,
           "Nombre" => $nombre,
           "email" => $email,
           "TUser" => "AdminCliente",
           "password" => $password,
           "Municipio" => $municipio,
           "TelOfi" => $telofi,
           "TelCas" => $telcasa,
           "Celular" => $celular,
           "Sexo" => $sexo,
           "Estado" => $estado,
           "Status" => "ALTA",
           "Institucion" => ""
       ]);

       $user = ClienteAdministrador::create([
          "id_persona" => $user->IdPersona,
           "codigo" => substr($email,0, 6).'ca'.rand(1000, 9999),
           "fecha_expiracion" => $fecha,
           "no_licencias" => $licencia
       ]);

         return redirect('/usuario/administradores');
    }


/*
Recibe los datos a cambiar, guarda y redirige a la lista de cliente administrador
 */
    public function editarRegistro(Request $request){
       $nombre = $request->input('nombre');
       $amaterno = $request->input('amaterno');
       $apaterno = $request->input('apaterno');
       $limitelicencia = $request->input('celular');
       $password = $request->input('password');
       $fecha = $request->input('telcasa');
       $hidden = $request->input('idPersona');
       $administradores = ClienteAdministrador::all()->where('id_persona','=',$hidden)->first();
       $usuarios = User::all()->where('IdPersona','=',$hidden)->first();
       $usuarios->Nombre =  $nombre;
       $usuarios->APaterno = $apaterno;
       $usuarios->AMaterno = $amaterno;
       if($password == null || $password == ""){
       }else{
       $usuarios->password = $password;
     }
       $usuarios->save();
       $administradores->no_licencias  = $limitelicencia;
       $administradores->fecha_expiracion  = $fecha;
       $administradores->save();
         return redirect('/usuario/administradores');
    //  return view('usuario.editar', ['administrador'=> $administradores, 'usuario'=> $usuarios]);
    }



    public function listaalumnoView(Request $request, $cve_usuario){
      $administradores = ClienteAdministrador::all()->where('id_persona','=',$cve_usuario)->first();
      $alumnos =  $administradores->alumnos()->paginate(10);
      return view('usuario.alumnos', ['administradores'=> $administradores, 'alumnos' => $alumnos]);
    }


    /*
    Vista editar al alumno con datos
     */
        public function editarAlumnoView(Request $request, $cve_usuario, $cve_ca){
          $alumno = User::all()->where('IdPersona','=',$cve_usuario)->where('TUser','=','Alumno')->first();
          return view('usuario.editarAlumno', ['alumno'=> $alumno,'cve_ca'=> $cve_ca ]);
        }


        /*
        Recibe los datos a cambiar, guarda y redirige a la lista de cliente administrador
         */
            public function editarAlumnoRegistro(Request $request){
               $nombre = $request->input('nombre');
               $amaterno = $request->input('amaterno');
               $apaterno = $request->input('apaterno');
               $password = $request->input('password');
               $estatus = $request->input('estatus');
               $hidden = $request->input('idPersona');
               $idCA = $request->input('idCA');
               $alumno = User::all()->where('IdPersona','=',$hidden)->first();
               $alumno->Nombre =  $nombre;
               $alumno->APaterno = $apaterno;
               $alumno->AMaterno = $amaterno;
               $alumno->Status = $estatus;
               if($password == null || $password == ""){
               }else{
               $alumno->password = $password;
             }
               $alumno->save();
               $administradores = ClienteAdministrador::all()->where('id_persona','=',$idCA)->first();
               $alumnos =  $administradores->alumnos()->paginate(10);
              return redirect("/usuario/alumnos/".$administradores->id_persona)->with('administradores', $administradores)->with('alumnos', $alumnos);
            //  return view('usuario.editar', ['administrador'=> $administradores, 'usuario'=> $usuarios]);
            }

            /*
            Vista para nuevo alumno
             */
            public function nuevoAlumnoRegistro(Request $request){
               $nombre = $request->input('nombre');
               $email = $request->input('email');
               $amaterno = $request->input('amaterno');
               $apaterno = $request->input('apaterno');
              $password = $request->input('password');
               $sexo = $request->input('sexo');
               $telofi = $request->input('telofi');
               $telcasa = $request->input('telcasa');
               $celular = $request->input('celular');
               $estado = $request->input('estado');
               $municipio = $request->input('municipio');
               $idCA = $request->input('idCA');
               if ($request->hasFile('Archivo1')) {
                   if($request->file('Archivo1')->isValid()){
                       $extension = $request->file('Archivo1')->getClientOriginalExtension();
                       $path = "img/Profile/";
                       $filename= uniqid("usuario_") . "." . $extension;
                       $request->file('Archivo1')->move($path ,  $filename);
                       $valid = url($path.$filename);
                   }

               }
     if($request->input('Archivo1') == false){
       $valid = "";
     }   //dd("asd");

        $user = User::create([
                   "APaterno" => $apaterno,
                   "AMaterno" => $amaterno,
                   "Nombre" => $nombre,
                   "email" => $email,
                   "TUser" => "Alumno",
                   "password" => $password,
                   "Municipio" => $municipio,
                   "TelOfi" => $telofi,
                   "TelCas" => $telcasa,
                   "Celular" => $celular,
                   "Sexo" => $sexo,
                   "Estado" => $estado,
                   "Status" => "ALTA",
                   "Institucion" => ""
               ]);
               $max = Alumno::max('Mat_Alumno');
               $alumno = Alumno::create(array(
                  "email" => $email,
                   "fotografia" => $valid,
                   "id_cliente_administrador" => $idCA,
                   "Mat_Alumno" =>  ($max + 1),
                   "IdPersona" => $user->IdPersona
               ));
              $alumno->save();
              $user->save();

               $this->dispatch(new SendEmails([$email], null, 'emails.bienvenido', 'Bienvenido a Byond'));

               $administradores = ClienteAdministrador::all()->where('id_persona','=',$request->input('idCA2'))->first();
               $alumnos =  $administradores->alumnos()->paginate(10);
               return redirect("/usuario/alumnos/".$administradores->id_persona)->with('administradores', $administradores)->with('alumnos', $alumnos);
            }

/*
Vista crear alumno desde CA
 */
public function alumnoView(Request $request, $cve_ca,  $cve_ca2){
  return view('usuario.registrarca',['cve_ca' => $cve_ca,'cve_ca2' => $cve_ca2]);
}


    public function listainstructorView(Request $request, $cve_usuario){
      $administradores = ClienteAdministrador::all()->where('id_persona','=',$cve_usuario)->first();
    //  $usuarios = User::all()->where('IdPersona','=',$cve_usuario)->first();
    $instructores =  $administradores->instructores()->paginate(10);
      return view('usuario.instructores', ['administradores'=> $administradores, 'instructores'=> $instructores]);
    }

    /*
    Vista editar al instructor con datos
     */
        public function editarInstructorView(Request $request, $cve_usuario, $cve_ca){
          $instructor = User::all()->where('IdPersona','=',$cve_usuario)->where('TUser','=','Instructor')->first();
          return view('usuario.editarInstructor', ['instructor'=> $instructor,'cve_ca'=> $cve_ca ]);
        }


        /*
        Recibe los datos a cambiar, guarda y redirige a la lista de cliente administrador
         */
            public function editarInstructorRegistro(Request $request){
               $nombre = $request->input('nombre');
               $amaterno = $request->input('amaterno');
               $apaterno = $request->input('apaterno');
               $password = $request->input('password');
               $estatus = $request->input('estatus');
               $hidden = $request->input('idPersona');
               $idCA = $request->input('idCA');
               $instructor = User::all()->where('IdPersona','=',$hidden)->first();
               $instructor->Nombre =  $nombre;
               $instructor->APaterno = $apaterno;
               $instructor->AMaterno = $amaterno;
               $instructor->Status = $estatus;
               if($password == null || $password == ""){
               }else{
               $instructor->password = $password;
             }
               $instructor->save();
               $administradores = ClienteAdministrador::all()->where('id_persona','=',$idCA)->first();
               $instructores =  $administradores->instructores()->paginate(10);
               return redirect("/usuario/instructores/".$administradores->id_persona)->with('administradores', $administradores);//->with('alumnos', $alumnos);
                      //  return view('usuario.editar', ['administrador'=> $administradores, 'usuario'=> $usuarios]);
            }

            /*
            Vista crear alumno desde CA
             */
            public function instructorView(Request $request, $cve_ca,  $cve_ca2){
              return view('usuario.registrarinstructor',['cve_ca' => $cve_ca,'cve_ca2' => $cve_ca2]);
            }


            /*
            Vista para nuevo alumno
             */
            public function nuevoInstructorRegistro(Request $request){
               $nombre = $request->input('nombre');
               $email = $request->input('email');
               $amaterno = $request->input('amaterno');
               $apaterno = $request->input('apaterno');
              $password = $request->input('password');
               $sexo = $request->input('sexo');
               $telofi = $request->input('telofi');
               $telcasa = $request->input('telcasa');
               $celular = $request->input('celular');
               $estado = $request->input('estado');
               $municipio = $request->input('municipio');
               $idCA = $request->input('idCA');

               if ($request->hasFile('Archivo1')) {
                   if($request->file('Archivo1')->isValid()){
                       $extension = $request->file('Archivo1')->getClientOriginalExtension();
                       $path = "CV/";
                       $filename= uniqid("usuario_") . "." . $extension;
                       $request->file('Archivo1')->move($path ,  $filename);
                       $valid = url($path.$filename);

                   }
               }
     if($request->input('Archivo1') == false){
       $valid = "";
     }

               $max = Instructor::max('Mat_Usuario');
               $instructor = Instructor::create(array(
                   "email" => $email,
                   "curriculum" => $valid,
                   "id_cliente_administrador" => $idCA,
                   "Mat_Usuario" => $max + 1
               ));



             $user = User::create([
                   "APaterno" => $apaterno,
                   "AMaterno" => $amaterno,
                   "Nombre" => $nombre,
                   "email" => $email,
                   "TUser" => "Instructor",
                   "password" => $password,
                   "Municipio" => $municipio,
                   "TelOfi" => $telofi,
                   "TelCas" => $telcasa,
                   "Celular" => $celular,
                   "Sexo" => $sexo,
                   "Estado" => $estado,
                   "Status" => "ALTA",
                   "Institucion" => ""
               ]);
               $instructor->save();
               $user->save();
               $administradores = ClienteAdministrador::all()->where('id_persona','=',$request->input('idCA2'))->first();
               $instructores =  $administradores->instructores()->paginate(10);
               $this->dispatch(new SendEmails([$email], null, 'emails.bienvenido', 'Bienvenido a Byond'));
               return redirect("/usuario/instructores/".$administradores->id_persona)->with('administradores', $administradores)->with('instructores', $instructores);
            }

    function emails(Request $request) {
        $emails = $request->emails;
        $user = Auth::user();
        $this->dispatch(new SendEmails($emails, $user->cliente_administrador->codigo, 'emails.invitacion', 'Completa tu registro de Byond'));

        return response()->json([
            'success' => true
        ]);
    }


}
