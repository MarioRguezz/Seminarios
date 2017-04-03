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

Route::get('/', 'UserController@index')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/login.php', 'UserController@index');
Route::get('/pages/login.php', 'UserController@index');
Route::get('/pages/Registro.php', 'UserController@registroView');
Route::get('/pages/principal.php', 'UserController@index');
Route::post('/login', 'UserController@login');
Route::get('/testuser','UserController@checkuser');
Route::post('/verificarCorreo','UserController@verificarCorreo');




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
    Route::post('status', 'UserController@status');

});


Route::post('validar', 'UserController@validar');




/**
 * prefijo: examen
 * referencia: ExamenController
 * Funciones de examen para su creación.
 */

Route::group(['prefix'=>'examen'], function(){
    Route::get('creacion', "ExamenController@examenDatos");
    Route::post('guardar', "ExamenController@guardar");
});

