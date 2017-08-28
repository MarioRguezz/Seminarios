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
<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/barra_lateral2.blade.php'); ?>

<div  class="container-fluid">
		<div style="margin-top:100px"   class="titleContainer">
				<div class="titleImg">
					<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
					<span class="greenTitle">ADMINISTRAR MIS CURSOS</span>
				</div>


			</div>
<div class="col-xs-9" >
	<div style="magin-bottom:30px">
    	<form action="AltaCurso.php" class="form-horizontal" method="get" enctype="multipart/form-data">
            <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Matricula">
            <button class="NoRadiusColorButtonPill" type="submit"><center>Agregar un curso &nbsp;<span class="glyphicon glyphicon-import"></span> </center> </button>
        </form>
    </div>
<br>
	<table class="col-xs-12">
    <tr class="pinkbackground">
    	<th class="weight borderpillbegin"><center>Nombre del curso</center></th>
        <th class="weight"><center>Cupo</center></th>
        <th class="weight"><center>Lista de Participantes</center></th>
        <th class="weight borderpillend"><center></center></th>
    </tr>
		<tr class="separateRow">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
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
    <tr class="graybackground">
     		<?PHP
			$color = 1;
			}
			else
			{
			?>
    <tr class="graybackground">
            <?PHP
			$color = 0;
			}

			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante WHERE id_Curso = '$row[ID_Curso]';";
			$baia = mysqli_query($conex,$qwerty);
			$fila = mysqli_fetch_array($baia);
			$Total = $fila['Total'];
			?>
    	<td class=" borderpillbegin"><center> <?PHP echo htmlentities($row['nombre']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($Total." / ".$row['per_num']); ?> </center></td>

        <form action="Listax.php" class="form-horizontal" method="get" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Mat_User">
        <?PHP
		if($Total>0)
		{
		?>
        <td><center> <button class="buttonpill" id="btn-Ir" type="submit">Ver alumnos &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center></td>
        <?PHP
		}
		else
		{
		?>
        <td><center> <button class="buttonpill" id="btn-Ir" type="submit" disabled>No Disponible &nbsp; <span class="glyphicon glyphicon-remove"></span></button> </center></td>
        <?PHP
		}
		?>
        </form> <!-- Fin del form a las listas -->

      <!--  <form action="CursoTemaInstructor.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">-->
			<form action="CursoTemaInstructor.php" class="form-horizontal" method="get" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Mat_User">
        <td  class=" borderpillend" ><center> <button class="buttonpill" id="btn-Ir" type="submit">Ir al curso &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center></td>
        </form>
        <!-- <td><center> Aquí el check box </center></td> -->
    </tr>
		<tr class="separateRow">
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

</div>
<div>

</div><!-- Fin del div principal -->


</body>
</html>
