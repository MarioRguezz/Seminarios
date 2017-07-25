<?PHP

include 'php/conexion.php';

$accion = $_GET['accion'];

$TipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];


$conexia = conect();
$queryxe = "SELECT * FROM persona WHERE email = '$email';";
$resultadoses = mysqli_query($conexia,$queryxe);
//	$resultadoses = mysqli_query($queryxe);
$rowses = mysqli_fetch_array($resultadoses);
//	$rowses = mysqli_fetch_array($resultadoses);
/*if($rowses['Status'] == "BAJA")
{
    logout();
    echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
    echo "<script>location.href='login.php'</script>";
}
*/

if( !empty( $_REQUEST['Message'] ) ) {
    $mensaje = sprintf( '%s', $_REQUEST['Message'] );
    echo "<script type='text/javascript'>alert('$mensaje');</script>";
}



?>

        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Principal</title>

    <script src="js/jquery.min.js"></script>
    <script src="js/passwordval.js"></script>

    <link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Main.css">
    <link href="css/radiocss.css" rel="stylesheet" />

    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/inicio.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/efectos.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="js/spinner.js"></script>

    <script src="js/autcomp.js"></script>

    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <style>
        html{
            height: 100%;
        }
        body{
          height:100%;
        }
    </style>
</head>

<body class="backgroundPrincipal" style="height:100%">
<input type="hidden" id="_url" value="{{url('/')}}">
<!--	FIN	Menu en el Encabezado	-->


@include('header')

<!--	FIN	Menu en el Encabezado	-->

<!--<div class="contenedor2"> -->
<div class="contenedorMain" style="height:100%;">

    @if($band == 2)

    <div class="titleContainer">
      <div class="titleImg">
        <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/beyond2.png')}}" height="27" width="27">
        <span class="purpleTitle">OPCIONES PARA EL ALUMNO</san>
      </div>
    </div>

    <br><br>

    <center>
        <table class="littlemargin2" width="40%">
            <tr>
                <td>
                    <center><h3 class="SubtitleMainPurpleClass">Consulta tus cursos</h3></center>
                </td>
                <td>
                    <center><h3 class="SubtitleMainPurpleClass">Cursos disponibles</h3></center>
                </td>
            </tr>

            <tr>
                <td>
                    <center>
                        <a href="{{url('/pages/MisCursos.php')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/10.png')}}" width="60" height="60"  alt="Consulta de curso"/></a>
                    </center>
                </td>

                <td>
                    <center>
                        <a href="{{url('/pages/CursosDisponibles.php')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/11.png')}}" width="60" height="60"  alt="Inscribir en un curso"/></a>
                    </center>
                </td>
            </tr>
        </table>
    </center>
      @endif
@if($band == 4)
<div class="row" style="height:auto;" >
  <div class="col-xs-3" style="background-color:#2F302E; height:100%; width:300px; padding-top:100px; z-index:-1000 !important;">
      <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
      </div>
        <div class="col-xs-10 col-xs-offset-1">
          <div class="row" style="margin-bottom:10px; ">
              <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>CLIENTE ADMINISTRADOR</h1>
          </div>
          <div class="row" style="margin-bottom:10px;">
  <a href="{{url('/dashboard/clientedashboard/'.$idPersona)}}">
            <div class="col-xs-10">

                <img src="{{url('/img/byondiconos/BEYOND2-04.png')}}">

            </div>    </a>
            <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div>
           </div>
          <div class="row"  style="margin-bottom:10px;">
              <div class="col-xs-10">
                <img src="{{url('/img/byondiconos/BEYOND2-21.png')}}"  >
             </div>
             <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div>
           </div>
          <div class="row"  style="margin-bottom:10px;">
             <div class="col-xs-10">
                <img src="{{url('/img/byondiconos/BEYOND2-22.png')}}">
             </div>
             <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div>
               </div>
          <div class="row"  style="margin-bottom:10px;">
              <div class="col-xs-10">
             <img src="{{url('/img/byondiconos/BEYOND2-23.png')}}">
             </div>
             <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div>
               </div>
          <div class="row"  style="margin-bottom:10px;">
              <div class="col-xs-10">
             <img src="{{url('/img/byondiconos/BEYOND2-02.png')}}">
             </div>
             <div class="col-xs-1" style="height:125px; margin-bottom: 25px; border-right: 2px solid white;  border-radius: 1px;"> </div>
               </div>
         </div>
  </div>
  <div class="col-md-9">
<center>
    <table  class="littlemargin" width="65%">

        <tr>
            <td>
                <center><h3 class="SubtitleMainPurpleClass">Reporte de usuarios</h3></center>
            </td>
            <td>
                <center><h3 class="SubtitleMainPurpleClass">Consultar tus instructores</h3></center>
            </td>
            <td>
                <center><h3 class="SubtitleMainPurpleClass">Consultar tus alumnos</h3></center>
            </td>
            <td>
                <center><h3 class="SubtitleMainPurpleClass">Cargar lista de alumnos</h3></center>
            </td>
            <td>
             <center><h3 class="SubtitleMainPurpleClass">Dashboard Cursos</h3></center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <a href="{{url('/dashboard/clientedashboard/'.$idPersona)}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/5.png')}}" width="60" height="60"  alt="Reporte de usuarios"/></a>
                </center>
            </td>

            <td>
                <center>
                    <a href="{{url('/usuario/instructores/'.$idPersona)}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/6.png')}}" width="60" height="60"  alt="Consultar tus instructores"/></a>
                </center>
            </td>
            <td>
                <center>
                    <a href="{{url('/usuario/alumnos/'.$idPersona)}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/7.png')}}" width="60" height="60"  alt="Consultar tus alumnos"/></a>
                </center>
            </td>
            <td>
            <center>
                <a href="{{url('/csv/SubirCSV')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/8.png')}}" width="60" height="60"  alt="Consultar tus alumnos"/></a>
            </center>
            </td>
            <td>
            <center>
            <a href="{{url('/dashboard/cursosca')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/1.png')}}" width="60" height="60"   alt="Dashboard Cursos"/></a>
            </center>
            </td>
            </tr>
          </table>
        </center>
      </div>
    </div>
  </div>
    @endif
    @if($band == 1)

    <div class="titleContainer">
      <div class="titleImg">
        <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/beyond2.png')}}" height="27" width="27">
        <span class="purpleTitle">OPCIONES PARA EL INSTRUCTOR</span>
      </div>
    </div>

    <br><br>

    <center>
        <table class="littlemargin2" width="40%">
            <tr>
                <td>
                    <center><h3 class="SubtitleMainPurpleClass">Consulta y edita tus cursos</h3></center>
                </td>
                <td>
                    <center><h3 class="SubtitleMainPurpleClass">Alta de curso</h3></center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="{{url('/pages/MisCursosInstructor.php')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/9.png')}}" width="60" height="60" alt="Consulta de curso"/></a>
                    </center>
                </td>
                <td>
                    <center>
                        <a href="{{url('/pages/AltaCurso.php')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/10.png')}}" width="60" height="60"  alt="Dar de alta un curso"/></a>
                    </center>
                </td>
            </tr>
        </table>
    </center>

    @endif

    @if($band == 3)


        <div    class="titleContainer">
            <div class="titleImg">
              <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/beyond2.png')}}" height="27" width="27">
              <span class="purpleTitle">OPCIONES PARA EL ADMINISTRADOR</span>
            </div>
          </div>


    <center>
        <table  class="littlemargin" width="65%">
            <tr>
                 <td>
                  <center><h3 class="SubtitleMainPurpleClass">Dashboard Cursos</h3></center>
                  </td>
                 <td >
                  <center><h3 class="SubtitleMainPurpleClass">Dashboard Licencias</h3></center>
                  </td>
                  <td>
                   <center><h3 class="SubtitleMainPurpleClass">Dashboard Administrador</h3></center>
                   </td>
                  <!-- <td>
                       <center><h3 class="SubtitleMainPurpleClass">Aprobar solicitudes</h3></center>
                   </td>-->
                   <td>
                       <center><h3 class="SubtitleMainPurpleClass">Administradores</h3></center>
                   </td>

            <tr>
                  <td>
                  <center>
                  <a href="{{url('/dashboard/index')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/1.png')}}" width="60" height="60"   alt="Dashboard Cursos"/></a>
                  </center>
                  </td>

                  <td>
                  <center>
                  <a href="{{url('/dashboard/dashboard')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/2.png')}}" width="60" height="60"  alt="Dashboard Licencias"/></a>
                  </center>
                  </td>
                  <td>
                  <center>
                  <a href="{{url('/dashboard/administrador')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/3.png')}}" width="60" height="60"  alt="Dashboard Licencias"/></a>
                  </center>
                  </td>
              <!--    <td>
                      <center>
                          <a href="{{url('/pages/Pendientes.php')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/4.png')}}" width="60" height="60"  alt="Aprobar solicitud"/></a>
                      </center>
                  </td>-->

                  <td>
                      <center>
                          <a href="{{url('/usuario/administradores')}}" target="_self"> <img src="{{url('/img/Icons/nuevosiconos/5.png')}}" width="60" height="60"  alt="Administradores"></a>
                      </center>
                  </td>
        </table>
    </center>

    @endif

</div> <!-- Fin del div principal -->
</body>

</html>
