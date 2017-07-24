<?php

namespace App\Http\Controllers;

use App\Curso;
use App\SubtemaVisto;
use App\ClienteAdministrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use Auth;



class ReportesController extends Controller
{
    /**
     * Nueva instancia del controlador, permite que no se utilice esta sesión a menos que se esté logueado.
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
        // $this->middleware('auth.admin');
    }

     /**
      * Función que genera un excel de cursos
      * @param Request $request
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
      */
     public function generaExcel(Request $request){
         $total= 0;
         $cursos = Curso::where('estatus','=','ALTA')->get();
         foreach($cursos as $curso){
           foreach($curso->temas as $tema){
             $total += count($tema->subtemas);
           }
             $curso->totalSubtemas = $total;
           foreach($curso->alumnos as $alumno){
             $subtemasvistos = SubtemaVisto::all()->where('id_Curso','=', $alumno->pivot->id_Curso)->where('Mat_Alumno','=', $alumno->Mat_Alumno)->where('Visto','!=','0');
             $alumno->subtemasVistos = count($subtemasvistos);

             if($curso->totalSubtemas == null ){
               $curso->totalSubtemas = 0;
             }else{
             $alumno->totalSubtemas = $curso->totalSubtemas;
           }
           if($alumno->subtemasVistos != 0){
             $alumno->porcentaje =  ($alumno->subtemasVistos*100) / $alumno->totalSubtemas;
           }else{
             $alumno->porcentaje = 0;
           }
             foreach($alumno->datos as $datos){
             }
         }
       }


         $html = '<style>table {border-collapse: collapse;} table, th, td {border: 1px solid black;}</style><table class="table" bordered="1"><tr>';
         $html.= '<th>Curso</th> <th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th> <th>Email</th> <th>Progreso</th></tr>';
         if(count($cursos) != 0) {
          foreach ($cursos as $curso){
           $html .= "<tr>";
              $html .= "<td>" . $curso->nombre . "</td>";
              $html .= "<td></td>";
              $html .= "<td></td>";
              $html .= "<td></td>";
              $html .= "<td></td>";
              $html .= "<td></td>";
          $html .= "</tr>";
            foreach ($curso->alumnos as $alumno){
             $html .= "<tr>";
                $html .= "<td></td>";
                $html .= "<td>" . $alumno->datos['Nombre']  . "</td>";
                $html .= "<td>" . $alumno->datos['APaterno'] . "</td>";
                $html .= "<td>" . $alumno->datos['AMaterno'] . "</td>";
                $html .= "<td>" . $alumno->datos['email'] . "</td>";
                $html .= "<td>" .  $alumno->porcentaje . "</td>";
             $html .= "</tr>";
          }
        }
            $html .='</table>';
          //  header("Content-Type: application/xls");
          $utf8_output_with_bom = chr(239) . chr(187) . chr(191) . $html;

            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header("Content-Disposition: attachment; filename=cursos.xls");
            echo $utf8_output_with_bom;
          }
        }
        /**
         * Función que genera un excel de licencias
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function generarLicencias(Request $request){
                $clientesAdministradores = ClienteAdministrador::get();
            $html = '<style>table {border-collapse: collapse;} table, th, td {border: 1px solid black;}</style><table class="table" bordered="1"><tr>';
            $html.= '<th>Tipo de Usuario</th> <th>Nombre</th><th>Apellidos</th><th>Email</th> <th>Fecha vigencia</th> <th>No. de licencias</th></tr>';
            if(count($clientesAdministradores) != 0) {
             $html .= "<tr>";
                $html .= "<td style='font-weight: bold;'>Cliente Administrador</td>";
                $html .= "<td></td>";
                $html .= "<td></td>";
                $html .= "<td></td>";
                $html .= "<td></td>";
                $html .= "<td></td>";
            $html .= "</tr>";
             foreach ($clientesAdministradores as $clienteAdministrador){
                $html .= "<tr>";
                   $html .= "<td></td>";
                   $html .= "<td>" . $clienteAdministrador->datos->Nombre  . "</td>";
                   $html .= "<td>" .$clienteAdministrador->datos->APaterno." ".$clienteAdministrador->datos->AMaterno  . "</td>";
                   $html .= "<td>" . $clienteAdministrador->datos->email . "</td>";
                   $html .= "<td>" . $clienteAdministrador->fecha_expiracion . "</td>";
                   $html .= "<td>" .  $clienteAdministrador->no_licencias. "</td>";
                $html .= "</tr>";

           }
               $html .='</table>';
             //  header("Content-Type: application/xls");
             $utf8_output_with_bom = chr(239) . chr(187) . chr(191) . $html;

               header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
               header("Content-Disposition: attachment; filename=licencias.xls");
               echo $utf8_output_with_bom;
             }
           }


                      /**
                       * Función que genera un excel de administrador
                       * @param Request $request
                       * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
                       */
                      public function generarClienteadministrador(Request $request){
                        $cve_usuario = $request->input('cve_usuario');
                        $clientesAdministradores = ClienteAdministrador::where('id_persona','=',$cve_usuario)->get();
                          $html = '<style>table {border-collapse: collapse;} table, th, td {border: 1px solid black;}</style><table class="table" bordered="1"><tr>';
                          $html.= '<th>Tipo de Usuario</th> <th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th> <th>Email</th></tr>';
                          if(count($clientesAdministradores) != 0) {
                            foreach ($clientesAdministradores as $clienteAdministrador){
                            $var = 0;
                            $html .= "<tr>";
                               $html .= "<td style='font-weight: bold;'>Instructores</td>";
                               $html .= "<td></td>";
                               $html .= "<td></td>";
                               $html .= "<td></td>";
                               $html .= "<td></td>";
                           $html .= "</tr>";
                              foreach ($clienteAdministrador->instructores as $instructor){
                           $html .= "<tr>";
                              $html .= "<td></td>";
                              $html .= "<td>".$instructor->datos['Nombre'] ."</td>";
                              $html .= "<td>".$instructor->datos['APaterno']."</td>";
                              $html .= "<td>".$instructor->datos['AMaterno']."</td>";
                              $html .= "<td>".$instructor->datos['email'] ."</td>";
                          $html .= "</tr>";
                         }
                         foreach ($clienteAdministrador->alumnos as $alumno){
                           if($var == 0){
                             $html .= "<tr>";
                                $html .= "<td style='font-weight: bold;'>Alumnos</td>";
                                $html .= "<td></td>";
                                $html .= "<td></td>";
                                $html .= "<td></td>";
                                $html .= "<td></td>";
                             $html .= "</tr>";
                           }

                           $html .= "<tr>";
                              $html .= "<td></td>";
                              $html .= "<td>".$alumno->datos['Nombre']."</td>";
                              $html .= "<td>".$alumno->datos['APaterno']."</td>";
                              $html .= "<td>".$alumno->datos['AMaterno']."</td>";
                              $html .= "<td>".$alumno->datos['email']."</td>";
                          $html .= "</tr>";
                          $var++;
                        }
                      }
                    }
                             $html .='</table>';
                           //  header("Content-Type: application/xls");
                           $utf8_output_with_bom = chr(239) . chr(187) . chr(191) . $html;

                             header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
                             header("Content-Disposition: attachment; filename=administrador.xls");
                             echo $utf8_output_with_bom;
                         }


                         /**
                          * Función que genera un excel de cursos
                          * @param Request $request
                          * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
                          */
                         public function generaCursoCA(Request $request){
                           $total= 0;
                            $cursosarray = [] ;
                             $clienteAdministrador = ClienteAdministrador::where('id_persona','=',Auth::user()->IdPersona)->get()->first();
                             foreach ($clienteAdministrador->instructores as $instructor){
                                 $var = DB::select('select id_Curso from curso_instructor where Mat_Usuario = :id', ['id' => $instructor->Mat_Usuario]);
                                 if($var != null){
                                      foreach ($var as $id_curso){
                                          $cursovar = DB::select('select * from curso where id_Curso = :id_Curso', ['id_Curso' => $id_curso->id_Curso]);
                                          $cursos = new Curso();
                                          $cursos->id_Curso = $cursovar[0]->id_Curso;
                                          $cursos->nombre = $cursovar[0]->nombre;
                                          $cursos->estatus = $cursovar[0]->estatus;
                                          $cursosarray[] = $cursos;
                                      }
                                 }
                             }
                             foreach($cursosarray as $curso){
                               foreach($curso->temas as $tema){
                                 $total += count($tema->subtemas);
                               }
                                 $curso->totalSubtemas = $total;
                               foreach($curso->alumnos as $alumno){
                                 $subtemasvistos = SubtemaVisto::all()->where('id_Curso','=', $alumno->pivot->id_Curso)->where('Mat_Alumno','=', $alumno->Mat_Alumno)->where('Visto','!=','0');
                                 $alumno->subtemasVistos = count($subtemasvistos);

                                 if($curso->totalSubtemas == null ){
                                   $curso->totalSubtemas = 0;
                                 }else{
                                 $alumno->totalSubtemas = $curso->totalSubtemas;
                               }
                               if($alumno->subtemasVistos != 0){
                                 $alumno->porcentaje =  ($alumno->subtemasVistos*100) / $alumno->totalSubtemas;
                               }else{
                                 $alumno->porcentaje = 0;
                               }

                                 foreach($alumno->datos as $datos){
                                 }
                             }
                           }
                             $html = '<style>table {border-collapse: collapse;} table, th, td {border: 1px solid black;}</style><table class="table" bordered="1"><tr>';
                             $html.= '<th>Curso</th> <th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th> <th>Email</th> <th>Progreso</th></tr>';
                             if(count($cursosarray) != 0) {
                              foreach ($cursosarray as $curso){
                               $html .= "<tr>";
                                  $html .= "<td>" . $curso->nombre . "</td>";
                                  $html .= "<td></td>";
                                  $html .= "<td></td>";
                                  $html .= "<td></td>";
                                  $html .= "<td></td>";
                                  $html .= "<td></td>";
                              $html .= "</tr>";
                                foreach ($curso->alumnos as $alumno){
                                 $html .= "<tr>";
                                    $html .= "<td></td>";
                                    $html .= "<td>" . $alumno->datos['Nombre']  . "</td>";
                                    $html .= "<td>" . $alumno->datos['APaterno'] . "</td>";
                                    $html .= "<td>" . $alumno->datos['AMaterno'] . "</td>";
                                    $html .= "<td>" . $alumno->datos['email'] . "</td>";
                                    $html .= "<td>" .  $alumno->porcentaje . "</td>";
                                 $html .= "</tr>";
                              }
                            }
                                $html .='</table>';
                              //  header("Content-Type: application/xls");
                              $utf8_output_with_bom = chr(239) . chr(187) . chr(191) . $html;

                                header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
                                header("Content-Disposition: attachment; filename=cursos.xls");
                                echo $utf8_output_with_bom;
                              }
                            }
























                       }
