<?PHP
include '../php/conexion.php';
require dirname(__DIR__) . '/../vendor/autoload.php';
$app = require dirname(__DIR__) . '/../bootstrap/app.php';
$app->boot();
use \App\User;

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];

if(!isset($_SESSION['tipoP']))
{
	echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';
	echo "<script>location.href='login.php'</script>";
}

if($tipoPer != "Alumno")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo para Alumnos")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();


	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	/*
	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
    }
*/


$Matricula = 0;
$conexia = conect();
	$queryze = "SELECT Mat_Alumno FROM alumno WHERE email = '$email';";
	$resultas = mysqli_query($conexia,$queryze);
	$row = mysqli_fetch_array($resultas);
	$Matricula = $row['Mat_Alumno'];


			/*
			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante";
			$baia = mysqli_query($qwerty);
			$fila = mysqli_fetch_array($baia);
			$Total = $fila['Total'];
			//*/

mysqli_close($conexia);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Cursos</title>

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

		<style>
		html{
			height:100%;
		}
			</style>
	</head>

	<body class="backgroundPrincipal">
<!--	INICIO Menu en el Encabezado	-->
<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/barra_lateral2.blade.php'); ?>
<!--	FIN	Menu en el Encabezado	-->


<div class="container-fluid">
    <div style="margin-top:100px"   class="titleContainer">
        <div class="titleImg">
					<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
					<span class="greenTitle">MIS CURSOS</span>
        </div>
      </div>


<div class="col-xs-9" >
	<table style="width:100%;"   style="border:none !important" align="center">
    <tr class="pinkbackground">
    	<th class="weight borderpillbegin" style="border:none !important"><center>Nombre del curso</center></th>
        <th class="weight " style="border:none !important"><center>Instructor</center></th>
        <th class="weight" style="border:none !important"><center>Progreso</center></th>
        <th class="weight" style="border:none !important"><center>Calificación</center></th>
        <th class="weight borderpillend" style="border:none !important"><center></center></th>
    </tr>
		<tr class="separateRow">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "SELECT * FROM curso C JOIN curso_informacion CI ON C.id_Curso = CI.ID_Curso JOIN curso_participante CP ON C.id_Curso = CP.id_Curso JOIN curso_instructor CIN ON C.id_Curso = CIN.id_Curso WHERE CP.Mat_Alumno = '$Matricula' AND  CP.status != '0' ;";
		$res = mysqli_query($conex, $consulta);
		while($row = mysqli_fetch_array($res))
		{

			$queryta = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$row[id_Curso]';";
			$resultasxax = mysqli_query($conex, $queryta);
			$rowta = mysqli_fetch_array($resultasxax);

			$queryTotal = "SELECT * FROM curso_subtema CS JOIN curso_tema CT ON CS.id_Tema = CT.id_Tema WHERE CT.id_Curso = '$row[id_Curso]';";
			$resultadoTotal = mysqli_query($conex, $queryTotal);
			$TotalSub = mysqli_num_rows($resultadoTotal);
			$sqlx = "SELECT * FROM subtema_visto WHERE id_Curso = '$row[id_Curso]' AND Mat_Alumno = '$row[Mat_Alumno]' AND Visto != '0';";
			$resulx = mysqli_query($conex, $sqlx);
			$TotalVisto = mysqli_num_rows($resulx);

			$Regla3 = ($TotalVisto * 100) / $TotalSub;

			if($Regla3 < 100)
			{
				$Progreso = round($Regla3, 0, PHP_ROUND_HALF_UP);
			}
			else
			{
				$Progreso = $Regla3;
			}

			if ($color == 0)
			{
	?>
    <tr>
     		<?PHP
			$color = 1;
			}
			else
			{
			?>
    <tr>
            <?PHP
			$color = 0;
			}
			?>
    	<td style="border:none !important" class="borderpillbegin graybackground"><center> <?PHP echo htmlentities($row['nombre']); ?> </center></td>
        <?PHP

			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante WHERE id_Curso = '$row[id_Curso]';";
			$baia = mysqli_query($conex, $qwerty);
			$fila = mysqli_fetch_array($baia);
			$Total = $fila['Total'];
			$querys = "SELECT P.APaterno, P.AMaterno, P.Nombre FROM persona P JOIN usuario U ON P.email = U.email WHERE U.Mat_Usuario = '$row[Mat_Usuario]'";
			$Nombre_Ins = "";
			$resultado = mysqli_query($conex, $querys);
			$rowses = mysqli_fetch_array($resultado);
			$Nombre_Ins = $rowses['APaterno']." ".$rowses['AMaterno']." ".$rowses['Nombre'];
		?>
        <td style="border:none !important" class="graybackground"><center> <?PHP echo htmlentities($Nombre_Ins); ?> </center></td>

        <td class="graybackground" style="border:none !important">
        <!-- <center> <?PHP //echo htmlentities($Total." / ".$row['per_num']); ?> </center>-->

        <div class="progress">
        		<?PHP
				if($Progreso == 0)
				{
				?>
                  <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                    0%
                  </div>

               	<?PHP
				}
				else if($Progreso <= 20)
				{
				?>
                  <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>
                 <?PHP
				}
				else if($Progreso <= 50)
				{
				 ?>
                  <div class="progress-bar progress-bar-warning " role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>
                 <?PHP
				}
				else if($Progreso <= 70)
				{
				 ?>

                 <div class="progress-bar progress-bar-info " role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>

                <?PHP
				}
				else
				{
				 ?>
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                 </div>
                <?PHP
				}
				 ?>

        </div>

        </td> 
		<td class=" graybackground" style="border:none !important">
			<center><?php

				$user = User::find(84);
				echo 123; 
			
			?></center>
		</td>
<td class="borderpillend graybackground" style="border:none !important">
        <?PHP
			if($tipoPer == "Instructor")
			{
				$Mat = $row['Mat_Usuario'];
		?>
        <form action="CursoTemaAlumno.php" class="form-horizontal" method="get" enctype="multipart/form-data">
        <?PHP
			}
			else if($tipoPer == "Alumno")
			{
				$Mat = $row['Mat_Alumno'];
		?>
        	<form action="CursoTemaAlumno.php" class="form-horizontal" method="get" enctype="multipart/form-data">
            <?PHP
			}
			else
			{
				echo '<script>alert("Por el momento no hay opciones para otros usuarios")</script> ';
				$accion="VACIO";
				echo "<script>location.href='MisCursos.php'</script>";
			}
		?>
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Mat); ?>" name="Mat_Alumno">
        <center> <button class="NoRadiusColorButtonCircle" id="btn-Ir" type="submit">Ir al curso &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center>
        </form>
		</td>
    </tr>
		<tr class="separateRow">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
    <?PHP
		}
		desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->
</div>
</body>
</html>
