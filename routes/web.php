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



Auth::routes();


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
    Route::get('administradores', 'UserController@administradoresView');
    Route::get('editar/{cve_usuario}', 'UserController@editarView');
    Route::get('editar', 'UserController@editaremptyView');
    Route::post('editarregistro', 'UserController@editarRegistro');
    Route::post('nuevoregistro', 'UserController@NuevoRegistro');
<<<<<<< HEAD
    Route::get('alumnos/{cve_usuario}', 'UserController@listaalumnoView');
    Route::get('alumnosedicion/{cve_usuario}/{cve_ca}', 'UserController@editarAlumnoView');
    Route::get('alumnonuevo/{cve_ca}/{cve_ca2}', 'UserController@alumnoView');
    Route::post('nuevoalumnoregistro', 'UserController@nuevoAlumnoRegistro');
    Route::post('editaralumnoregistro', 'UserController@editarAlumnoRegistro');
    Route::get('instructores/{cve_usuario}', 'UserController@listainstructorView');
    Route::get('instructoresedicion/{cve_usuario}/{cve_ca}', 'UserController@editarInstructorView');
    Route::get('instructornuevo/{cve_ca}/{cve_ca2}', 'UserController@instructorView');
    Route::post('nuevoinstructorregistro', 'UserController@nuevoInstructorRegistro');
    Route::post('editarinstructorregistro', 'UserController@editarInstructorRegistro');
=======
    Route::post('emails', 'UserController@emails');
>>>>>>> 7d7c2fb307257b33d09a6ae41cbcfbc4b798b857

});


Route::post('validar', 'UserController@validar');


/**
 * prefijo: actividad
 * referencia: ExamenController
 * Funciones de actividad para su creación.
 */

Route::group(['prefix'=>'actividad'], function(){
    Route::get('creacion', "ExamenController@examenDatos");
    Route::post('guardar', "ExamenController@guardar");
    Route::post('contestar', 'ExamenController@actividad');
    Route::post('respuesta', 'ExamenController@respuesta');
});




/**
 * prefijo: examen
 * referencia: ExamenController
 * Funciones de examen para su creación.
 */

Route::group(['prefix'=>'examen'], function(){
    Route::get('creacion', "ExamenController@examenDatos");
    Route::post('guardar', "ExamenController@guardar");
    Route::post('examen_alumno', 'ExamenController@examen');
    Route::post('respuesta', 'ExamenController@respuesta');
    Route::get('diploma/{cve_alumno}/{cve_tema}', 'ExamenController@diploma');
});



/**
 * prefijo: dashboard
 * referencia: DashboardController
 * Funciones de examen para su creación.
 */

Route::group(['prefix'=>'dashboard'], function(){
    Route::get('index', "DashboardController@index");
    Route::get('dashboard', "DashboardController@dashboard");
    Route::get('administrador', "DashboardController@administrador");
    Route::get('clientedashboard/{cve_usuario}', "DashboardController@clientedashboard");
});


/**
 * prefijo: csv
 * referencia: DashboardController
 * Funciones de examen para su creación.
 */

Route::group(['prefix'=>'csv'], function(){
    Route::get('SubirCSV', "SubirController@subircsv");
});
