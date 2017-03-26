<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
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
            return view('examen.examenCreacion');
        }else {
            return view('login', array('res' => 2));
        }
    }


}

