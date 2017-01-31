<?PHP
include '../php/conexion.php';

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];

$IDTema = $_POST['IDTema'];


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

	$IDCurso = $_POST['IDCurso'];


	//$queryze = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$IDCurso';";
	$queryze = "SELECT * FROM curso_tema WHERE id_Curso = '$IDCurso';";
	$resultas = mysqli_query($conexia,$queryze);
	$NumRow = mysqli_num_rows($resultas);

	$queryzexa = "SELECT * FROM curso WHERE id_Curso = '$IDCurso';";
	$resultasa = mysqli_query($conexia,$queryzexa);
	$row = mysqli_fetch_array($resultasa);

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Examen</title>
	<meta charset="utf-8" />
	<script src="../js/jquery.min.js"></script>
	<link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
	<script src="../js/bootstrap/js/bootstrap.min.js"></script>


	<script src="../js/pregunta.js"></script>
	<link rel="stylesheet" href="../css/general.css">
	<link rel="stylesheet" href="../css/radio.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/efectos.js"></script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
		<style>
		html {
		    height: 100%;
		}
		</style>
</head>

<body class="backgroundPrincipal">


	<div class="container-fluid   ">
		<div class="form-horizontal ">
			<div class="text-center">
				<label class="control-label" id="VP"><h3 class="whiteClass2 top">VISTA PREVIA</h3></label>
			</div>
		</div>
		<div class="row affix-row col-sm-3 well back" id="menu">
			<div class="form-horizontal">
				<div class="form-group-sm ">
                <!--
                <form action="guardarExamen.php" method="post">
                -->
                	<input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" id="IDTema">
					<button class="buttonTransparentBorder buttonAlta " id="guardar"><span class="glyphicon glyphicon-saved"></span> Guardar examen</button>
                 <!--
                </form>
                -->
				</div>

				<div class="form-group">
					<label class="control-label whiteClassThin">Pregunta:</label>
					<textarea class="form-control" name="nomPreg" id="pregunta" rows="3" style="resize:none;" required></textarea>

				</div>
				<div class="form-group-sm">
					<div class="funkyradio rad">
						<div class="funkyradio-primary">
							<input type="radio" name="tipoPregunta" value="A" id="Abr" checked/>
							<label for="Abr">Completar</label>
						</div>
						<div class="funkyradio-success">
							<input type="radio" name="tipoPregunta" value="M" id="Mul" />
							<label for="Mul">Respuesta Múltiple</label>
						</div>

						<div class="funkyradio-info">
							<input type="radio" name="tipoPregunta" value="C" id="Col" />
							<label for="Col">Relaciónar columnas</label>
						</div>

					</div>
				</div>

				<div class="form-group" id="Nop">
					<div class="col-sm-11">
						<label class="control-label"> Número de respuestas: </label>
					</div>
					<div class="col-sm-7">
						<input type="number" name="nuop" id="nuop" min="2" max="10" value="3" class="form-control">
					</div>
					<div class="col-sm-5">

						<button class="btn btn-info" id="okop"><span class="glyphicon glyphicon-ok"></span></button>
					</div>
				</div>

				<div class="form-group" id="NopC">
					<div class="col-sm-11">
						<label class="control-label whiteClassThin"> Número de opciones: </label>
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

		<div class="affix-row  col-sm-4 col-sm-offset-1" id="2p">

			<div class="form-horizontal" id="exm"></div>

		</div>
	</div>
	</div>

</body>


<br><br><br><br>
<br><br>
</html>
