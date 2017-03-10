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

			$IDCurso = 0;

			$conexia = conect();

			$queryze = "SELECT MAX(id_Curso) as id_Curso FROM curso;";

			$resultas = mysqli_query($conexia,$queryze);

			$row = mysqli_fetch_array($resultas);

			$IDCurso = $row['id_Curso'];

			$IDCurso = $IDCurso + 1;

			mysqli_close($conexia);


$con = conect();
$res= get_Personas();

	$queryzex = "SELECT Mat_Usuario FROM usuario WHERE email = '$email';";
	$resultass = mysqli_query($con,$queryzex);
	$rows = mysqli_fetch_array($resultass);
	$Matricula = $rows['Mat_Usuario'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Alta de curso</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>

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



<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top">ALTA DE CURSOS</h1>
</center>
<form action="AltaCurso.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre del curso</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="nombre" name="nombre" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
                    <label class="control-label col-md-3 whiteClassThin">Cupo</label>
                <div class="col-xs-3">
                    <div class="input-group number-spinner">
                        <span class="input-group-btn data-dwn">
					<button type="button" class="btn btn-default NoRadius " data-dir="dwn"><span class="">-</span></button>
                        </span>
                        <input id="Cupo" name="Cupo" type="number" class="form-control NoRadius text-center" value="30" min="1">
                        <span class="input-group-btn data-up">
					<button type="button" class="btn btn-default NoRadius" data-dir="up"><span class="">+</span></button>
                        </span>
                    </div>
                </div>
 </div>

 <!--<div class="form-group">
 	<label class="control-label col-md-3 whiteClassThin">Su ID como instructor del curso</label>
    <div class="col-md-3">
    	<input class="form-control NoRadius" id="autocomplete" name="IDinstructor" type="text" placeholder="" required value="<?PHP echo htmlentities($Matricula); ?>" readonly>
    </div>
 </div> -->


 <div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin">Descripción</label>
    <div class="col-md-6">
    <textarea class="form-control NoRadius" maxlength="200" id="Descrip" name="Descripcion" placeholder="" required></textarea>
    </div>
</div>

<div class="form-group">
	<div class="col-md-2 col-md-offset-2">
		<button class="buttonTransparentBorder buttonAlta" id="btn-registro" type="submit">Crear curso </button>
        <!-- <input type="submit" class="btn btn-primary" value="Guardar registro"> -->
    </div>
</div>

</form>

</div> <!-- Fin del div principal Alta curso-->


<?PHP

if($accion == 'Nu3v@')
		{

			//*


			$conec = conect();

			$Consulta = "INSERT INTO curso_instructor (id_Curso, Mat_Usuario) VALUES ($IDCurso, '$_POST[IDinstructor]');";

						if(mysqli_query($conec,$Consulta))
						{
						}
						else
						{
							echo "hubo un error al ejecuta query curso_instructor intente de nuevo".mysqli_error();
						}

			$Consulta = "INSERT INTO curso_informacion (ID_Curso, per_num, Descrip) VALUES ($IDCurso, '$_POST[Cupo]', '$_POST[Descripcion]');";

						if(mysqli_query( $conec,$Consulta))
						{
						}
						else
						{
							echo "hubo un error al ejecuta query curso_información intente de nuevo".mysqli_error();
						}

				$sql = "INSERT INTO curso (id_Curso, nombre, estatus) VALUES ($IDCurso, '$_POST[nombre]', 'ALTA');";

				if(mysqli_query($conec,$sql))
				{
					/*
					echo '<script>alert("Este curso se ha dado de alta")</script> ';
					$accion="VACIO";
                    echo "<script>location.href='MisCursosInstructor.php'</script>";
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
					$accion="VACIO";
					echo "<script>location.href='MisCursosInstructor.php'</script>";
					*/
					echo '<script>

					swal({
					title: "Error",
					text: "hubo un error intente de nuevo más tarde",
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
						location.href="MisCursosInstructor.php"
					}
					});

					</script>';

				}

						mysqli_close($conec);
			//*/
		}

		?>

		<br><br><br><br>
		<br><br>
</body>

</html>
