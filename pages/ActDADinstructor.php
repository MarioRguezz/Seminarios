<?PHP
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_SESSION['ActDAD'];
$accion = $_GET['accion'];

$sql="SELECT * FROM tema_actividad WHERE id_Actividad = '$id'";
$resultado = mysqli_query($conexion,$sql);
$row = mysqli_fetch_array($resultado);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actividad Instructor</title>

<script src="../js/jquery.min.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
    <link href="../css/radiocss.css" rel="stylesheet" />

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

</head>

<body>

<center>
<h3>Por favor complete el formulario con las respuestas correctas</h3>
</center>
<br><br><br>

<form class="form-horizontal" action="ActDADinstructor.php?accion=nu3v0" method="POST" target="_self">

<div class="col-sm-9 col-sm-offset-1">

<?PHP
echo $row['ubica'];

?>
</div>
<br><br><br>
<button type="submit" class="btn-register col-md-offset-6">Guardar actividad&nbsp; <span class="glyphicon glyphicon-saved"></span></button>
</form>


</body>

<?PHP

if($accion == 'nu3v0')
{
	 $conta = 1;
	 $band = 1;
	 $banderas = 0;
	 while($band == 1)
	 {
		 if(empty($_POST[$conta]))
		 {
			 $band = 0;
		 }
		 else
		 {
			$Resp = strtoupper($_POST[$conta]);

			$query = "INSERT INTO respuestas_dad (id_Actividad, preg, respuesta) VALUES ('$id', '$conta', '$Resp');";
			print_r($query);
			$conta ++;
			if(mysqli_query($conexion,$query))
			{
				$banderas = 1;
			}
			else
			{
				echo mysqli_error()."<br>";
				$banderas = 0;
			}
		 }
	 }

	 if($banderas == 1)
	 {
			 echo '<script>
			 swal({
						title: "Las respuestas se han guardado",
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
							location.href="MisCursosInstructor.php"
						}
					});

			  </script>';
	 }
}

?>
</html>
