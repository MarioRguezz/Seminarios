<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
$IDCurso = $_POST['IDCurso'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];
//print_r($IDCurso."<br>");

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

	 $Consultados = "SELECT MAX(Orden) AS Orden FROM `curso_subtema` WHERE id_Curso = '$IDCurso'";
	 $Resulta = mysqli_query($conexia,$Consultados);
	 $row = mysqli_fetch_array($Resulta);
	 $temporal = 0;
	 if($row['Orden'] != NULL)
	 {
	 	$temporal = $row['Orden'];
	 }

	 $siguiente = $temporal + 1;

?>
<!doctype html>
<html>
<head>

    <style>
        html{
            height: 100%;
        }
    </style>
<meta charset="utf-8">
<title>Confirma subtema</title>

<script src="../js/jquery.min.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>


</head>

<body class="backgroundPrincipal">

<!--	FIN	Menu en el Encabezado	-->

<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top2">CONFIRMAR SUBTEMA</h1>
</center>
<br><br>

</div> <!-- Fin del div principal Alta curso-->



<?PHP

if($accion == 'Nu3v@')
		{

			/*
			echo ($_POST['IDSubtema']);
			print_r("<br><br>");
			echo ($_POST['Nombre']);
			print_r("<br><br>");
			echo ($_POST['Descripcion']);
			print_r("<br><br>");
			if($_REQUEST['TMat'] == "PDF")
			{
				echo($_FILES["PDF"]["name"]);
				print_r("<br><br>");
				echo($_FILES['PDF']['tmp_name']);
				print_r("<br><br>");
				$extension = substr($_FILES["PDF"]["type"], (strlen($_FILES["PDF"]["type"])-3), strlen($_FILES["PDF"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
				print_r("<br><br>");
			}
			else if($_REQUEST['TMat'] == "Video")
			{
				echo($_FILES["Video"]["name"]);
				print_r("<br><br>");
				$extension = substr($_FILES["Video"]["type"], (strlen($_FILES["Video"]["type"])-3), strlen($_FILES["Video"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
			}
			else if($_REQUEST['TMat'] == "Audio")
			{
				echo($_FILES["Audio"]["name"]);
				print_r("<br><br>");
				$extension = substr($_FILES["Audio"]["type"], (strlen($_FILES["Audio"]["type"])-3), strlen($_FILES["Audio"]["type"]));
				echo($_POST['nombreArchivo'].".".$extension);
			}

			//*/

			//*

			$conec = conect();

			$clave = substr($_POST['Nombre'],0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");

			$archivo = "";
			$destino = "";

			$band = 1;

			if($_REQUEST['TMat'] == "PDF")
			{
				$extension = substr($_FILES["PDF"]["type"], (strlen($_FILES["PDF"]["type"])-3), strlen($_FILES["PDF"]["type"]));
				//$NuevoNombre = 	$_POST['nombreArchivo'].".".$extension;
                $NuevoNombre =   uniqid('pdf_',true).".".$extension;


				$archivo = $NuevoNombre;
				$carpeta = "../Mat_Doc/";


				if($archivo != "") {
                    opendir($carpeta);
                    $destino = $carpeta . $archivo;
                    //copy($_FILES['PDF']['tmp_name'],$destino);

                    if (!copy($_FILES['PDF']['tmp_name'], $destino)) {
                        $Message = "Ocurrió un error al subir su archivo intente de nuevo ";
                        header("Location:  ../?Message={$Message}");
                        exit("Unable to connect to ");
                    } else {
                        $consulta = "INSERT INTO material_doc (id_Subtema, ubica) VALUES ('$clave', '$destino');";

                        if (mysqli_query($conec, $consulta)) {
                        } else {
                            echo "hubo un error al subir el archivo de audiointente de nuevo" . mysqli_error();
                        }
                    }
                }

			}
			else if($_REQUEST['TMat'] == "Video")
			{
				$ruta = $_POST['videoUrl'];
				$tipo = $_POST['tipoVideo'];
				$consulta = "INSERT INTO material_video (id_Subtema, ubica,tipo) VALUES ('$clave', '$ruta','$tipo');";

								if(mysqli_query($conec,$consulta))
								{}
								else{
									echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
									}
			}
			else if($_REQUEST['TMat'] == "Audio")
			{
				$extension = substr($_FILES["Audio"]["type"], (strlen($_FILES["Audio"]["type"])-3), strlen($_FILES["Audio"]["type"]));
				//$NuevoNombre = 	$_POST['nombreArchivo'].".".$extension;
                $NuevoNombre =   uniqid('audio_',true).".".$extension;
				$archivo = $NuevoNombre;
				$carpeta = "../Mat_Audio/";


				if($archivo != "") {
                    opendir($carpeta);
                    $destino = $carpeta . $archivo;
                    //copy($_FILES['Audio']['tmp_name'],$destino);


                    if (!copy($_FILES['Audio']['tmp_name'], $destino)) {
                        $Message = "Ocurrió un error al subir su archivo intente de nuevo ";
                        header("Location:  ../?Message={$Message}");
                        exit("Unable to connect to ");
                    } else{
                    $consulta = "INSERT INTO material_audio (id_Subtema, ubica) VALUES ('$clave', '$destino');";

                    if (mysqli_query($conec, $consulta)) {
                    } else {
                        echo "hubo un error al subir el archivo de audiointente de nuevo" . mysqli_error();
                    }
                }
				}
			}



			//$cons = "INSERT INTO curso_subtema (id_tema, id_subtema, Nombre, Descrip) VALUES ('$_POST[IDTema]', '$clave', '$_POST[Nombre]', '$_POST[Descripcion]');";
            $cons = "INSERT INTO curso_subtema (id_curso,id_tema, id_subtema, Nombre, Descrip,Orden) VALUES ('$IDCurso','$_POST[IDTema]', '$clave', '$_POST[Nombre]', '$_POST[Descripcion]', '$siguiente');";
			if(mysqli_query($conec, $cons))
				{
			?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="get">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="NoRadiusColorButton  " value="Continuar">
                    </form>
                    </center>
             <?PHP
				}
				else
				{
					print_r(mysqli_error());
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					//echo "<script>location.href='MisCursosInstructor.php'</script>";
				}

			mysqli_close($conec);
			//*/
		}

		?>
<br><br><br><br>
<br><br>

</body>
</html>
