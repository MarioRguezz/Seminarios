<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * prefijo: usuario
 * referencia: UserApiController
 * Funciones de API para el usuario. Inicio de sesión, etc.
 */
Route::group(['prefix'=>'usuarios', 'middleware' => 'auth:api'], function(){
    Route::post('login', "UserApiController@login");
});


Route::group(['prefix' => 'cursos', 'middleware' => 'auth:api'], function() {
    Route::get('get', 'CursosApiController@get');
});

Route::group(['prefix' => 'temas', 'middleware' => 'auth:api'], function() {
    Route::get('get', 'TemasApiController@get');
    Route::get('subtemas', 'TemasApiController@subtemas');
    Route::get('examen', 'TemasApiController@examen');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



