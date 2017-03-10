<?PHP
include '../php/conexion.php';

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];


if(isset($_SESSION['tipoP']))
{
}
else
{
	echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';
	echo "<script>location.href='login.php'</script>";
}

if($tipoPer == "Alumno")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo para instructores y administradores")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();


	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
}


$email = $_SESSION["email"];

$Matricula = 0;
$conexia = conect();

	$queryze = "SELECT Mat_Usuario FROM usuario WHERE email = '$email';";
	$resultas = mysqli_query($conexia,$queryze);
	$row = mysqli_fetch_array($resultas);
	$Matricula = $row['Mat_Usuario'];


mysqli_close($conexia);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Cursos Instructor</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Main.css">
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

</head>

<body class="backgroundPrincipal" >

<!--	FIN	Menu en el Encabezado	-->
<div class="Menu">
	<div class="col-md-4" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="../">Menú principal</a>
	</div>
	<div class="col-md-2 col-md-offset-6">
			<a class="SubtitlewhiteClass NoShadow WithTop" href="../logout">Cerrar sesión</a>
	</div>
</div>

<!--	FIN	Menu en el Encabezado	-->


<center>
<h1 class="whiteClass2 top">ADMINISTRAR MIS CURSOS</h1>
</center> 

<div class="form-group">
	<div class="col-md-3 col-md-offset-9">
    	<form action="AltaCurso.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Matricula">
            <th><button class="buttonTransparentBorder buttonAlta" type="submit"><center>Agregar un curso &nbsp;<span class="glyphicon glyphicon-import"></span> </center> </button></th>
        </form>
    </div>
</div>

<br><br><br><br>

<div class="container">
	<table style="width:100%" cellspacing="0" cellpadding="0" class=" table-responsive tablaDesign">
    <tr class="danger">
    	<th><center>Nombre del curso</center></th>
        <th><center>Cupo</center></th>
        <th><center>Lista de Participantes</center></th>
        <th><center></center></th>
    </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "SELECT * FROM curso C JOIN curso_informacion CI ON C.id_Curso = CI.ID_Curso JOIN curso_instructor CIN ON C.id_Curso = CIN.id_Curso WHERE CIN.Mat_Usuario = '$Matricula';";

		$res = mysqli_query($conex,$consulta);
		while($row = mysqli_fetch_array($res))
		{
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
    <tr class="info">
            <?PHP
			$color = 0;
			}

			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante WHERE id_Curso = '$row[ID_Curso]';";
			$baia = mysqli_query($conex,$qwerty);
			$fila = mysqli_fetch_array($baia);
			$Total = $fila['Total'];

			?>
    	<td><center> <?PHP echo htmlentities($row['nombre']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($Total." / ".$row['per_num']); ?> </center></td>

        <form action="Listax.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Mat_User">
        <?PHP
		if($Total>0)
		{
		?>
        <td><center> <button class="buttonTransparentBorder buttonAlta" id="btn-Ir" type="submit">Consultar &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center></td>
        <?PHP
		}
		else
		{
		?>
        <td><center> <button class="buttonTransparentBorder buttonAlta" id="btn-Ir" type="submit" disabled>No Disponible &nbsp; <span class="glyphicon glyphicon-remove"></span></button> </center></td>
        <?PHP
		}
		?>
        </form> <!-- Fin del form a las listas -->

        <form action="CursoTemaInstructor.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Mat_User">
        <td><center> <button class="buttonTransparentBorder buttonAlta" id="btn-Ir" type="submit">Ir al curso &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center></td>
        </form>
        <!-- <td><center> Aquí el check box </center></td> -->
    </tr>
    <?PHP
		}
		desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->

<br><br><br><br>
<br><br>

</body>
</html>
