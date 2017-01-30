<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
$Imagen = $_POST['Imagen'];
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

	$resultadoses = mysqli_query($conexia, $queryxe);
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
    <link rel="stylesheet" href="../css/Actividad.css">


    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/Principal.css" />
    <link rel="stylesheet" type="text/css" href="../css/jqpuzzle.css" />
        <script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="../js/jquery.jqpuzzle.js"></script>
        <script type="text/javascript">
            //Rutas a imagenes que se cargaran al azar.
            var imagenes = new Array(
                '<?PHP echo ($Imagen); ?>'
                /*'imagenes/caracas.jpg',
                'imagenes/colibri.jpg',
                'imagenes/leon.jpg',
                'imagenes/llama.jpg',
                'imagenes/rio_de_janeiro.jpg'*/
            );
            //Guarda la ruta de una imagen al azar.
            var azar = Math.floor((Math.random() * imagenes.length) + 0);
            var imagen = imagenes[azar];
            //Seteos del rompecabezas.
            var settings = {
                shuffle: true,
                control: {
                    shufflePieces: true, // display 'Shuffle' button [true|false]
                    confirmShuffle: false, // ask before shuffling [true|false]
                    toggleOriginal: true, // display 'Original' button [true|false]
                    toggleNumbers: true, // display 'Numbers' button [true|false]
                    counter: true, // display moves counter [true|false]
                    timer: true, // display timer (seconds) [true|false]
                    pauseTimer: false
                }
            };
            //Textos que mostraran el rompecabezas.
            var myTexts = {
                shuffleLabel: 'Mezclar',
                toggleOriginalLabel: 'Ver Original',
                toggleNumbersLabel: 'Numeros',
                confirmShuffleMessage: 'Desea mezclar la imagen?',
                movesLabel: 'Movimientos',
                secondsLabel: 'segundos'
            };
            $(document).ready(function() {
                $("#rompecabezas").attr('src', imagen);
                $("#rompecabezas").jqPuzzle(settings, myTexts);
            });
        </script>

				<style>
				html {
				    height: 100%;
				}
				</style>
				</head>

				<body class="backgroundPrincipal" >

<!--	FIN	Menu en el Encabezado

<div class="Menu">
	<div class="col-md-1" >
    	<h4>Menú</h4>
    </div>

    <div class="col-md-2" >
    	<a class="btn btn-info" href="principal.php">Menú principal</a>
    </div>
    <div class="col-md-2 col-md-offset-7">
        <a class="btn btni-danger" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<br><br><br><br>
<center> <img id="rompecabezas" src="" alt="" class="jqPuzzle" /> </center>

</div> <!-- Fin del div principal-->


<br><br><br><br>
<br><br><br><br>
<br><br><br><br>


</body>
</html>
