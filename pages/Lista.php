<?PHP
include '../php/conexion.php';

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];

$IDCurso = $_POST['IDCurso'];


if(isset($_SESSION['tipoP']))
{
}
else
{
	echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';   
	echo "<script>location.href='login.php'</script>";	
}

if($tipoPer == "Alumno"){
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo para instructores y administradores")</script> ';   
		echo "<script>location.href='login.php'</script>";			
}

	$conexia = conect();	
	

	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysql_query($queryxe);		
	$rowses = mysql_fetch_array($resultadoses);
	
	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';   
		echo "<script>location.href='login.php'</script>";		
}


$email = $_SESSION["email"];

$Matricula = 0;			
$conexia = conect();	

	
	$Total = 0;
	$qwerty = "SELECT COUNT(*) as Total From curso_participante";
	$baia = mysql_query($qwerty);
	$fila = mysql_fetch_array($baia);
	$Total = $fila['Total'];	
			
mysql_close($conexia);		

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Cursos Instructor</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
    <link href="../css/radiocss.css" rel="stylesheet" />
    
    
    <script src="../js/inicio.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/efectos.js"></script>

    
	<script src="../js/bootstrap/js/bootstrap.min.js"></script>
    
    
    <script src="../js/spinner.js"></script>       
    <script src="../js/jquery.min-1.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery.tzCheckbox.css" />
	<script src="../js/CB.js"></script>
	<script src="../js/jquery.tzCheckbox.js"></script> 
     


</head>

<body>
<!--	FIN	Menu en el Encabezado	-->

<div class="Menu">
	<div class="col-md-1" >
    	<h4>Menú</h4>
    </div>
    
    <div class="col-md-2" >
    	<a class="btn btn-info" href="principal.php">Menú principal</a>
    </div>
    <div class="col-md-2 col-md-offset-7">
        <a class="btn btn-danger" href="Cerrar.php">Cerrar sesión</a>
    </div>	
</div>

<!--	FIN	Menu en el Encabezado	-->

<center>
<h1><b>Lista de Alumnos inscritos al curso</b></h1>
</center>

<br><br>

<!--

-->

<div class="container">
	<table class="table table-bordered table-hover table-responsive">
    <tr class="danger">
    	<th><center>Nombre</center></th>        
        <th><center>Correo</center></th>
        <th><center>Información</center></th>
    </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "SELECT P.APaterno, P.AMaterno, P.Nombre, P.email FROM alumno A JOIN curso_participante CP ON A.Mat_Alumno = CP.Mat_Alumno JOIN Persona P ON A.email = P.email WHERE CP.id_Curso = '$IDCurso'";
		
		$res = mysql_query($consulta);
		while($row = mysql_fetch_array($res))
		{
			if ($color == 0)
			{
	?>
    <tr>
     		<?PHP
			$color = 1;
			}
			else
			{
			?>
    <tr class="info">        
            <?PHP
			$color = 0;
			}			
			?>
    	<td><center> <?PHP echo htmlentities($row['APaterno']." ". $row['AMaterno']." ".$row['Nombre']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['email']); ?> </center></td>
        <form action="Perfil.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
        <input type="hidden" value="<?PHP echo htmlentities($row['email']); ?>" name="email">
        <td><center> <button type="submit" class="btn btn-info"> <span class="glyphicon glyphicon-info-sign"></span> </button></center></td>
        </form>
        
        <td>
        <input type="checkbox" id="checkbox1" class="checkbox1" name="1" title="5"; data-on="Si" data-off="No" onClick="buttest()"' />
        </td>
        
        <!-- <td><center> Aquí el check box </center></td> -->
    </tr>
    <?PHP
		}
		desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->

<br><br><br><br>
<br><br>

</body>

<footer>
   	<div class="form-group">
        	<div class="col-md-8">
    			<h3>Seminario</h3>
        	</div>
        </div>
</footer>
</html>