<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use App\Http\Controllers\ImageController;
use Carbon\Carbon;
use Mail;
use Validator;

class UserApiController extends Controller
{

  /**
   * login
   * Params: [email, password].
   * Método de autenticación de usuario, recibe el email y password
   * que compara contra la base de datos y devuelve la instancia correcta
   * de User o un error.
   * @param  Request $request [JSON con email y password]
   * @return [User]           [Devuelve el usuario logueado]
   */
  public function login(Request $request){
    $email = $request->input('email');
    $password = $request->input('password');

    $response = [];
    if (Auth::once(['email' => $email, 'password' => $password ])) {
        $user = Auth::user();
        $user->Mat_Alumno = $user->alumno->Mat_Alumno;
        $response['data'] = $user;
        $response['status'] = 200;
        $response['success'] = true;
    }else{
        $response['errors'][] = "Las credenciales del usuario no son válidas";
        $response['status'] = 500;
        $response['success'] = false;
    }

    return response()->json(
        $response
    );
  }

}
