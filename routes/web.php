<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', 'UserController@index');
Route::post('/login', 'UserController@login');
Route::get('/testuser','UserController@checkuser');




/**
 * prefijo: usuario
 * referencia: UserApiController
 * Funciones de API para el usuario. Inicio de sesión, etc.
 */
Route::group(['prefix'=>'usuario'], function(){
    Route::post('authenticate', "UserApiController@authenticate");
    Route::post('create', "UserApiController@create");
    Route::post('by_phone', "UserApiController@getUserByPhone");
    Route::get('search', 'UserApiController@search');
    Route::get('registro', 'UserController@registroView');
    Route::post('registro', 'UserController@registrar');
});


