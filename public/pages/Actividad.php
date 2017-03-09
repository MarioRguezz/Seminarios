<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
$IDCurso = $_POST['IDCurso'];
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
<title>Actividad</title>

<script src="../js/jquery.min.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/Principal.css">
    <link rel="stylesheet" href="../css/Actividad.css">

    <!--
    <link rel="stylesheet" href="../css/demo.css">
    <link rel="stylesheet" href="../css/jquery.dad.css">
    <link rel="stylesheet" href="../css/EstiloT0305.css" type="text/css" media="screen" />

    <script src="../js/jquery.dad.js"></script>
    -->

    <!--<script language="JavaScript" src="jquery.js"></script>-->
    <script language="JavaScript" src="../js/TemaActividad.js"></script>


    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

</script>

<style>
html{
	height: 100%;
}
</style>
</head>

<body class="backgroundPrincipal">

<!--	FIN	Menu en el Encabezado

<div class="Menu">
	<div class="col-md-1" >
    	<h4>Menú</h4>
    </div>

    <div class="col-md-2" >
    	<a class="btn btn-info" href="principal.php">Menú principal</a>
    </div>
    <div class="col-md-2 col-md-offset-7">
        <a class="" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top">ACTIVIDAD</h1>
</center>
<br><br>

<?PHP
$conexia = conect();
	$sql = "SELECT * FROM tema_actividad WHERE id_Tema = '$IDTema';";
	$resul = mysqli_query($conexia,$sql);
	$rowsesx = mysqli_fetch_array($resul);

	$opciones = substr($rowsesx['id_Actividad'],0, 3);

	if($opciones == "ACT")
	{
?>

<div id="botonera">
                <span id = "msgContador" class="link">
                    <span id="contador">0</span>
                    Clic
                </span>
                &nbsp;
                <a href="javascript:" class="link" onclick="reiniciarJuego();">Reiniciar</a>
                &nbsp;
                <span id = "msgTimer" class="link">
                <span id = "timer">0</span> Segundos
                </span>
            </div>
            <div id="imagenes">
            <?PHP
				$sql1 = "SELECT * FROM tema_actividad WHERE id_Tema = '$IDTema';";
				$resulta = mysqli_query($conexia,$sql1);
				$NumRow = mysqli_num_rows($resulta);
				$TotalIMG = $NumRow * 2;
				$conta = 1;
				while($row = mysqli_fetch_array($resulta))
				{
					$Imagen[$conta] = $row['ubica'];
					//print_r($Imagen[$conta]."<br>");
					$conta++;
				}
				$conta = 1;
				//print_r("El total de imagenes es: ".$TotalIMG."<br>");
				//print_r("El total filas es: ".$NumRow."<br>");

				for($x = 1; $x <= $TotalIMG; $x++)
				{
					if($conta > $NumRow)
					{
						//print_r("Entré en esta pendejada <br>");
						$conta = 1;
						//print_r("El valor de conta es:".$conta."<br>");
					}
					//print_r($x);
					//print_r($Imagen[$conta]."<br>");
			?>
                <div id="img<?PHP echo htmlentities($x); ?>"><img src="<?PHP echo htmlentities($Imagen[$conta]); ?>" alt = "Memorama" width="120" height="85" /></div>
            <?PHP
				$conta++;
				}
			?>
            </div>
            <form>
            	<input type="hidden" name="Total" value="<?PHP echo htmlentities($NumRow); ?>" id="Total">
            </form>

	<?PHP
	}//Fin de la actividad Memorama
	else if($opciones == "DAD")
	{
		echo $rowsesx['ubica'];
	} //Fin de la actividad DAD
	else
	{
		print_r($rowsesx['ubica']);
    ?>
    <center>
    <input type="hidden" id="Imagen" value="<?PHP echo htmlentities($rowsesx['ubica']); ?>">
    <img id="rompecabezas" src="" alt="" class="jqPuzzle" />
    </center>
    <?PHP
	}//Fin del if de la ultima actividad
	?>

</div> <!-- Fin del div principal-->


<br><br><br><br>
<br><br><br><br>
<br><br><br><br>


</body>


</html>
