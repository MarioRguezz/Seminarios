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

if($tipoPer != "Alumno")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo para Alumnos")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();

/*
if($rowses['Status'] == "BAJA")
{
    logout();
    echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
    echo "<script>location.href='login.php'</script>";
}
*/


	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);





$Matricula = 0;
$conexia = conect();

	$queryze = "SELECT Mat_Alumno FROM alumno WHERE email = '$email';";
	$resultas = mysqli_query($conexia,$queryze);
	$rows = mysqli_fetch_array($resultas);
	$Matricula = $rows['Mat_Alumno'];


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

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

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


<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/barra_lateral2.blade.php'); ?>

<div  class="container-fluid">
		<div style="margin-top:100px"   class="titleContainer">
		<div class="titleImg">
			<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
			<span class="greenTitle">MIS CURSOS</span>
		</div>
	</div>

    <div class="col-xs-9">
		<table class="tableSize"  align="center">
    <tr class="pinkbackground">
    	<th class="weight borderpillbegin"><center>Nombre del curso</center></th>
        <th class="weight"><center>Instructor</center></th>
        <th class="weight"><center>Descripción</center></th>
        <th class="weight"><center>Cupo</center></th>
        <th class="weight borderpillend"><center></center></th>
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
		$consulta = "SELECT * FROM curso C JOIN curso_informacion CI ON C.id_Curso = CI.ID_Curso JOIN curso_instructor CIN ON C.id_Curso = CIN.id_Curso and CI.publico = 1 ";

		$res = mysqli_query($conex, $consulta);
		while($row = mysqli_fetch_array($res))
		{

			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante WHERE id_Curso = '$row[id_Curso]'";
			$baia = mysqli_query($conex, $qwerty);
			$fila = mysqli_fetch_array($baia);
			$Total = $fila['Total'];


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
			?>
    	<td class="borderpillbegin"><center> <?PHP echo htmlentities($row['nombre']); ?> </center></td>
        <?PHP
			$querys = "SELECT P.APaterno, P.AMaterno, P.Nombre FROM Persona P JOIN usuario U ON P.email = U.email WHERE u.Mat_Usuario = '$row[Mat_Usuario]'";
			$Nombre_Ins = "";
			$resultado = mysqli_query($conex, $querys);
			$rowses = mysqli_fetch_array($resultado);
			$Nombre_Ins = $rowses['APaterno']." ".$rowses['AMaterno']." ".$rowses['Nombre'];
		?>
        <td><center> <?PHP echo htmlentities($Nombre_Ins); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['Descrip']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($Total." / ".$row['per_num']); ?> </center></td>
        <?PHP
			// $Total = 35; //Pruebas solamente

			if($Total < $row['per_num'])
			{
		?>
        <form action="CursosDisponibles.php?accion=nu3v0" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Matricula); ?>" name="Mat_Alumno">
        <td class="borderpillend"><center> <button class="buttonpill" id="btn-Ir" type="submit" title="Clic aquí para inscribirte">Inscripción &nbsp; <span> <img style="color:#FFF !important;" src="../img/byondiconos/BEYOND2-55.png"></span></button> </center></td>

        </form>
        <?PHP
			}
			else
			{
		?>
        	<td class="borderpillend"><center> <button class="btn btn-danger" id="btn-Ir" type="submit" title="Cupo completo" disabled>No hay cupo &nbsp; <span class="glyphicon glyphicon-remove"></span></button></td>
        <?PHP
			}
		?>
        <!-- <td><center> Aquí el check box </center></td> -->
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
		//desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->

	<?PHP

		if($accion == 'nu3v0')
		{
			//print_r("La Matricula es: ".$_POST['Mat_Alumno']."<br>");
			//print_r("El ID Curso  es: ".$_POST['IDCurso']."<br>");

			//*
			$conec = conect();


			$qwertys = "SELECT * FROM curso_participante WHERE Mat_Alumno = '$_POST[Mat_Alumno]' AND id_Curso = '$_POST[IDCurso]';";
			$resus = mysqli_query($conec, $qwertys);
			$ahoc = mysqli_fetch_array($resus);

			if($ahoc != NULL)
			{
					/*
					echo '<script>alert("Ya esta inscrito al curso")</script> ';
					$accion="VACIO";
					echo "<script>location.href='CursosDisponibles.php'</script>";
					*/

					$accion="VACIO";

					echo '<script>swal("AVISO","Usted ya esta inscrito a este curso", "warning");</script> ';

			}

			else
			{
				$Query = "INSERT INTO curso_participante (id_curso, Mat_Alumno, status) VALUES ('$_POST[IDCurso]', '$_POST[Mat_Alumno]', '1');";

				if(mysqli_query($conec,$Query))
				{
					$accion="VACIO";
					/*
					echo '<script>alert("Usted se ha inscrito al curso")</script> ';
					$accion="VACIO";
					echo "<script>location.href='CursosDisponibles.php'</script>";
					*/

					 echo '<script>

					swal({
					title: "AVISO",
					text: "Usted se ha inscrito al curso",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#00E02D",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="CursosDisponibles.php"
					}
					});

					</script>';
				}
				else
				{
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='CursosDisponibles.php'</script>";
				}
			}
			//*/

		}
	?>

<br><br><br><br>
<br><br>

</div>
</body>

</html>
