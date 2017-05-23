<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDSubtema = $_POST['IDSubtema'];
$IDCurso = $_POST['IDCurso'];

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
		echo '<script>alert("Acceso denegado... Sitio exclusivo para Instructores y administradores")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();


	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

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
<title>Confirmar subtema</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>
<script src="../js/ASubtema.js"></script>

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

<script>
		var data = [
    <?php
        for($i=0;$i<count($res);$i++){//25
    echo '{ value: "'.$res[$i]['nombre'].'", label: "'.$res[$i]['id'].'"},';}
            //echo '{ value: "nombre'.$i.'", label: "000'.$i.'"},';}
            ?>

            ];
</script>

<style>
html{
	height: 100%;
}
</style>
</head>

<body class="backgroundPrincipal">

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/header.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top">CONFIRMAR SUBTEMA</h1>
</center>
<br><br>


</div> <!-- Fin del div principal Alta curso-->



<?PHP

if($accion == 'PDF')
{

			//*

			$conec = conect();

			//$clave = substr($_POST['Nombre'],0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");
			$clave = $_POST['IDSubtema'];

			$archivo = "";
			$destino = "";

			$band = 1;


			$extension = substr($_FILES["PDF"]["name"], (strlen($_FILES["PDF"]["name"])-3), strlen($_FILES["PDF"]["name"]));
			$NuevoNombre = 	$_POST['nombreArchivo'].".".$extension;
			$archivo = $NuevoNombre;
			$carpeta = "../Mat_Doc/";

			if($archivo != "")
			{
				opendir($carpeta);
				$destino = $carpeta.$archivo;
				copy($_FILES['PDF']['tmp_name'],$destino);

				$consulta = "INSERT INTO material_doc (id_Subtema, ubica) VALUES ('$clave', '$destino');";

				if(mysqli_query($conec,$consulta))
				{				}
				else
				{
					echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
				}
			}

			$cons = "UPDATE curso_subtema SET Nombre = '$_POST[Nombre]', Descrip = '$_POST[Descripcion]' WHERE id_Subtema = '$clave';";

			if(mysqli_query($conec,$cons))
				{
			?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($_POST['IDCurso']); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
             <?PHP
				}
				else
				{
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='MisCursosInstructor.php'</script>";
				}

			mysqli_close($conec);
}



if($accion == 'Video')
{
		/*
		echo ($_POST['IDSubtema2']);
		print_r("<br><br>");
		echo ($_POST['Nombre2']);
		print_r("<br><br>");
		echo ($_POST['Descripcion2']);
		print_r("<br><br>");
		echo($_FILES["Video"]["name"]);
		print_r("<br><br>");
		echo($_FILES["Video"]["type"]);
		print_r("<br><br>");
		$extension = substr($_FILES["Video"]["name"], (strlen($_FILES["Video"]["name"])-3), strlen($_FILES["Video"]["name"]));
		echo($_POST['nombreArchivo2'].".".$extension);
		//*/

		//*
		$conec = conect();

		$fecha = date("Y-m-d");
		$clave2 = $_POST['IDSubtema2'];

		$archivo = "";
		$destino = "";

		$band = 1;


		$extension = substr($_FILES["Video"]["name"], (strlen($_FILES["Video"]["name"])-3), strlen($_FILES["Video"]["name"]));
		$NuevoNombre = 	$_POST['nombreArchivo2'].".".$extension;
		$archivo = $NuevoNombre;

		$carpeta = "../Mat_Video/";

		if($archivo != "")
		{
			opendir($carpeta);
			$destino = $carpeta.$archivo;
			move_uploaded_file($_FILES['Video']['tmp_name'],$destino);

			$consulta = "INSERT INTO material_video (id_Subtema, ubica) VALUES ('$clave2', '$destino');";


			if(mysqli_query($conec,$consulta))
			{				}
			else
			{
				echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
			}
		}

		$cons = "UPDATE curso_subtema SET Nombre = '$_POST[Nombre2]', Descrip = '$_POST[Descripcion2]' WHERE id_Subtema = '$clave2';";

			if(mysqli_query($conec,$cons))
				{
			?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($_POST['IDCurso2']); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
             <?PHP
				}
				else
				{
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='MisCursosInstructor.php'</script>";
				}

			mysqli_close($conec);
		//*/

}



if($accion == 'Audio')
{
	$conec = conect();

	$fecha = date("Y-m-d");
	$clave3 = $_POST['IDSubtema3'];

	$archivo = "";
	$destino = "";

	$band = 1;

	$extension = substr($_FILES["Audio"]["name"], (strlen($_FILES["Audio"]["name"])-3), strlen($_FILES["Audio"]["name"]));
	$NuevoNombre = 	$_POST['nombreArchivo3'].".".$extension;
	$archivo = $NuevoNombre;

	$carpeta = "../Mat_Audio/";


	if($archivo != "")
	{
		opendir($carpeta);
		$destino = $carpeta.$archivo;
		copy($_FILES['Audio']['tmp_name'],$destino);

		$consulta = "INSERT INTO material_audio (id_Subtema, ubica) VALUES ('$clave3', '$destino');";

		if(mysqli_query( $conec,$consulta))
		{				}
		else
		{
			echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
		}
	}
	$cons = "UPDATE curso_subtema SET Nombre = '$_POST[Nombre3]', Descrip = '$_POST[Descripcion3]' WHERE id_Subtema = '$clave3';";

			if(mysqli_query($conec,$cons))
				{
				?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($_POST['IDCurso3']); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
             <?PHP
				}
				else
				{
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='MisCursosInstructor.php'</script>";
				}

			mysqli_close($conec);
}
			//*/
		?>
<br><br><br><br>
<br><br>

</body>


</html>
