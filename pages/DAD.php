<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
//$IDTema = "In6186";

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

if($tipoPer != "Alumno")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo para Alumnos")</script> ';   
		echo "<script>location.href='login.php'</script>";			
}

	$conexia = conect();	
	

	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysql_query($queryxe);		
	$rowses = mysql_fetch_array($resultadoses);
	
	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';   
		echo "<script>location.href='login.php'</script>";		
	}

	
	$sqlas = "SELECT * FROM tema_actividad WHERE id_Tema = '$IDTema';";
	$resuxas = mysql_query($sqlas);	
	$rowyas = mysql_fetch_array($resuxas);
	
	$sql = "SELECT * FROM respuestas_dad WHERE id_Actividad = '$rowyas[id_Actividad]'";
	$resul = mysql_query($sql);
	$NumResp = mysql_num_rows($resul);		
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cuestionario interactivo</title>

<link rel="stylesheet" href="../css/demo.css">
 <link rel="stylesheet" href="../css/Actividad.css">
<link rel="stylesheet" href="../js/jquery.dad.css">

<script src="../js/jquery.min.js"></script>


</head>

<body>

<br><br><br>

<?PHP
//for($x = 1; $x <= $NumResp; $x++)
$x = 1;
while($row = mysql_fetch_array($resul))
{
print_r("En ".$x." Está ".$row['respuesta']."<br>");	
?>
<input type="hidden" id="Resp<?PHP echo htmlentities($x); ?>" value="<?PHP echo htmlentities($row['respuesta']); ?>">
<?PHP	
$x++;
}
echo ($rowyas['ubica']);
?>

</body>
<script src="../js/jquery.dad.js"></script>
</html>