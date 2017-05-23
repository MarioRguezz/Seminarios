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
<title>Edita subtema</title>

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
<h1 class="whiteClass2 top">EDICIÓN DE SUBTEMA</h1>
</center>
<br><br>

<?PHP
	$query = "SELECT * FROM curso_subtema where id_Subtema = '$IDSubtema'";
	$resultas = mysqli_query($conexia,$query);
	$row = mysqli_fetch_array($resultas);
?>

<form action="#">

<div class="form-group bg-info">
	<label for="opcion1" class="control-label col-md-3 whiteClassThin">Tipo de archivo a subir</label>
    <div class="col-md-3">
    <select class="form-control" name="TMat" id="TMat">
        <option value="0">Seleccione una opción</option>
        <option value="PDF">PDF</option>
        <option value="Video">Video</option>
        <option value="Audio">Audio</option>
    </select>
    </div>
</div>

</form>

<br><br><br>


<div id="ArchivoPDF">

<form action="ConfirmaEditaSubtema.php?accion=PDF" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3">Nombre del Subtema*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombre" name="Nombre" type="text" placeholder="Nombre del subtema" value="<?PHP echo htmlentities($row['Nombre']); ?>" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3">Descripción*</label>
    <div class="col-md-8">
    <input type="text" class="form-control" maxlength="200" rows="5" id="Descrip" name="Descripcion" placeholder="Introduzca una breve descripción del subtema" value="<?PHP echo htmlentities($row['Descrip']); ?>" required>
    </div>
</div>


<div class="form-group" id="nombreArchivo">
<label for="nombre" class="control-label col-md-3">Nombre corto para el archivo*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombreArchivo" name="nombreArchivo" type="text" placeholder="Sin espacios y no mayor a 15 caracteres" maxlength="15" required>
	</div>
</div>
<br><br>

<div class="form-group" id="PDF">
<label for="PDF" class="control-label col-md-3">Adjunte Archivo en PDF no mayor a 25 Mb</label>
	<input type="file" name="PDF" class="btn btn-warning">
</div>


<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="btn btn-success col-md-offset-7" value="Editar subtema">

    </div>
</div>
</form> <!--Fin del form PDF-->
</div> <!--Fin del div PDF-->

<div id="ArchivoVideo">

<form action="ConfirmaEditaSubtema.php?accion=Video" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3">Nombre del Subtema*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombre" name="Nombre2" type="text" placeholder="Nombre del subtema" value="<?PHP echo htmlentities($row['Nombre']); ?>" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3">Descripción*</label>
    <div class="col-md-8">
    <input type="text" class="form-control" maxlength="200" rows="5" id="Descrip" name="Descripcion2" placeholder="Introduzca una breve descripción del subtema" value="<?PHP echo htmlentities($row['Descrip']); ?>" required>
    </div>
</div>


<div class="form-group" id="nombreArchivo">
<label for="nombre" class="control-label col-md-3">Nombre corto para el archivo*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombreArchivo" name="nombreArchivo2" type="text" placeholder="Sin espacios y no mayor a 15 caracteres" maxlength="15" required>
	</div>
</div>
<br><br>

<div class="form-group" id="Video">
<label for="foto" class="control-label col-md-3">Adjunte Video no mayor a 150 Mb</label>
	<input type="file" name="Video" class="btn btn-danger">
</div>


<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema2">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso2">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="btn btn-success col-md-offset-7" value="Editar subtema">

    </div>
</div>
</form> <!--Fin del form Video-->
</div> <!--Fin del div Video-->


<div id="ArchivoAudio">

<form action="ConfirmaEditaSubtema.php?accion=Audio" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3">Nombre del Subtema*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombre" name="Nombre3" type="text" placeholder="Nombre del subtema" value="<?PHP echo htmlentities($row['Nombre']); ?>" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3">Descripción*</label>
    <div class="col-md-8">
    <input type="text" class="form-control" maxlength="200" rows="5" id="Descrip" name="Descripcion3" placeholder="Introduzca una breve descripción del subtema" value="<?PHP echo htmlentities($row['Descrip']); ?>" required>
    </div>
</div>


<div class="form-group" id="nombreArchivo">
<label for="nombre" class="control-label col-md-3">Nombre corto para el archivo*</label>
    <div class="col-md-6">
    <input class="form-control" id="nombreArchivo" name="nombreArchivo3" type="text" placeholder="Sin espacios y no mayor a 15 caracteres" maxlength="15" required>
	</div>
</div>
<br><br>

<div class="form-group" id="Audio">
<label for="Audio" class="control-label col-md-3">Adjunte Audio no mayor a 50 Mb</label>
	<input type="file" name="Audio" class="btn btn-primary">
</div>


<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema3">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso3">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="btn btn-success col-md-offset-7" value="Editar subtema">

    </div>
</div>
</form> <!--Fin del form Audio-->
</div> <!--Fin del div Audio-->


</div> <!-- Fin del div principal Alta curso-->


<br><br><br><br>
<br><br>

</body>

</html>
