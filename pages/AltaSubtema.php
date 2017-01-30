<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
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
<title>Alta de subtema</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>
<script src="../js/AltaSubtema.js"></script>

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
<div class="Menu">
	<div class="col-md-1" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="#">Menú</a>
	</div>

	<div class="col-md-2" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="principal.php">Menú principal</a>
	</div>
    <div class="col-md-2" >
    <form action="CursoTemaInstructor.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
           <th> <button class="SubtitlewhiteClass NoShadow WithTop buttonTransparent" type="submit">Regresar </button></th>
        </form>
    </div>

		<div class="col-md-2 col-md-offset-5">
        <a class="SubtitlewhiteClass NoShadow WithTop" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top">ALTA DE SUBTEMA</h1>
</center>
<br><br>

<form action="ConfirmaAltaSubtema.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre del Subtema</label>
    <div class="col-md-6">
    <input class="form-control" id="nombre" name="Nombre" type="text" placeholder="Nombre del subtema" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin">Descripción</label>
    <div class="col-md-6">
    <textarea class="form-control" maxlength="200" rows="5" id="Descrip" name="Descripcion" placeholder="Introduzca una breve descripción del subtema" required></textarea>
    </div>
</div>

<div class="form-group">
	<label for="opcion1" class="control-label col-md-3 whiteClassThin">Tipo de archivo a subir</label>
    <div class="col-md-6">
    <select class="form-control" name="TMat" id="TMat">
        <option value="0">Seleccione una opción</option>
        <option value="PDF">PDF</option>
        <option value="Video">Video</option>
        <option value="Audio">Audio</option>
    </select>
    </div>
</div>


<div class="form-group" id="nombreArchivo">
<label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre corto para el archivo</label>
    <div class="col-md-6">
    <input class="form-control" id="nombreArchivo" name="nombreArchivo" type="text" placeholder="Sin espacios, no mayor a 15 caracteres" maxlength="15" required>
</div>
<br><br><br>


<div class="form-group" id="PDF">
<label for="PDF" class="control-label col-md-3 whiteClassThin">Adjunte Archivo en PDF no mayor a 15 Mb</label>
<label for="pdffile" class="custom-file-upload whiteClassThin"> Archivo PDF</label>
	<input type="file" name="PDF" id="pdffile" class="btn btn-warning">
</div>

<div class="form-group" id="Video">
<label for="foto" class="control-label col-md-3 whiteClassThin">Adjunte Video no mayor a 100 Mb</label>
<label for="videofile" class="custom-file-upload whiteClassThin"> Video</label>
	<input type="file" name="Video"  id="videofile" class="btn btn-danger">
</div>

<div class="form-group" id="Audio">
<label for="Audio" class="control-label col-md-3 whiteClassThin">Adjunte Audio no mayor a 20 Mb</label>
<label for="listenfile" class="custom-file-upload whiteClassThin"> Audio</label>
	<input type="file" name="Audio" id="listenfile" class="btn btn-primary">
</div>

<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" name="IDTema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="buttonTransparentBorder buttonAlta col-md-offset-8" value="Crear subtema">
    </div>
</div>

</form>

</div> <!-- Fin del div principal Alta curso-->



<?PHP

if($accion == 'Nu3v@')
		{

			/*
			echo ($_POST['IDSubtema']);
			print_r("<br><br>");
			echo ($_POST['Nombre']);
			print_r("<br><br>");
			echo ($_POST['Descripcion']);
			print_r("<br><br>");
			if($_REQUEST['TMat'] == "PDF")
			{
				echo($_FILES["PDF"]["name"]);
				print_r("<br><br>");
				echo($_FILES['PDF']['tmp_name']);
				print_r("<br><br>");
				$extension = substr($_FILES["PDF"]["type"], (strlen($_FILES["PDF"]["type"])-3), strlen($_FILES["PDF"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
				print_r("<br><br>");
			}
			else if($_REQUEST['TMat'] == "Video")
			{
				echo($_FILES["Video"]["name"]);
				print_r("<br><br>");
				$extension = substr($_FILES["Video"]["type"], (strlen($_FILES["Video"]["type"])-3), strlen($_FILES["Video"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
			}
			else if($_REQUEST['TMat'] == "Audio")
			{
				echo($_FILES["Audio"]["name"]);
				print_r("<br><br>");
				$extension = substr($_FILES["Audio"]["type"], (strlen($_FILES["Audio"]["type"])-3), strlen($_FILES["Audio"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
			}

			//*/

			//*

			$conec = conect();

			$clave = substr($_POST['Nombre'],0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");

			$archivo = "";
			$destino = "";

			$band = 1;

			if($_REQUEST['TMat'] == "PDF")
			{
				$extension = substr($_FILES["PDF"]["type"], (strlen($_FILES["PDF"]["type"])-3), strlen($_FILES["PDF"]["type"]));
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

			}
			else if($_REQUEST['TMat'] == "Video")
			{
				$extension = substr($_FILES["Video"]["type"], (strlen($_FILES["Video"]["type"])-3), strlen($_FILES["Video"]["type"]));
				$NuevoNombre = 	$_POST['nombreArchivo'].".".$extension;
				$archivo = $NuevoNombre;
				$carpeta = "../Mat_Video/";

				if($archivo != "")
				{
					opendir($carpeta);
					$destino = $carpeta.$archivo;
					copy($_FILES['Video']['tmp_name'],$destino);

					$consulta = "INSERT INTO material_video (id_Subtema, ubica) VALUES ('$clave', '$destino');";


					if(mysqli_query($conec,$consulta))
					{				}
					else
					{
						echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
					}
				}

			}
			else if($_REQUEST['TMat'] == "Audio")
			{
				$extension = substr($_FILES["Audio"]["type"], (strlen($_FILES["Audio"]["type"])-3), strlen($_FILES["Audio"]["type"]));
				$NuevoNombre = 	$_POST['nombreArchivo'].".".$extension;
				$archivo = $NuevoNombre;
				$carpeta = "../Mat_Audio/";


				if($archivo != "")
				{
					opendir($carpeta);
					$destino = $carpeta.$archivo;
					copy($_FILES['Audio']['tmp_name'],$destino);

					$consulta = "INSERT INTO material_audio (id_Subtema, ubica) VALUES ('$clave', '$destino');";

					if(mysqli_query($conec,$consulta))
					{				}
					else
					{
						echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
					}
				}
			}



			$cons = "INSERT INTO curso_subtema (id_tema, id_subtema, Nombre, Descrip) VALUES ('$_POST[IDTema]', '$clave', '$_POST[Nombre]', '$_POST[Descripcion]');";

			if(mysqli_query($conec,$cons))
				{
					/*
					echo '<script>alert("El subtema se ha dado de alta")</script> ';
					$accion="VACIO";
					echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
					*/
					echo '<script>

					swal({
					title: "Este curso se ha dado de alta",
					text: "de clic en el boton para continuar",
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
						location.href="MisCursosInstructor.php"
					}
					});

					</script>';
				}
				else
				{
					/*
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					*/
					echo '<script>swal("AVISO","hubo un error intente de nuevo más tarde", "error");</script> ';

					$accion="VACIO";
				}

			mysqli_close($conec);
			//*/
		}

		?>
<br><br><br><br>
<br><br>

</body>

</html>
