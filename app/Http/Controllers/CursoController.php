<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    
    public function alta(Request $request) {
        return view ('cursos.alta');
    } 
}
