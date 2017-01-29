<?PHP 
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_SESSION['IDExam']; 
$accion = $_GET['accion'];

$sql="SELECT * FROM examen WHERE ID_Examen = '$id'";
$resultado = mysql_query($sql);		
$row = mysql_fetch_array($resultado);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Examen Instructor</title>

<script src="../js/jquery.min.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
    <link href="../css/radiocss.css" rel="stylesheet" />
    
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
    <script src="../js/spinner.js"></script>
    
    
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

</head>

<body>

<center>
<h3>Por favor complete el formulario con las respuestas correctas, en las opciones de completar, escriba la respuesta en MAYUSCULA</h3>
</center>
<br><br><br>

<form class="form-horizontal" action="ExamenInstructor.php?accion=nu3v0" method="POST" target="_self">

<div class="col-sm-9 col-sm-offset-1">

<?PHP
echo $row['htmlExa'];

?>
</div>
<br><br>
<button type="submit" class="btn-register col-md-offset-6">Guardar examen	&nbsp; <span class="glyphicon glyphicon-saved"></span></button>
</form>


</body>

<?PHP

if($accion == 'nu3v0')
{
	 $consulta = "UPDATE examen SET Activo = 1 WHERE ID_Examen = '$id';";	
	 if(mysql_query($consulta,$conexion))
	 {
	 }
	 else
	 {
		 echo mysql_error();
	 }
	 
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
			 
			$query = "INSERT INTO respuestas_instructor (ID_Examen, Preg, respuesta) VALUES ('$id', '$conta', '$Resp');";
			$conta ++;
			if(mysql_query($query,$conexion))
			{
				$banderas = 1;
			}
			else
			{
				echo mysql_error()."<br>";
				$banderas = 0;
			}
		 }
	 }
	 
	 if($banderas == 1)
	 {
			 echo "<script> window.close(); </script>";
	 }
}

?>
</html>