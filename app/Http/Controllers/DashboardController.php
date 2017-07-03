<?php

namespace App\Http\Controllers;

use App\User;
use App\Alumno;
use App\Curso;
use App\ClienteAdministrador;
use App\SubtemaVisto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\DeclareDeclare;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
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
          $total= 0;
            $cursos = Curso::where('estatus','=','ALTA')->paginate(10);
            foreach($cursos as $curso){
              foreach($curso->temas as $tema){
                $total += count($tema->subtemas);
              }
                $curso->totalSubtemas = $total;
              foreach($curso->alumnos as $alumno){
                $subtemasvistos = SubtemaVisto::all()->where('id_Curso','=', $alumno->pivot->id_Curso)->where('Mat_Alumno','=', $alumno->Mat_Alumno)->where('Visto','!=','0');
                $alumno->subtemasVistos = count($subtemasvistos);

                if($curso->totalSubtemas == null ){
                  $curso->totalSubtemas = 0;
                }else{
                $alumno->totalSubtemas = $curso->totalSubtemas;
              }
              if($alumno->subtemasVistos != 0){
                $alumno->porcentaje =  ($alumno->subtemasVistos*100) / $alumno->totalSubtemas;
              }else{
                $alumno->porcentaje = 0;
              }

                foreach($alumno->datos as $datos){
                }
            }
          }
        //    count($repartidor[4]->temas[0]->subtemas)
          //  $subtemavisto = SubtemaVisto::all()->where('id_Curso','=',)->where('Mat_Alumno','=',)->where('Visto','!=','0');

            return view('dashboard.index',['cursos' => $cursos]);
    }


    public function dashboard(Request $request){
          $clientesAdministradores = ClienteAdministrador::paginate(10);
            return view('dashboard.dashboard',['clientesAdministradores' => $clientesAdministradores]);
    }

    public function administrador(Request $request){
          $clientesAdministradores = ClienteAdministrador::paginate(5);
            return view('dashboard.administrador',['clientesAdministradores' => $clientesAdministradores]);
    }

    public function clientedashboard(Request $request, $cve_usuario){
        $clientesAdministradores = ClienteAdministrador::where('id_persona','=',$cve_usuario)->paginate(10);
            return view('dashboard.clienteadministrador',['clientesAdministradores' => $clientesAdministradores]);
    }




}
