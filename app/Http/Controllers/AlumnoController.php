<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AlumnoController extends Controller
{
    
    function misCursos(Request $request) {
        $user = Auth::user();
        $alumno = $user->alumno;
        return view('usuario.miscursos', ['alumno' => $alumno]);
    }
}
