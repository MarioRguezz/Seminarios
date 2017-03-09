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
   * Método de autenticación de usuario, recibe el email y password
   * que compara contra la base de datos y devuelve la instancia correcta
   * de User o un error.
   * @param  Request $request [JSON con email y password]
   * @return [User]           [Devuelve el usuario logueado]
   */
  /*public function authenticate(Request $request){
    $email = $request->input('email');
    $password = $request->input('password');
    $errors = ["bad.login"];
    if (Auth::once(['email' => $email, 'password' => $password ])) {
      return Auth::user();
    }

    return response()->json([
      "success"=>"false",
      "error" => $errors
    ]);
  }*/

/*  public function authenticate(Request $request){
    $email = $request->input('email');
    $password = $request->input('password');
    $errors = ["bad.login"];
    if($UserExist =User::where('email', '=', $email)->first()){
      if($UserExist->password == $password){
        return $UserExist;
      }
  }
    return response()->json([
      "success"=>"false",
      "error" => $errors
    ]);
  }*/

  public function authenticate(Request $request){
      $UserExist =User::where('email', '=', 'ponlecoco@hotmail.com')->first();
          echo $UserExist;
    }
}
