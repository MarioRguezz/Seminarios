<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDSubtema = $_GET['IDSubtema'];
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
<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
					<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
					<span class="greenTitle">EDICIÓN DE SUBTEMA</span>
        </div>
      </div>
    </div>


<?PHP
	$query = "SELECT * FROM curso_subtema where id_Subtema = '$IDSubtema'";
	$resultas = mysqli_query($conexia,$query);
	$row = mysqli_fetch_array($resultas);
?>

<br>


<div id="container">

<form action="EditaSubtema.php?accion=Edita" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 ClassThin normal gray">Nombre del Subtema</label>
    <div class="col-md-6">
    <input class="form-control NoRadiusGray" id="nombre" name="Nombre" type="text" placeholder="Nombre del subtema" value="<?PHP echo htmlentities($row['Nombre']); ?>" required>
    </div>
</div>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3 ClassThin normal gray">Descripción</label>
    <div class="col-md-6">
    <input type="text" class="form-control NoRadiusGray" maxlength="200" rows="5" id="Descrip" name="Descripcion" placeholder="Introduzca una breve descripción del subtema" value="<?PHP echo htmlentities($row['Descrip']); ?>" required>
    </div>
</div>


<br><br>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
    	<input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">

        <!--
        <button class="btn btn-success" id="btn-registro" type="submit">Crear subtema &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        -->

        <input type="submit" class="NoRadiusColorButtonCircle  col-md-offset-7" value="Editar subtema">

    </div>
</div>
</form> <!--Fin del form PDF-->
</div> <!--Fin del div PDF-->


</div> <!-- Fin del div principal Alta curso-->


<br><br><br><br>
<br><br>

<?PHP
if($accion == 'Edita')
{

	$consx = "UPDATE curso_subtema SET Nombre = '$_POST[Nombre]', Descrip = '$_POST[Descripcion]' WHERE id_Subtema = '$_POST[IDSubtema]';";


			if(mysqli_query($conexia,$consx))
				{
				echo '<script>
					swal({
					title: "Este subtema ha sido modificado",
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

					$accion="VACIO";
				}
				else
				{
					echo '<script>swal("AVISO","hubo un error intente de nuevo más tarde", "error");</script> ';

					$accion="VACIO";
				}

			mysqli_close($conexia);
}
?>

</body>

</html>
