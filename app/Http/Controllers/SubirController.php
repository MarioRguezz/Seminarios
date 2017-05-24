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

class SubirController extends Controller
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




    public function subircsv(Request $request){
      $administrador = Auth::user()->cliente_administrador;
      $administrador->restante =  $administrador->no_licencias - (count($administrador->alumnos)+count($administrador->instructores));

            return view('csv.index', ['administrador' => $administrador]);
    }




}
