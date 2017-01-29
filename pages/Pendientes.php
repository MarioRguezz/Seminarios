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

if($TipoPer != "Administrador")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo de los administradores")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();


	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($conexia,$resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Autoriza</title>

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
	height: 100%;
}
</style>

</head>

<body class="backgroundPrincipal" >

<!--	FIN	Menu en el Encabezado	-->
<div class="Menu">
	<div class="col-md-1" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="#">Menú</a>
	</div>
	<div class="col-md-2" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="principal.php">Menú principal</a>
	</div>
	<div class="col-md-2 col-md-offset-7">
			<a class="SubtitlewhiteClass NoShadow WithTop" href="Cerrar.php">Cerrar sesión</a>
	</div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<center>
<h1 class="whiteClass2 top"><b>Solicitudes pendientes</b></h1>
</center>

<br><br>
<div class="container">
	<table style="width:100%" cellspacing="0" cellpadding="0" class=" table-responsive tablaDesign">
    <tr class="danger">
    	<th><center>Nombre</center></th>
        <th><center>Estado</center></th>
        <th><center>Municipio</center></th>
        <th><center>Tipo de usuario</center></th>
        <th><center>Información</center></th>
        <th><center>¿Aprobar solicitud?</center></th>
        <!-- <th><center></center></th> -->
    </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "Select * FROM persona where TUser != 'Administrador' AND Status != 'ALTA'"; //Tienes que seleccionar solo aquellos que no esten dados de 'Baja'

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
			?>
    	<td><center> <?PHP echo htmlentities($row['APaterno']." ". $row['AMaterno']." ".$row['Nombre']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['Estado']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['Municipio']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['TUser']); ?> </center></td>
        <form action="Perfil.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
        <input type="hidden" value="<?PHP echo htmlentities($row['email']); ?>" name="email">
        <input type="hidden" value="<?PHP echo htmlentities($row['TUser']); ?>" name="tipoUs">
        <td><center> <button type="submit" class="buttonTransparent"> <span class="glyphicon glyphicon-info-sign"></span> </button></center></td>
        </form>
        <form action="Pendientes.php?accion=4pr0v@r" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($row['email']); ?>" name="correo">
        <input type="hidden" value="<?PHP echo htmlentities($row['TUser']); ?>" name="tuser">
        <td><center> <button class="buttonTransparentBorder buttonAlta" id="btn-autoriza" type="submit">Aprobar &nbsp; <span class="glyphicon glyphicon-ok"></span></button> </center></td>
        </form>
        <!-- <td><center> Aquí el check box </center></td> -->
    </tr>
    <?PHP
		}
		desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->


<?PHP

if($accion == '4pr0v@r')
{
	$conec = conect();

	$IDes = 0;

	if($_POST['tuser'] == 'Alumno')
	{
		$query = "SELECT MAX(Mat_Alumno) AS Matricula FROM alumno";
	}
	else
	{
		$query = "SELECT MAX(Mat_Usuario) AS Matricula FROM usuario";
	}

	$resultas = mysqli_query($conec,$query);
	$row = mysqli_fetch_array($resultas);
	$IDes = $row['Matricula'];
	$IDes = $IDes + 1;
	$consultados = "UPDATE persona set Status = 'ALTA' WHERE email = '$_POST[correo]';";
	if(mysqli_query($conec,$consultados))
	{		}
	else
	{
		echo "hubo un error al ejecuta query curso_instructor intente de nuevo".mysqli_error();
	}


	if($_POST['tuser'] == 'Alumno')
	{
		$consultatres = "UPDATE alumno set Mat_Alumno = '$IDes' WHERE email = '$_POST[correo]';";
	}
	else
	{
		$consultatres = "UPDATE usuario set Mat_Usuario = '$IDes' WHERE email = '$_POST[correo]';";
	}

	if(mysqli_query($conec,$consultatres))
	{
			/*
			echo '<script>alert("El usuario ha sido aprovado")</script> ';
			$accion="VACIO";
			echo "<script>location.href='Pendientes.php'</script>";
			//*/

			echo '<script>

					swal({
					title: "El usuario ha sido aprovado",
					text: "de clic en el boton para continuar",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#00FF00",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="Pendientes.php"
					}
					});

					</script>';
	}
	else
	{
			/*
			echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
			$accion="VACIO";
			echo "<script>location.href='Pendientes.php'</script>";
			//*/
			echo '<script>

					swal({
					title: "Hubo un error intentelo más tarde",
					text: "de clic en el boton para continuar",
					type: "error",
					showCancelButton: false,
					confirmButtonColor: "#FF0000",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="Pendientes.php"
					}
					});

					</script>';

	}

	mysqli_close($conec);

}

?>


<br><br><br><br>
<br><br>

</body>
</html>
