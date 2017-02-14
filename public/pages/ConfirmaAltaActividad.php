<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

$IDTema = $_POST['IDTema'];
$IDCurso = $_POST['IDCurso'];


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

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Confirma Actividad</title>

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



    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<style>
html{
	height:100%;
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
        <a class="btn btni-danger" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<div class="container"> <!-- Div principal -->

<center>
<h1 class="whiteClass2 top">CONFIRMA ACTIVIDAD</h1>
</center>
<br><br>

</div> <!-- Fin del div principal Alta curso-->



<?PHP

if($accion == 'Nu3v@')
{

			//*
			$bandera = 0;

			$conec = conect();

			$clave = "ACT".substr($IDTema,0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");

			$cont = 1;



	if($_REQUEST['TAct'] == "Memorama")
	{
				# definimos la carpeta destino
    $carpetaDestino= "../img/Memorama/".$clave."/";

    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {

        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {

            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
            {

                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {

				if($_FILES["archivo"]["type"][$i]=="image/jpeg")
				{
				$extension = substr($_FILES["archivo"]["type"][$i], (strlen($_FILES["archivo"]["type"][$i])-4), strlen($_FILES["archivo"]["type"][$i]));
				}
				else if($_FILES["archivo"]["type"][$i]=="image/pjpeg")
				{
					$extension = substr($_FILES["archivo"]["type"][$i], (strlen($_FILES["archivo"]["type"][$i])-5), strlen($_FILES["archivo"]["type"][$i]));
				}
				else if ($_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
				{
					$extension = substr($_FILES["archivo"]["type"][$i], (strlen($_FILES["archivo"]["type"][$i])-3), strlen($_FILES["archivo"]["type"][$i]));
				}


				$NuevoNombre = 	"imagen".$cont.".".$extension;
				$archivo = $NuevoNombre;


                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    //$destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
					$destino = $carpetaDestino.$archivo;

					//print_r($destino."<br>");
					//print_r($archivo."<br>");

                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                      //  echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
						$cont++;

						$consulta = "INSERT INTO tema_actividad (id_Tema, id_Actividad, ubica) VALUES ('$IDTema', '$clave', '$destino');";


						if(mysqli_query($conec,$consulta))
						{
							$bandera = 1;
						}
						else
						{
							echo "hubo un error al subir el archivo de imagen intente de nuevo".mysqli_error();
							$bandera = 0;
						}
                    }
					else
					{
                        //echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
						$bandera = 0;
                    }
                }
				else
				{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
					$bandera = 0;
                }
            }
			else
			{
                echo "<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg";
				$bandera = 0;
            }
        }
    }
	else
	{
        echo "<br>No se ha subido ninguna imagen";
    }

	if($bandera == 1)
	{
		?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
    <?PHP
	}
	else
	{
		?>
					<div class="alert alert-danger" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">ERROR verifique los mensajes y pongase en contacto con el administrador</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
     <?PHP
	}

} //Fin de si es Memorama
else
{
			$bandera = 0;

			$conec = conect();

			$clave = "MEM".substr($IDTema,0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");

			$cont = 1;


				# definimos la carpeta destino
    $carpetaDestino= "../img/Memorama/".$clave."/";

    # si hay algun archivo que subir
    if($_FILES["Rompe"]["name"])
    {

        # recorremos todos los arhivos que se han subido
        //for($i=0;$i<count($_FILES["Rompe"]["name"]);$i++)
        //{

            # si es un formato de imagen
            if($_FILES["Rompe"]["type"]=="image/jpeg")
            {

                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {

				if($_FILES["Rompe"]["type"]=="image/jpeg")
				{
				$extension = substr($_FILES["Rompe"]["type"], (strlen($_FILES["Rompe"]["type"])-4), strlen($_FILES["Rompe"]["type"]));
				}


				$NuevoNombre = 	"imagen".$cont.".".$extension;
				$archivo = $NuevoNombre;


                    $origen=$_FILES["Rompe"]["tmp_name"];
                    //$destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
					$destino = $carpetaDestino.$archivo;

					//print_r($destino."<br>");
					//print_r($archivo."<br>");

                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                      //  echo "<br>".$_FILES["Rompe"]["name"]." movido correctamente";
						$cont++;

						$consulta = "INSERT INTO tema_actividad (id_Tema, id_Actividad, ubica) VALUES ('$IDTema', '$clave', '$destino');";

						if(mysqli_query($conec,$consulta))
						{
							$bandera = 1;

							$sqles = "SELECT ubica FROM tema_actividad WHERE id_Tema = '$IDTema'";
							$Resul = mysqli_query($conec,$sqles);
							$rowx = mysqli_fetch_array($Resul);

							$ruta1=$rowx['ubica'];
							$ruta2=$rowx['ubica'];
							$ancho=600;
							$alto=500;

							# se obtene la dimension y tipo de imagen
							$datos=getimagesize ($ruta1);

							$ancho_orig = $datos[0]; # Anchura de la imagen original
							$alto_orig = $datos[1];    # Altura de la imagen original
							$tipo = $datos[2];

							if ($tipo==1){ # GIF
								if (function_exists("imagecreatefromgif"))
									$img = imagecreatefromgif($ruta1);
								else
									return false;
							}
							else if ($tipo==2){ # JPG
								if (function_exists("imagecreatefromjpeg"))
									$img = imagecreatefromjpeg($ruta1);
								else
									return false;
							}
							else if ($tipo==3){ # PNG
								if (function_exists("imagecreatefrompng"))
									$img = imagecreatefrompng($ruta1);
								else
									return false;
							}

							# Se calculan las nuevas dimensiones de la imagen
							if ($ancho_orig>$alto_orig)
								{
								$ancho_dest=$ancho;
								$alto_dest=($ancho_dest/$ancho_orig)*$alto_orig;
								}
							else
								{
								$alto_dest=$alto;
								$ancho_dest=($alto_dest/$alto_orig)*$ancho_orig;
								}

							// imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+
							$img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest);

							// Redimensionar
							// imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+
							@imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig);

							// Crear fichero nuevo, según extensión.
							if ($tipo==1) // GIF
								if (function_exists("imagegif"))
									imagegif($img2, $ruta2);


							if ($tipo==2) // JPG
								if (function_exists("imagejpeg"))
									imagejpeg($img2, $ruta2);


							if ($tipo==3)  // PNG
								if (function_exists("imagepng"))
									imagepng($img2, $ruta2);


						}
						else
						{
							echo "hubo un error al subir el archivo de imagen intente de nuevo".mysqli_error();
							$bandera = 0;
						}
                    }
					else
					{
                        //echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
						$bandera = 0;
                    }
                }
				else
				{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
					$bandera = 0;
                }
            }
			else
			{
                echo "<br>".$_FILES["Rompe"]["name"]." - NO es imagen jpg";
				$bandera = 0;
            }
        //}//Fin del for
    }
	else
	{
        echo "<br>No se ha subido ninguna imagen";
    }

	if($bandera == 1)
	{
		?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">Información actualizada con éxito clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="buttonTransparentBorder buttonAlta" value="Continuar">
                    </form>
                    </center>
    <?PHP
	}
	else
	{
		?>
					<div class="alert alert-danger" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">ERROR verifique los mensajes y pongase en contacto con el administrador</label>
                    </div>
                    <center>
                    <form action="CursoTemaInstructor.php" method="post">
                    	<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
     <?PHP
	}
}
			mysqli_close($conec);
}

		?>
<br><br><br><br>
<br><br>

</body>


</html>
