<?PHP
include '../php/conexion.php';

$IDCurso = $_POST['IDCurso'];
$id = $_POST['IDExamen'];
$IDTema = $_POST['IDTema'];
$Mat_Alumno = $_POST['Mat_Alu'];


?>
<!doctype html>
<html>
<head>

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

<meta charset="utf-8">
<title>Guardar respuestas</title>
</head>

<body>

<?PHP

 $conta = 1;
	 $band = 1;
	 $banderas = 0;


	 $fecha = date("Y-m-d");

	 $conexion = conect();

	 //*

	  $sql1 = "UPDATE habilita_exam SET Status = 'INACTIVO' WHERE IDTema = '$IDTema' AND Mat_Alu = '$Mat_Alumno';";
	  if(mysqli_query($conexion,$sql1))
	  {		  }
	  else
	  {
		  echo 'ERROR AL Actualizar habilita_exam'.'<br>';
		  echo mysqli_error().'<br>';
	  }

	 while($band == 1)
	 {
		 if(empty($_POST[$conta]))
		 {
			 $band = 0;
		 }
		 else
		 {
			 $Resp = strtoupper($_POST[$conta]);

			$query = "INSERT INTO respuestas_alumno (ID_Examen, Mat_Alumno, Preg, respuesta) VALUES ('$id', '$Mat_Alumno', '$conta', '$Resp');";
			$conta ++;
			if(mysqli_query($conexion,$query))
			{
				$banderas = 1;
			}
			else
			{
				echo 'ERROR AL INSERTAR respuestas_alumno'.'<br>';
				echo mysqli_error()."<br>";
				$banderas = 0;
			}
		 }
	 }
	 //*/

	 $x = 0;
	 $queryAlu = "SELECT respuesta FROM respuestas_alumno WHERE Mat_Alumno = '$Mat_Alumno' AND ID_Examen = '$id';";
	 $resultAlu = mysqli_query($conexion,$queryAlu);
	 while($rowAlu = mysqli_fetch_array($resultAlu))
	 {
		 $RAlumno[$x] = $rowAlu['respuesta'];
		 $x++;
	 }


	 $y = 0;
	 $queryIns = "SELECT respuesta FROM respuestas_instructor WHERE ID_Examen = '$id';";
	 $resultIns = mysqli_query($conexion,$queryIns);
	 while($rowIns = mysqli_fetch_array($resultIns))
	 {
		 $RInstructor[$y] = $rowIns['respuesta'];
		 $y++;
	 }

	 $queryConta = "SELECT * FROM respuestas_instructor WHERE ID_Examen = '$id';";
	 $resultConta = mysqli_query($conexion,$queryConta);
	 //$rowConta = mysqli_fetch_array($resultConta);
	 $Total = mysqli_num_rows($resultConta);
	 //print_r("El Total es <br>");
	 //print_r($Total);

	 //*
	 $aciertos = 0;

	 for($j = 0; $j < $y; $j++)
	 {
		 if($RInstructor[$j] == $RAlumno[$j])
		 {
			 $aciertos++;
		 }
	 }

	 $califica = (10 * $aciertos) / $Total;
	 $calificacion = round($califica, 1, PHP_ROUND_HALF_UP);

	 $sql2 = "INSERT INTO examen_alumno (ID_Examen, Mat_Alumno, id_Tema, Calificacion, Fecha) VALUES ('$id', '$Mat_Alumno','$IDTema', '$calificacion', '$fecha');";



	 if(mysqli_query($conexion,$sql2))
	 {
		 	$banderas = 1;
	 }
	 else
	 {
		 $banderas = 0;
		 echo 'ERROR AL INSERTAR examen_alumno'.'<br>';
		 echo mysqli_error().'<br>';
	 }

	 if($banderas == 1)
	 {
	?>
    	    <div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Su examen se ha sido calificado con éxito clic en el botón para continuar</label>
                    </div>
                    <br><br>
                    <center>
                    <h3>Su calificación es: <b> <?PHP echo htmlentities($calificacion); ?> </b></h3>
                    <br><br>
                    <form action="CursoTemaAlumno.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="btn-register" value="Continuar">
                    </form>
                    </center>
    <?PHP
	 }
	 else
	 {
	?>

    <?PHP

	 }

	 //*/

?>

</body>
</html>
