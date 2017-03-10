<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
$IDCurso = $_POST['IDCurso'];

//print_r("El ID Curso es: ".$IDCurso);

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
<title>Alta de actividad</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/AltaActividad.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/Actividad.js"></script>
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

	<style>
	html{
		height:100%;
	}
		</style>
</head>

<body class="backgroundPrincipal">

<!--	FIN	Menu en el Encabezado	-->
<div class="Menu">
	<div class="col-md-2" >
		<a class="SubtitlewhiteClass NoShadow WithTop" href="../">Menú principal</a>
	</div>

    <div class="col-md-2" >
    <form action="CursoTemaInstructor.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
            <th><button class="SubtitlewhiteClass NoShadow WithTop buttonTransparent" type="submit">Regresar </button></th>
        </form>
    </div>

		<div class="col-md-2 col-md-offset-6">
				<a class="SubtitlewhiteClass NoShadow WithTop" href="../logout">Cerrar sesión</a>
		</div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top2">ALTA DE ACTIVIDAD</h1>
</center>
<br><br>

<form action="ConfirmaAltaActividad.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">


<div class="form-group">
	<label for="opcion1" class="control-label col-md-3 whiteClassThin">Actividad a crear</label>
    <div class="col-md-3">
    <select class="form-control NoRadius" name="TAct" id="TAct">
        <option value="0">Seleccione una opción</option>
        <option value="Memorama">Memorama</option>
        <!--<option value="DAD">Cuestionario interactivo</option>-->
        <option value="Rompecabezas">Rompecabezas</option>
    </select>
    </div>
</div>

<br>

<div class="form-group" id="Memorama">
<h3 class="whiteClass2">Recomendamos que las imagenes esten en la misma carpeta</h3>
<br>
<label for="PDF" class="control-label col-md-4 whiteClassThin">Adjunte al menos 3 imagenes formato JPG</label>
<label for="memorama" class="custom-file-upload whiteClassThin"> Archivo PDF</label>
		<input type="file" id="memorama" name="archivo[]" class="btn btn-info" multiple>
</div>

<div class="form-group" id="Rompecabezas">
<label for="Rompe" class="control-label col-md-3 whiteClassThin">Adjunte una imagen JPG</label>
<label for="rompecabe" class="custom-file-upload whiteClassThin">Imagen</label>
	<input type="file" name="Rompe" id="rompecabe" class="btn btn-warning">
</div>

<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2" id="Aceptar">
    	<input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" name="IDTema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="buttonTransparentBorder buttonAlta  col-md-offset-7" value="Crear actividad">

    </div>
</div>

</form>

<div class="container-fluid " id="DAD">

		<div class="row affix-row col-sm-3 well back" id="menu">
			<div class="form-horizontal">
				<div class="form-group-sm ">
                	<input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" id="IDTema">
					<button class="buttonTransparentBorder buttonMedium" id="guardar"><span class="glyphicon glyphicon-saved"></span> Guardar </button>
				</div>

				<div class="form-group">
					<label class="control-label whiteClassThin">Pregunta:</label>
					<textarea class="form-control" name="nomPreg" id="pregunta" rows="3" style="resize:none;"></textarea>

				</div>

				<div class="form-group" id="Nop">
					<div class="col-sm-11">
						<label class="control-label whiteClassThin"> Número de respuestas: </label>
					</div>
					<div class="col-sm-7">
						<input type="number" name="nuop" id="nuop" min="2" max="6" value="3" class="form-control">
					</div>
					<div class="col-sm-5">

						<button class="btn btn-info" id="okop"><span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>

				<div class="form-group" id="NopC">
					<div class="col-sm-11">
						<label class="control-label"> Numero de opciones: </label>
					</div>
					<div class="col-sm-7">
						<input type="number" name="nuopC" id="nuopC" min="2" max="10" value="4" class="form-control">
					</div>
					<div class="col-sm-5">

						<button class="btn btn-info" id="okopC"><span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>

				<div id="opcion"></div>

				<div class="form-group-sm ">
					<button class="buttonTransparentBorder buttonMedium" id="botonG"><span class=" glyphicon glyphicon-plus"></span>Agregar </button>
				</div>
			</div>
		</div>

		<div class="affix-row  col-sm-8 col-sm-offset-1" id="2p">
			<div class="form-horizontal ">
				<div class="text-right">
					<label class="control-label whiteClassThin" id="VP">Solo podrá ver sus preguntas y opciones, podrá escribir la respuesta correcta al guardar este cuestionario</label>
				</div>
			</div>

			<div class="form-horizontal" id="exm"></div>

		</div>
	</div>
</div>

</div> <!-- Fin del div principal Alta curso-->


<br><br><br><br>
<br><br>

</body>
</html>
