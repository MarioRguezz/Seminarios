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
    </style>
</head>

<body class="backgroundPrincipal">
<input type="hidden" id="_url" value="{{url('/')}}">
<!--	FIN	Menu en el Encabezado	-->


<div class="Menu">
    <div class="col-md-4" >
        <a class="SubtitlewhiteClass NoShadow WithTop" href="">Menú principal</a>
    </div>
    <div class="col-md-offset-4 col-md-4 ">
        <a class="SubtitlewhiteClass NoShadow WithTop" href="{{url('/logout')}}">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<!--<div class="contenedor2"> -->
<div class="contenedorMain">

    @if($band == 2)

    <center>
        <h1 class="whiteClass2">OPCIONES PARA EL ALUMNO</h1>
    </center>

    <br><br>

    <center>
        <table width="80%">
            <tr>
                <td width="40%">
                    <center><h3 class="SubtitleMainwhiteClass">Consulta tus cursos</h3></center>
                </td>
                <td width="40%">
                    <center><h3 class="SubtitleMainwhiteClass">Cursos disponibles</h3></center>
                </td>
            </tr>


            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td width="40%">
                    <center>
                        <a href="{{url('/pages/MisCursos.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAlumno-01.png')}}" width="180" height="180"  alt="Consulta de curso"/></a>
                    </center>
                </td>

                <td width="40%">
                    <center>
                        <a href="{{url('/pages/CursosDisponibles.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAlumno-02.png')}}" width="180" height="180"  alt="Inscribir en un curso"/></a>
                    </center>
                </td>
            </tr>
        </table>
    </center>
@if($band == 4)
<center>
    <h1 class="whiteClass2">OPCIONES PARA EL CLIENTE ADMINISTRADOR</h1>
</center>

<br><br>

<center>
    <table width="80%">
        <tr>
            <td width="40%">
                <center><h3 class="SubtitleMainwhiteClass">Consulta tus alumnos</h3></center>
            </td>
            <td width="40%">
                <center><h3 class="SubtitleMainwhiteClass">Consultar tus estudiantes</h3></center>
            </td>
        </tr>


        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td width="40%">
                <center>
                    <a href="{{url('/pages/MisCursos.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAlumno-01.png')}}" width="180" height="180"  alt="Consulta de curso"/></a>
                </center>
            </td>

            <td width="40%">
                <center>
                    <a href="{{url('/pages/CursosDisponibles.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAlumno-02.png')}}" width="180" height="180"  alt="Inscribir en un curso"/></a>
                </center>
            </td>
        </tr>
    </table>
</center>
  @endif
    @endif
    @if($band == 1)

    <center>
        <h1 class="whiteClass2">OPCIONES PARA EL INSTRUCTOR</h1>
    </center>

    <br><br>

    <center>
        <table width="100%">
            <tr>
                <td width="50%">
                    <center><h3 class="SubtitleMainwhiteClass">Consulta y edita tus cursos</h3></center>
                </td>
                <td width="50%">
                    <center><h3 class="SubtitleMainwhiteClass">Alta de curso</h3></center>
                </td>
            </tr>


            <tr>
            </tr>

            <tr>

                <td width="40%">
                    <center>
                        <a href="{{url('/pages/MisCursosInstructor.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-02.png')}}" width="180" height="180" alt="Consulta de curso"/></a>
                    </center>
                </td>

                <td width="40%">
                    <center>
                        <a href="{{url('/pages/AltaCurso.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-03.png')}}" width="180" height="180"  alt="Dar de alta un curso"/></a>
                    </center>
                </td>
            </tr>
        </table>
    </center>

    @endif

    @if($band == 3)

    <center>
        <h1 class="whiteClass2">OPCIONES PARA EL ADMINISTRADOR</h1>
    </center>


    <center>
        <table  class="littlemargin" width="100%">
            <tr>
                 <td >
                  <center><h3 class="SubtitleMainwhiteClass">Dashboard Cursos</h3></center>
                  </td>
                 <td >
                  <center><h3 class="SubtitleMainwhiteClass">Dashboard Licencias</h3></center>
                  </td>
                  <td>
                   <center><h3 class="SubtitleMainwhiteClass">Dashboard Administrador</h3></center>
                   </td>


            <tr>
                  <td>
                  <center>
                  <a href="{{url('/dashboard/index')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-02.png')}}" width="180" height="180"   alt="Dashboard Cursos"/></a>
                  </center>
                  </td>

                  <td>
                  <center>
                  <a href="{{url('/dashboard/dashboard')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-02.png')}}" width="180" height="180"  alt="Dashboard Licencias"/></a>
                  </center>
                  </td>
                  <td>
                  <center>
                  <a href="{{url('/dashboard/administrador')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-02.png')}}" width="180" height="180"  alt="Dashboard Licencias"/></a>
                  </center>
                  </td>

            </tr>


            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>

                <td>
                    <center><h3 class="SubtitleMainwhiteClass">Aprobar solicitudes</h3></center>
                </td>

                <td>
                    <center><h3 class="SubtitleMainwhiteClass">Cargado con email</h3></center>
                </td>

                <td>
                    <center><h3 class="SubtitleMainwhiteClass">Administradores</h3></center>
                </td>
            </tr>

            <tr>
                <td>
                    <center>
                        <a href="{{url('/pages/Pendientes.php')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-04.png')}}" width="180" height="180"  alt="Aprobar solicitud"/></a>
                    </center>
                </td>
                <td>
                    <center>
                        <a href="{{url('/csv/SubirCSV')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-04.png')}}" width="180" height="180"  alt="Cargado con email"></a>
                    </center>
                </td>

                <td>
                    <center>
                        <a href="{{url('/usuario/administradores')}}" target="_self"> <img src="{{url('/img/Icons/Png/PrincipalAdmin-04.png')}}" width="180" height="180"  alt="Administradores"></a>
                    </center>
                </td>
            </tr>
        </table>
    </center>

    @endif

</div> <!-- Fin del div principal -->

<br><br><br><br>
<br><br>
</body>

</html>
