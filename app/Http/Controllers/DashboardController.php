<?php

namespace App\Http\Controllers;

use App\User;
use App\Alumno;
use App\Curso;
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
            $cursos = Curso::all()->where('estatus','=','ALTA');
            foreach($cursos as $curso){
              /*foreach($curso->temas as $tema){
                $curso->count($tema->subtemas);
              }*/
              foreach($curso->alumnos as $alumno){
                foreach($alumno->datos as $datos){
                }
            }
          }
        //    count($repartidor[4]->temas[0]->subtemas)
          //  $subtemavisto = SubtemaVisto::all()->where('id_Curso','=',)->where('Mat_Alumno','=',)->where('Visto','!=','0');

            return view('dashboard.index',['cursos' => $cursos]);
    }

      /*

          $queryTotal = "SELECT * FROM curso_subtema CS JOIN curso_tema CT ON CS.id_Tema = CT.id_Tema WHERE CT.id_Curso = '$row[id_Curso]';";
          $resultadoTotal = mysqli_query($conex, $queryTotal);
          $TotalSub = mysqli_num_rows($resultadoTotal);
          $sqlx = "SELECT * FROM subtema_visto WHERE  = '$row[id_Curso]' AND Mat_Alumno = '$row[Mat_Alumno]' AND Visto != '0';";
          $resulx = mysqli_query($conex, $sqlx);
          $TotalVisto = mysqli_num_rows($resulx);

          $Regla3 = ($TotalVisto * 100) / $TotalSub;

       */
    public function dashboard(Request $request){
            $cursos = Curso::all()->where('estatus','=','ALTA');
            $users = Alumno::all();
            //$repartidor[6]->alumnos[0]->pivot->id_Curso  $repartidor[4]->alumnos[0]->datos
            foreach($cursos as $curso){
              foreach($curso->alumnos as $alumno){
                foreach($alumno->datos as $datos){
                }
            }
          }
            return view('dashboard.dashboard',['cursos' => $cursos]);
    }

    public function administrador(Request $request){
            $cursos = Curso::all()->where('estatus','=','ALTA');
            $users = Alumno::all();
            //$repartidor[6]->alumnos[0]->pivot->id_Curso  $repartidor[4]->alumnos[0]->datos
            foreach($cursos as $curso){
              foreach($curso->alumnos as $alumno){
                foreach($alumno->datos as $datos){
                }
            }
          }
            return view('dashboard.administrador',['cursos' => $cursos]);
    }





}
