<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$TipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];


if(isset($_SESSION['tipoP']))
{
}
else
{
	echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';
	echo "<script>location.href='login.php'</script>";
}
	$conexia = conect();
	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysqli_query($conexia,$queryxe);
//	$resultadoses = mysql_query($queryxe);
	$rowses = mysqli_fetch_array($resultadoses);
//	$rowses = mysql_fetch_array($resultadoses);
	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
	}
$band = 0;

//if($_SESSION['tipoP'] == "Instructor")
if($TipoPer == "Instructor")
{
				$band = 1;
}

//if($_SESSION['tipoP'] == "Alumno")
if($TipoPer == "Alumno")
{
		$band = 2;
}

//if($_SESSION['tipoP'] == "Administrador")
if($TipoPer == "Administrador")
{
				$band = 3;
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Principal</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
    <link href="../css/radiocss.css" rel="stylesheet" />

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/inicio.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/efectos.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="../js/spinner.js"></script>

    <script src="../js/autcomp.js"></script>

    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

	<style>
		 html{
			 height: 100%;
		 }
	</style>
</head>

<body class="backgroundPrincipal">

<!--	FIN	Menu en el Encabezado	-->


<div class="Menu">
		<div class="col-md-1" >
			<a class="SubtitlewhiteClass NoShadow WithTop" href="#">Menú</a>
		</div>
    <div class="col-md-3" >
    	<a class="SubtitlewhiteClass NoShadow WithTop" href="principal.php">Menú principal</a>
    </div>
    <div class="col-md-2 col-md-offset-6">
        <a class="SubtitlewhiteClass NoShadow WithTop" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<!--<div class="contenedor2"> -->
<div class="contenedorMain">

<?PHP

if($band == 2)
{
?>

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
    <a href="MisCursos.php" target="_self"> <img src="../img/Icons/Png/PrincipalAlumno-01.png" width="180" height="180"  alt="Consulta de curso"/></a>
    </center>
    </td>

    <td width="40%">
    <center>
    <a href="CursosDisponibles.php" target="_self"> <img src="../img/Icons/Png/PrincipalAlumno-02.png" width="180" height="180"  alt="Inscribir en un curso"/></a>
    </center>
    </td>
</tr>
</table>
</center>

<?PHP
}

if($band == 1)
{
?>

<center>
<h1 class="whiteClass2">OPCIONES PARA EL INSTRUCTOR</h1>
</center>

<br><br>

<center>
<table width="80%">
<tr>
    <td width="40%">
    <center><h3 class="SubtitleMainwhiteClass">Consulta y edita tus cursos</h3></center>
    </td>
    <td width="40%">
    <center><h3 class="SubtitleMainwhiteClass">Alta de curso</h3></center>
    </td>
</tr>


<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>

    <td width="40%">
    <center>
    <a href="MisCursosInstructor.php" target="_self"> <img src="../img/Icons/Png/PrincipalAdmin-02.png" width="180" height="180" alt="Consulta de curso"/></a>
    </center>
    </td>

    <td width="40%">
    <center>
    <a href="AltaCurso.php" target="_self"> <img src="../img/Icons/Png/PrincipalAdmin-03.png" width="180" height="180"  alt="Dar de alta un curso"/></a>
    </center>
    </td>
</tr>
</table>
</center>

<?PHP
}

if($band == 3)
{
?>

<center>
<h1 class="whiteClass2">OPCIONES PARA EL ADMINISTRADOR</h1>
</center>

<br><br>

<center>
<table width="80%">
<tr>
    <td width="20%">
    <center><h3 class="SubtitleMainwhiteClass">Consulta y edita tus cursos</h3></center>
    </td>
    <td width="20%">
    <center><h3 class="SubtitleMainwhiteClass">Alta de curso</h3></center>
    </td>
    <td width="20%">
    <center><h3 class="SubtitleMainwhiteClass">Aprobar solicitud</h3></center>
    </td>
</tr>


<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td width="20%">
    <center>
    <a href="CursoTemaInstructor.php" target="_self"> <img src="../img/Icons/Png/PrincipalAdmin-02.png" width="180" height="180"   alt="Consulta de curso"/></a>
    </center>
    </td>

    <td width="20%">
    <center>
    <a href="AltaCurso.php" target="_self"> <img src="../img/Icons/Png/PrincipalAdmin-03.png" width="180" height="180"  alt="Dar de alta un curso"/></a>
    </center>
    </td>

    <td width="20%">
    <center>
    <a href="Pendientes.php" target="_self"> <img src="../img/Icons/Png/PrincipalAdmin-04.png" width="180" height="180"  alt="Aprobar solicitud"/></a>
    </center>
    </td>
</tr>
</table>
</center>

<?PHP
}
?>

</div> <!-- Fin del div principal -->

<br><br><br><br>
<br><br>
</body>

</html>
