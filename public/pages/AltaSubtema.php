<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_GET['IDTema'];
$IDCurso = $_GET['IDCurso'];

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
    <link rel="stylesheet" href="../css/Main.css">
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

<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
<div    class="titleContainer">
		<div class="titleImg">
			<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
			<span class="greenTitle">ALTA DE SUBTEMA</span>
		</div>
	</div>
</div>


<form action="ConfirmaAltaSubtema.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin gray normal">Nombre del Subtema</label>
    <div class="col-md-6">
    <input class="form-control " id="nombre" name="Nombre" type="text" placeholder="" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin gray normal">Descripción</label>
    <div class="col-md-6">
    <textarea class="form-control " maxlength="200" rows="5" id="Descrip" name="Descripcion" placeholder="" required></textarea>
    </div>
</div>

<div class="form-group">
	<label for="opcion1" class="control-label col-md-3 whiteClassThin gray normal">Tipo de archivo a subir</label>
    <div class="col-md-6">
    <select class="form-control " name="TMat" id="TMat">
        <option value="0">Seleccione una opción</option>
        <option value="PDF">PDF</option>
        <option value="Video">Video</option>
        <option value="Audio">Audio</option>
    </select>
    </div>
</div>


<div class="form-group" id="nombreArchivo1"> </div>
    <div class="nothing form-group"> </div>
    <div class="form-group" id="PDF"></div>
    <div class="form-group" id="Video"></div>
    <div class="form-group" id="Audio"></div>
<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" name="IDTema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="NoRadiusColorButtonPill col-md-offset-8" value="Crear subtema">
    </div>
</div>

</form>

</div> <!-- Fin del div principal Alta curso-->

</body>

</html>
