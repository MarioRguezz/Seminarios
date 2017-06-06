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
use App\ClienteAdministrador;

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

        $now = Carbon::now('America/Mexico_City');
        $user = Auth::user();
        $user->Mat_Alumno = $user->alumno->Mat_Alumno;

        if($user->TUser == "Instructor" ){
        $ca = ClienteAdministrador::where("id", $user->instructor->id_cliente_administrador)->get()->first();
          if($now >= $ca->fecha_expiracion ){
              $response['errors'][] = "La fecha de expiración ha pasado";
          }
          }else if($user->TUser == "Alumno"){
            $ca =   ClienteAdministrador::where("id", $user->alumno->id_cliente_administrador)->get()->first();
            if($now >= $ca->fecha_expiracion ){
              $response['errors'][] = "La fecha de expiración ha pasado";
            }
          } else if($user->TUser == "AdminCliente" && $now >= $user->cliente_administrador->fecha_expiracion){
              $response['errors'][] = "La fecha de expiración ha pasado";
        }

        if(isset($response['errors'])) {
          $response['data'] = null;
          $response['status'] = 500;
          $response['success'] = false;
        } else {
          $response['data'] = $user;
          $response['status'] = 200;
          $response['success'] = true;
        }
    }else{
        $response['errors'][] = "Las credenciales del usuario no son válidas";
        $response['status'] = 500;
        $response['success'] = false;
    }

    return response()->json(
        $response
    );
  }

  public function validarFecha() {

  }

}
