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
    <title>
    @yield('titulo')
    </title>

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/passwordval.js')}}"></script>

    <link rel="stylesheet" href="{{url('js/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/Main.css')}}">
    <link href="{{url('css/radiocss.css')}}" rel="stylesheet" />

    <script src="{{url('js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/inicio.js')}}"></script>
    <link rel="{{url('stylesheet" href="css/login.css')}}">
    <script src="{{url('js/efectos.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{url('js/spinner.js')}}"></script>

    <script src="{{url('js/autcomp.js')}}"></script>

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
    @yield('head')
</head>

<body class="backgroundPrincipal" style="height:100%">
<input type="hidden" id="_url" value="{{url('/')}}">
<!--	FIN	Menu en el Encabezado	-->


@include('header')

<!--	FIN	Menu en el Encabezado	-->

<!--<div class="contenedor2"> -->
<div class="contenedorMain" style="height:100%;">

    @include('barra_lateral')

</div> <!-- Fin del div principal -->
</body>

</html>
