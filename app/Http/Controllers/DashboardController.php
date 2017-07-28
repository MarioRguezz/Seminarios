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

use Illuminate\Support\Facades\Input;use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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
            $cursos = Curso::where('estatus','=','ALTA')->paginate(5);
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
            return view('dashboard.clienteadministrador',['clientesAdministradores' => $clientesAdministradores,'cve_usuario' => $cve_usuario ]);
    }


    public function cursoscadashboard(Request $request){
      $total= 0;
       $cursosarray = [] ;
        $clienteAdministrador = ClienteAdministrador::where('id_persona','=',Auth::user()->IdPersona)->get()->first();
        foreach ($clienteAdministrador->instructores as $instructor){
            $var = DB::select('select id_Curso from curso_instructor where Mat_Usuario = :id', ['id' => $instructor->Mat_Usuario]);
            if($var != null){
                 foreach ($var as $id_curso){
                     $cursovar = DB::select('select * from curso where id_Curso = :id_Curso', ['id_Curso' => $id_curso->id_Curso]);
                     $cursos = new Curso();
                     $cursos->id_Curso = $cursovar[0]->id_Curso;
                     $cursos->nombre = $cursovar[0]->nombre;
                     $cursos->estatus = $cursovar[0]->estatus;
                     $cursosarray[] = $cursos;
                 }
            }
        }

        foreach($cursosarray as $curso){
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

        return view('dashboard.cursocliente',['cursos' => $this->paginate($cursosarray,5)]);
    }


public function paginate($items,$perPage)
{
    $pageStart = \Request::get('page', 1);
    // Start displaying items from this number;
    $offSet = ($pageStart * $perPage) - $perPage; 

    // Get only the items you need using array_slice
    $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

    return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
}




}
