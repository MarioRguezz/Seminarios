<?PHP

include '../php/conexion.php';

$accion = $_GET['accion'];

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


	$queryxe = "SELECT * FROM persona P JOIN Alumno A ON P.email = A.email  WHERE P.email = '$email' ;";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
	}

	$IDSubtema = $_POST['IDSubtema'];
	$TipoArchivo = $_POST['TipoArchivo'];
	$TotalSub = $_POST['TotalSub'];
	$MatAlu = $_POST['MatAlu'];
	$IDCurso = $_POST['IDCurso'];

	//print_r($IDSubtema."<br>");
	//print_r($TotalSub."<br>");
	//print_r($MatAlu."<br>");
	//print_r($IDCurso."<br>");
	//print_r($TipoArchivo);

	$Doc = $_POST['Doc'];
	$Vid = $_POST['Vid'];
	$Aud = $_POST['Aud'];



	$queryze = "SELECT * FROM material_video WHERE id_Subtema = '$IDSubtema';";
	$resultas = mysqli_query($conexia,$queryze);
	$NumVid = mysqli_num_rows($resultas);
	$rowVid = mysqli_fetch_array($resultas);
	/*
	print_r($rowVid);
	print_r("<br>");
	//*/

	$queryze1 = "SELECT * FROM material_doc WHERE id_Subtema = '$IDSubtema';";
	$resultas1 = mysqli_query($conexia,$queryze1);
	$NumDoc = mysqli_num_rows($resultas1);
	$rowDoc = mysqli_fetch_array($resultas1);
	/*
	print_r($rowDoc);
	print_r("<br>");
	//*/

	$queryze2 = "SELECT * FROM material_audio WHERE id_Subtema = '$IDSubtema';";
	$resultas2 = mysqli_query($conexia,$queryze2);
	$NumAud = mysqli_num_rows($resultas2);
	$rowAud = mysqli_fetch_array($resultas2);
	//print_r($rowAud);

	/* *****
	Copia de Visto.php
	***** */
	$sqlxex = "SELECT * FROM subtema_visto WHERE Mat_Alumno = '$MatAlu' AND id_Subtema = '$IDSubtema' AND id_Curso = '$IDCurso';";
	$resultadoxex = mysqli_query($conexia,$sqlxex);
	$rowsesx = mysqli_fetch_array($resultadoxex);

if($rowsesx['Visto'] == ""){

	$consultaxex = "INSERT INTO subtema_visto (id_Curso, id_Subtema, Mat_Alumno, Visto) Values('$IDCurso','$IDSubtema', '$MatAlu', '1');";
	if(mysqli_query($conexia,$consultaxex))
	{	}
	else
	{
		echo mysqli_error()."<br>";
	}
//*
}
else
{
	if ($rowsesx['Visto'] == "0")
	{
		$consultaxex = "UPDATE subtema_visto SET Visto = '1' WHERE Mat_Alumno = '$MatAlu' AND id_Subtema = '$IDSubtema' AND id_Curso = '$IDCurso';";
	}
	if(mysqli_query($conexia,$consultaxex))
	{	}
	else
	{
		//echo "ERROR en la consulta UPDATE subtema_Visto   ".mysqli_error()."<br>";
	}
}

	/* *****
	Copia de Visto.php
	***** */

?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Curso Alumno</title>

		<script src="../js/jquery.min.js"></script>

        <!-- <script src="../js/Tema.js"></script> -->


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Tema.css">

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


    <script src="../js/jquery.min-1.5.1.js"></script>
    <!--
    <link rel="stylesheet" type="text/css" href="../css/jquery.tzCheckbox.css" />
	<script src="../js/CB.js"></script>
	<script src="../js/jquery.tzCheckboxTema.js"></script>
    -->


	</head>

	<body>

<!-- BARRA de PDF, Video o Audio

		<div class="container form-group">
			<div class="row">
				<div class="form-group"></div>
				<div class="btn-group col-xs-6 col-xs-offset-3" data-toggle="buttons">
					<label class="btn btn-success rd col-xs-4" title="Documentación del tema" data-toggle="popover" data-trigger="hover" id="4">
						<input type="radio">PDF</label>

					<label class="btn btn-warning rd col-xs-4" data-toggle="tooltip" data-placement="bottom" title="Video" id="5">
						<input type="radio">Video</label>

					<label class="btn btn-info rd col-xs-4" data-toggle="tooltip" data-placement="top" title="Audio" id="6">
						<input type="radio">Audio</label>
				</div>
			</div>

-->
			<br>
			<?PHP
$conexia = conect();
			$sqlx = "SELECT * FROM subtema_visto WHERE id_Curso = '$IDCurso' AND Mat_Alumno = '$MatAlu' AND Visto != '0';";
			$resulx = mysqli_query($conexia,$sqlx);
			$TotalVisto = mysqli_num_rows($resulx);

			$Regla3 = ($TotalVisto * 100) / $TotalSub;

			if($Regla3 < 100)
			{
				$Progreso = round($Regla3, 0, PHP_ROUND_HALF_UP);
			}
			else
			{
				$Progreso = $Regla3;
			}

			//print_r("Elprogreso es: ".$Progreso);


			?>
            <!--
            <center>
            <img src="../img/Letras.png" alt="Letras"/>
            </center>
            -->

           <div class="container">
               <div class="progress">
               	<?PHP
				if($Progreso <= 20)
				{
				?>
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>
                 <?PHP
				}
				else if($Progreso <= 50)
				{
				 ?>
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>
                 <?PHP
				}
				else if($Progreso <= 70)
				{
				 ?>

                 <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                  </div>

                <?PHP
				}
				else
				{
				 ?>
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?PHP echo htmlentities($Progreso); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?PHP echo htmlentities($Progreso); ?>%">
                    <?PHP echo htmlentities($Progreso); ?>%
                 </div>
                <?PHP
				}
				 ?>

               </div>


			<br>

			<?PHP

			if($TipoArchivo == "PDF")
			{
			?>
			<div class="row" id="PDF">
				<div class="col-sm-12">
					<?PHP
					if($rowDoc['ubica'] != "")
					{
						if($NumDoc > 1)
						{
						$queryx = "SELECT * FROM material_doc WHERE id_Subtema = '$IDSubtema';";
						$resultax = mysqli_query($conexia,$queryx);
					?>
                    	<div class="row bg-info">
                        	<div class="col-md-3 col-xs-12">

                                    <br>
                                    <center><h4><b>Seleccione uno de los documentos disponibles</b></h4></center>
                                    <br>

									<?PHP
                                        while($rowD = mysqli_fetch_array($resultax))
                                        {
                                            $ubica = $rowD['ubica'];
                                            $NombreDoc = substr($rowD['ubica'], 11, strlen($ubica));
                                    ?>
                                    	<form action="#" method="post">
                                            <input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema">
                                            <input type="hidden" value="<?PHP echo htmlentities($ubica); ?>" name="Doc">
                                            <input type="submit" class="btn btn-info boton" value="<?PHP echo htmlentities($NombreDoc); ?>" id="10">
                                        </form>
                                        <br>

                                    <?PHP
                                        }
                                    ?>

                            </div> <!-- Fin del div class del menu botones -->

                   			<div class="col-md-9 col-xs-12">

                            	<?PHP
									if($Doc == "")
									{
										$Doc = "../Mat_Doc/Default.pdf";
									}
								?>
                                <object data="<?PHP echo htmlentities($Doc); ?>" width="100%" height="900" type="application/pdf" id="PDF2"></object>

                            </div> <!-- Fin del div class del Documento -->
                        </div> <!-- Fin del div class row de los botones -->

                    <?PHP
						}
						else
						{
					?>

					<div clas="embed-responsive embed-responsive-16by9">
						<object data="<?PHP echo htmlentities($rowDoc['ubica']); ?>" width="100%" height="900" type="application/pdf" id="PDF"></object>
					</div>

					<?PHP
						} //Fin del if NumDoc
					}
					else
					{
					?>
					<div class="col-sm-8 col-sm-offset-2 well">
						<h4><center> Aún no se ha cargado material para este Subtema </center></h4>
					</div>
					<?PHP } ?>
				</div>
			</div>

            <?PHP
			} //Fin del if para el audio
			else if($TipoArchivo == "VIDEO")
			{
			?>


			<div class="row" id="Video">

            	<?PHP
					if($rowVid['ubica'] != "")
					{
						if($NumVid > 1)
						{
						$queryx1 = "SELECT * FROM material_video WHERE id_Subtema = '$IDSubtema';";
						$resultax1 = mysqli_query($conexia,$queryx1);


					?>
                    	<div class="row bg-info">
                        	<div class="col-md-3 col-xs-12">

                                    <br>
                                    <center><h4><b>Seleccione uno de los videos disponibles</b></h4></center>
                                    <br>

									<?PHP
                                        while($rowV = mysqli_fetch_array($resultax1))
                                        {
                                            $ubica1 = $rowV['ubica'];
                                            $NombreVid = substr($rowV['ubica'], 13, strlen($ubica1));
                                    ?>
                                    	<form action="#" method="post">
                                            <input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema">
                                            <input type="hidden" value="<?PHP echo htmlentities($ubica1); ?>" name="Vid">
                                            <input type="submit" class="btn btn-info boton" value="<?PHP echo htmlentities($NombreVid); ?>" id="10">
                                        </form>
                                        <br>

                                    <?PHP
                                        }
                                    ?>

                            </div> <!-- Fin del div class del menu botones -->

                   			<div class="col-md-9 col-xs-12">

                            	<?PHP
									if($Vid == "")
									{
										$Vid = "../Mat_Video/Video1.mp4";
									}
								?>
                                <center><video src="<?PHP echo htmlentities($Vid); ?>" controls width="600" height="500"></video></center>

                            </div> <!-- Fin del div class del Documento -->
                        </div> <!-- Fin del div class row de los botones -->

                    <?PHP
						}
						else
						{
					?>

					<div clas="embed-responsive embed-responsive-16by9">
						<center><video src="<?PHP echo htmlentities($rowVid['ubica']); ?>" controls height="500"></video></center>
					</div>

					<?PHP
						} //Fin del if NumVid
					}
					else
					{
					?>
					<div class="col-sm-8 col-sm-offset-2 well">
						<h4><center> Aún no se ha cargado material para este Subtema </center></h4>
					</div>
					<?PHP } ?>

			</div> <!-- Fin del row video -->

            <?PHP
			} //Find el if para el video
			else
			{
			?>


            <div class="row" id="Audio">
				<div class="col-xs-6 col-xs-offset-3 well">

					<?PHP
					if($rowAud['ubica'] != "")
					{
						if($NumAud > 1)
						{
						$queryx2 = "SELECT * FROM material_audio WHERE id_Subtema = '$IDSubtema';";
						$resultax2 = mysqli_query($conexia,$queryx2);
					?>
                    	<div class="row bg-info">
                        	<div class="col-md-3 col-xs-12">

                                    <br>
                                    <center><h4><b>Seleccione uno de los podcast disponibles</b></h4></center>
                                    <br>

									<?PHP
                                        while($rowA = mysqli_fetch_array($resultax2))
                                        {
                                            $ubica2 = $rowA['ubica'];
                                            $NombreAud = substr($rowA['ubica'], 13, strlen($ubica2));
                                    ?>
                                    	<form action="#" method="post">
                                            <input type="hidden" value="<?PHP echo htmlentities($IDSubtema); ?>" name="IDSubtema">
                                            <input type="hidden" value="<?PHP echo htmlentities($ubica2); ?>" name="Aud">
                                            <input type="submit" class="btn btn-info boton" value="<?PHP echo htmlentities($NombreAud); ?>" id="10">
                                        </form>
                                        <br>

                                    <?PHP
                                        }
                                    ?>

                            </div> <!-- Fin del div class del menu botones -->

                   			<div class="col-md-9 col-xs-12">

                            	<?PHP
									if($Aud == "")
									{
										$Aud = "../Mat_Audio/Audio1.mp3";
									}
								?>
                                <center>
							<h4>Potcast de este subtema</h4>
							<br><br><br>
							<audio controls>
								<source src="<?PHP echo htmlentities($Aud); ?>" type="audio/mp3" /> Tu navegador no es compatible
							</audio>
						</center>

                            </div> <!-- Fin del div class del Audio -->
                        </div> <!-- Fin del div class row de los botones -->

                    <?PHP
						}
						else
						{
					?>

					<center>
							<h4>Potcast de este subtema</h4>
							<br><br><br>
							<audio controls>
								<source src="<?PHP echo htmlentities($rowAud['ubica']); ?>" type="audio/mp3" /> Tu navegador no es compatible
							</audio>
						</center>

					<?PHP
						} //Fin del if NumVid
					}
					else
					{
					$band = 0;
					?>
					<div class="col-sm-8 col-sm-offset-2 well">
						<h4><center> Aún no se ha cargado material para este Subtema </center></h4>
					</div>
					<?PHP } ?>


				</div>
			</div> <!-- Fin del row audio -->

            <?PHP
			} //Fin del if para el audio
			?>


        </div><!-- Fin del container -->

<br><br>


	</body>

	</html>
