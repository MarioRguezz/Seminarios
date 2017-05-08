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
            $users = Alumno::all();
            //$repartidor[6]->alumnos[0]->pivot->id_Curso  $repartidor[4]->alumnos[0]->datos
            foreach($cursos as $curso){
              foreach($curso->alumnos as $alumno){
                foreach($alumno->datos as $datos){
                }
            }
          }
            return view('dashboard.index',['cursos' => $cursos]);
    }




}
