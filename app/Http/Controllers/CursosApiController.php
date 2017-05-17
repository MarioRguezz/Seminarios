<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursosApiController extends Controller
{

    /**
     * get: Cursos
     * params:[api_token].
     * Devuelve la lista de cursos de acuerdo al token de API enviado.
     * @param Request $request
     */
    function get(Request $request) {
        $user = Auth::guard('api')->user();
        $cursos = null;
        $errors = [];
        if(isset($user)) {
            $cursos = $user->cursos;
        }
        else {
            $errors[] = "Usuario no encontrado";
        }
        return response()->json(array(
            'success' => true,
            'errors' => $errors,
            'status' => 200,
            'data' => $cursos
        ));

    }
}
