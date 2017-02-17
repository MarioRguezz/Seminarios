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
	$resultadoses = mysqli_query($conexia, $queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
	}

	$IDCurso = $_POST['IDCurso'];

	$qwerty = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$IDCurso';";
	$resultas = mysqli_query($conexia, $qwerty);
	$NumRow = mysqli_num_rows($resultas);
	$row = mysqli_fetch_array($resultas);

	$query = "SELECT * FROM curso_subtema CS JOIN curso_tema CT ON CS.id_Tema = CT.id_Tema WHERE CT.id_Curso = '$IDCurso';";
	$resultado = mysqli_query($conexia, $query);
	$TotalSub = mysqli_num_rows($resultado);


	$bandera = 0;
	$Orden = 0;
	$Padawan = "SELECT MAX(Orden) as Orden FROM subtema_visto WHERE id_Curso = '$IDCurso'";
	$ObiWan = mysqli_query($conexia, $Padawan);
	$Tmp = mysqli_fetch_array($ObiWan);
	$Orden = $Tmp['Orden'];
	if($Orden == NULL)
	{
		$bandera = 1;
	}
	$Orden = $Orden + 1;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Curso Alumno</title>

<script src="../js/jquery.min.js"></script>

	<!--<link rel="stylesheet" href="../css/styles.css">-->
    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal2.css">

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/script.js"></script>

    <!--<script src="../js/Visto.js"></script> -->
<style>
html{
	height: 100%;
}
</style>

</head>

<body>


<!--	INICIO Menu en el Encabezado	-->

<div class="Menu">
    <div class="col-md-1" >
        <a class="SubtitlewhiteClass NoShadow WithTop" href="#">Menú</a>
    </div>
    <div class="col-md-2" >
        <a class="SubtitlewhiteClass NoShadow WithTop" href="principal.php">Menú principal</a>
    </div>
    <div class="col-md-2 col-md-offset-3">
        <a class="SubtitlewhiteClass NoShadow WithTop" href="MisCursos.php">Mis cursos</a>
    </div>
    <div class="col-md-2">
        <a class="SubtitlewhiteClass NoShadow WithTop" >Curso <?PHP echo htmlentities($row['nombre']); ?></a>
    </div>
    <div class="col-md-2">
        <a class="SubtitlewhiteClass NoShadow WithTop" href="Cerrar.php">Cerrar sesión</a>
    </div>
</div>

<!--	FIN	Menu en el Encabezado	-->

<br>

<div class="contenedor top">

<?PHP
if($accion == 'C0R50')
{
	$IDSubtema = $_POST['IDSubtema'];
	$TipoArchivo = $_POST['TipoArchivo'];
	$TotalSub = $_POST['TotalSub'];
	$MatAlu = $_POST['MatAlu'];
	$IDCurso = $_POST['IDCurso'];
	$Tema = $_POST['Tema'];

	//print_r($IDSubtema."<br>");
	//print_r($TotalSub."<br>");
	//print_r($MatAlu."<br>");
	//print_r($IDCurso."<br>");
	//print_r($TipoArchivo);

	$Doc = $_POST['Doc'];
	$Vid = $_POST['Vid'];
	$Aud = $_POST['Aud'];



	$queryze = "SELECT * FROM material_video WHERE id_Subtema = '$IDSubtema';";
	$resultas = mysqli_query( $conexia, $queryze);
	$NumVid = mysqli_num_rows($resultas);
	$rowVid = mysqli_fetch_array($resultas);
	/*
	print_r($rowVid);
	print_r("<br>");
	//*/

	$queryze1 = "SELECT * FROM material_doc WHERE id_Subtema = '$IDSubtema';";
	$resultas1 = mysqli_query($conexia, $queryze1);
	$NumDoc = mysqli_num_rows($resultas1);
	$rowDoc = mysqli_fetch_array($resultas1);
	/*
	print_r($rowDoc);
	print_r("<br>");
	//*/

	$queryze2 = "SELECT * FROM material_audio WHERE id_Subtema = '$IDSubtema';";
	$resultas2 = mysqli_query($conexia, $queryze2);
	$NumAud = mysqli_num_rows($resultas2);
	$rowAud = mysqli_fetch_array($resultas2);
	//print_r($rowAud)

/* *****
	Copia de Visto.php
	***** */

$sqlsesx = "SELECT Visto FROM subtema_visto WHERE Mat_Alumno = '$MatAlu' AND id_Subtema = '$IDSubtema' AND id_Curso = '$IDCurso';";
$resultadosesx = mysqli_query($conexia, $sqlsesx);
$rowsesx = mysqli_fetch_array($resultadosesx);
//print_r($sqlsesx);

if($rowsesx['Visto'] == ""){

	$consultaxex = "INSERT INTO subtema_visto (id_Curso, id_Tema,id_Subtema, Mat_Alumno, Visto, Orden) Values('$IDCurso', '$Tema','$IDSubtema', '$MatAlu', '1', '$Orden');";
	if(mysqli_query($conexia, $consultaxex))
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
	if(mysqli_query($conexia, $consultaxex))
	{	}
	else
	{
		//echo "ERROR en la consulta UPDATE subtema_Visto   ".mysqli_error()."<br>";
	}
}

	/* *****
	Copia de Visto.php
	***** */

	$sqlx = "SELECT * FROM subtema_visto WHERE id_Curso = '$IDCurso' AND Mat_Alumno = '$MatAlu' AND Visto != '0';";
	$resulx = mysqli_query($conexia, $sqlx);
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
?>


	<div class="Vertical col-md-2">

<div id='cssmenu'>
<ul>
	<?PHP
	if($NumRow > 0)
	{
		$Ultvisto = 0;

		//print_r("El queryze es: ".$queryze."<br>");
		$resx = mysqli_query($conexia, $qwerty);
		while($filases = mysqli_fetch_array($resx))
		{
	?>

		<li class='has-sub'><a href='#'><?PHP echo htmlentities($filases['Nombre']); ?></a>
      	<ul>
	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "Select * FROM curso_subtema where id_Tema = '$filases[id_Tema]';";

		//print_r("La consulta es: ".$consulta."<br>");

		$res = mysqli_query($conexia, $consulta);
		while($fila = mysqli_fetch_array($res))
		{
			//print_r("El valor de la bandera es: ".$bandera."<br>");

			$sqlxox = "SELECT * FROM subtema_visto WHERE Mat_Alumno = '$rowses[Mat_Alumno]' AND id_Subtema = '$fila[id_Subtema]' AND id_Curso = '$IDCurso';";
			//print_r($sqlxox."<br>");
			$resultadoxox = mysqli_query($conexia, $sqlxox);
			$rowseso = mysqli_fetch_array($resultadoxox);

			//print_r("Valor de Orden de rowseso: ".$rowseso['Orden']."<br>");

			if($rowseso['Orden'] != NULL)
			{
				$Ultvisto = $rowseso['Orden'];
				//print_r("Entré a ultimo visto... <br>");
			}

			//print_r("El ultmo visto es: ".$Ultvisto."<br>");

			if($fila['Orden'] == $rowseso['Orden'])
			{
				$bandera = 1;
			}
			else if(($fila['Orden'] -1) == $Ultvisto)
			{
				$bandera = 1;
			}

			$consPDF = "SELECT ubica FROM material_doc WHERE id_Subtema = '$fila[id_Subtema]';";
			$resPDF = mysqli_query($conexia, $consPDF);
			$rowPDF = mysqli_fetch_array($resPDF);

			$consVid = "SELECT ubica FROM material_video WHERE id_Subtema = '$fila[id_Subtema]';";
			$resVid = mysqli_query($conexia, $consVid);
			$rowVid = mysqli_fetch_array($resVid);

			$consAud = "SELECT ubica FROM material_audio WHERE id_Subtema = '$fila[id_Subtema]';";
			$resAud = mysqli_query($conexia, $consAud);
			$rowAud = mysqli_fetch_array($resAud);
		?>

        <li> <a href='#'>

        <?PHP

		if($bandera == 1)
		{

			if($rowPDF['ubica'] != "")
			{
	?>
    <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
        <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
        <input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
        <input type="hidden" value="PDF" name="TipoArchivo">
        <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        <button type="submit" class="btn btn-default btn-xs Visto" title="Ver PDF"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-file"></span></button>
     </form>
     		<?PHP
			}
			else if($rowVid['ubica'] != "")
			{
			?>
            <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
       		<input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
            <input type="hidden" value="VIDEO" name="TipoArchivo">
            <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        	<button type="submit" class="btn btn-default btn-xs Visto" title="Ver Video"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-play"></span> </button>
     		</form>

     		<?PHP
			}
			else if($rowAud['ubica'] != "")
			{
			?>

            <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
       		<input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
            <input type="hidden" value="AUDIO" name="TipoArchivo">
            <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        	<button type="submit" class="btn btn-default btn-xs Visto" title="Escuchar audio"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-headphones"></span> </button>
            </form>
    <?PHP
			}
			$bandera = 0;
		}//Fin del if bandera
		else
		{
	?>
    	<form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<button type="submit" class="btn btn-default btn-xs Visto" title="Por favor vea los subtemas anteriores" disabled> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span> </button>
        </form>

    <?PHP
		}
	?>
    		</a></li>
    <?PHP
		} //Fin del while que busca subtemas
	?>

    <li> <a href='#'>
    <?PHP
    echo "$rowses[MatAlumno]";
            $sqlx = "SELECT Status FROM habilita_exam WHERE IDTema = '$filases[id_Tema]' AND Mat_Alu = '$rowses[Mat_Alumno]';";
			$resuxo = mysqli_query($conexia, $sqlx);
			$rowy = mysqli_fetch_array($resuxo);


			$sql1 = "SELECT * FROM curso_subtema WHERE id_Tema = '$filases[id_Tema]'";
			$resux = mysqli_query($conexia, $sql1);
			$TotalTemas = mysqli_num_rows($resux);


			$sql2 = "SELECT * FROM subtema_visto WHERE id_Tema = '$filases[id_Tema]'";
			$resux2 = mysqli_query($conexia, $sql2);
			$TotalVisto = mysqli_num_rows($resux2);

			if($rowy['Status'] == "")
			{
			}
			else
			{

				//if($rowy['Status'] == "ACTIVO")
				if($TotalTemas == $TotalVisto && $rowy['Status'] == "ACTIVO")
				{
		?>
        		<form action="ExamenAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="Mat_Alumno">
                    <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                    <center><button class="btn-primary" type="submit">Realizar evaluación &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
                </form>

        <?PHP
				}
				else
				{
		?>
          		<form action="ExamenAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <center><button class="btn-danger" type="submit" disabled title="No se ha habilitado este examen, contacte a su instructor">Realizar evaluación &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
                </form>

        <?PHP
				}
			}
		?>
    		</a></li>

        <li> <a href='#'>
    <?PHP
            $sqlas = "SELECT * FROM tema_actividad WHERE id_Tema = '$filases[id_Tema]';";
			//print_r($sqlas);
			$resuxas = mysqli_query($conexia, $sqlas);
			$rowyas = mysqli_fetch_array($resuxas);
			if($rowyas['ubica'] == "")
			{
	?>
    		<!--
    		<form action="Actividad.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            	<input type="hidden" value="<?PHP //echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="btn-danger" type="submit" disabled title="No se ha habilitado alguna actividad">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>
            -->
    <?PHP
			}
			else
			{
		?>
        	<form action="Actividad.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            	<input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="buttonTransparentBorder buttonMedium" type="submit" title="Actividad de este tema">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>
        <?PHP
			}
		?>
    		</a></li>
        </ul>
    </li>
	<?PHP
		} //Fin del while para los temas
		desconectarBD();
	?>

    </ul>
</div>

<!--
<div class="embed-responsive embed-responsive-16by9 Contenido">
	<iframe class="embed-responsive-item" src="Default.php" name="tema"></iframe>
</div>
-->
	<?PHP
		} //FIn del if para comprobar si existe al menos un Tema dado de alta en el curso
		else
		{
	?>
    <center>
	<h3 class="whiteClass2 "><b>No se ha registrado ningun tema para este curso</b></h3>
	</center>
<?PHP
		}
?>

</div> <!-- Fin del class Vertical -->

	<!--
    *****
    Aquí va el panel izquierdo
    *****
    -->

    <div class="Contenido container col-md-8 col-md-offset-1">
    <br>

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
						$resultax = mysqli_query($conexia, $queryx);
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
                                <object data="<?PHP echo htmlentities($Doc); ?>" width="100%" height="700" type="application/pdf" id="PDF2"></object>

                            </div> <!-- Fin del div class del Documento -->
                        </div> <!-- Fin del div class row de los botones -->

                    <?PHP
						}
						else
						{
					?>

					<div clas="embed-responsive embed-responsive-16by9">
						<object data="<?PHP echo htmlentities($rowDoc['ubica']); ?>" width="100%" height="700" type="application/pdf" id="PDF"></object>
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
						$resultax1 = mysqli_query($conexia, $queryx1);


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
						$resultax2 = mysqli_query($conexia, $queryx2);
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


    </div> <!-- Fin del DIV del contenido -->

<?PHP
} //Fin del if accion

else
{
?>

<div class="Vertical col-md-2 top">

<div id='cssmenu'>
<ul>
	<?PHP
	if($NumRow > 0)
	{
		$Ultvisto = 0;

		$resx = mysqli_query($conexia, $qwerty);
		while($filases = mysqli_fetch_array($resx))
		{

	?>
		<li class='has-sub'><a href='#'><?PHP echo htmlentities($filases['Nombre']); ?></a>
      	<ul>
	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "Select * FROM curso_subtema where id_Tema = '$filases[id_Tema]';";


		$res = mysqli_query($conexia, $consulta);
		while($fila = mysqli_fetch_array($res))
		{
			//print_r("El valor de la bandera es: ".$bandera."<br>");

			$sqlxox = "SELECT * FROM subtema_visto WHERE Mat_Alumno = '$rowses[Mat_Alumno]' AND id_Subtema = '$fila[id_Subtema]' AND id_Curso = '$IDCurso';";
			//print_r($sqlxox."<br>");
			$resultadoxox = mysqli_query($conexia, $sqlxox);
			$rowseso = mysqli_fetch_array($resultadoxox);

			//print_r("Valor de Orden de rowseso: ".$rowseso['Orden']."<br>");

			if($rowseso['Orden'] != NULL)
			{
				$Ultvisto = $rowseso['Orden'];
				//print_r("Entré a ultimo visto... <br>");
			}

			//print_r("El ultmo visto es: ".$Ultvisto."<br>");

			if($fila['Orden'] == $rowseso['Orden'])
			{
				$bandera = 1;
			}
			else if(($fila['Orden'] -1) == $Ultvisto)
			{
				$bandera = 1;
			}

			$consPDF = "SELECT ubica FROM material_doc WHERE id_Subtema = '$fila[id_Subtema]';";
			$resPDF = mysqli_query($conexia, $consPDF);
			$rowPDF = mysqli_fetch_array($resPDF);

			$consVid = "SELECT ubica FROM material_video WHERE id_Subtema = '$fila[id_Subtema]';";
			$resVid = mysqli_query($conexia, $consVid);
			$rowVid = mysqli_fetch_array($resVid);

			$consAud = "SELECT ubica FROM material_audio WHERE id_Subtema = '$fila[id_Subtema]';";
			$resAud = mysqli_query($conexia, $consAud);
			$rowAud = mysqli_fetch_array($resAud);
		?>

        <li> <a href='#'>

        <?PHP

		if($bandera == 1)
		{

			if($rowPDF['ubica'] != "")
			{
	?>
    <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
        <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
        <input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
        <input type="hidden" value="PDF" name="TipoArchivo">
        <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        <button type="submit" class="btn btn-default btn-xs Visto" title="Ver PDF"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-file"></span></button>
     </form>
     		<?PHP
			}
			else if($rowVid['ubica'] != "")
			{
			?>
            <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
       		<input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
            <input type="hidden" value="VIDEO" name="TipoArchivo">
            <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        	<button type="submit" class="btn btn-default btn-xs Visto" title="Ver Video"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-play"></span> </button>
     		</form>

     		<?PHP
			}
			else if($rowAud['ubica'] != "")
			{
			?>

            <form action="CursoTemaAlumno.php?accion=C0R50" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema" id="IDSubtema">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="Tema" id="Tema">
       		<input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="MatAlu" id="MatAlu">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso" id="IDCurso">
            <input type="hidden" value="AUDIO" name="TipoArchivo">
            <input type="hidden" value="<?PHP echo htmlentities($TotalSub);?>" name="TotalSub">

        	<button type="submit" class="btn btn-default btn-xs Visto" title="Escuchar audio"> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-headphones"></span> </button>
            </form>
    <?PHP
			}
			$bandera = 0;
		}//Fin del if bandera
		else
		{
	?>
    	<form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
        	<button type="submit" class="btn btn-default btn-xs Visto" title="Por favor vea los subtemas anteriores" disabled> <?PHP echo htmlentities($fila['Nombre']); ?> &nbsp; <span class="glyphicon glyphicon-exclamation-sign"></span> </button>
        </form>

    <?PHP
		}
	?>
    		</a></li>
    <?PHP
		} //Fin del while que busca subtemas
	?>

    <li> <a href='#'>
    <?PHP
            $sqlx = "SELECT Status FROM habilita_exam WHERE IDTema = '$filases[id_Tema]' AND Mat_Alu = '$rowses[Mat_Alumno]';";
			$resuxo = mysqli_query($conexia, $sqlx);
			$rowy = mysqli_fetch_array($resuxo);


			$sql1 = "SELECT * FROM curso_subtema WHERE id_Tema = '$filases[id_Tema]'";
			$resux = mysqli_query($conexia, $sql1);
			$TotalTemas = mysqli_num_rows($resux);


			$sql2 = "SELECT * FROM subtema_visto WHERE id_Tema  = '$filases[id_Tema]'";
			$resux2 = mysqli_query($conexia, $sql2);
			$TotalVisto = mysqli_num_rows($resux2);

			//print_r("TotalTemas: ".$TotalTemas."<br>TotalVisto: ".$TotalVisto);

			if($rowy['Status'] == "")
			{
			}
			else
			{

				//if($rowy['Status'] == "ACTIVO")
				if($TotalTemas == $TotalVisto && $rowy['Status'] == "ACTIVO")
				{
		?>
        		<form action="ExamenAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <input type="hidden" value="<?PHP echo htmlentities($rowses['Mat_Alumno']); ?>" name="Mat_Alumno">
                    <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                    <center><button class="btn-primary" type="submit">Realizar evaluación &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
                </form>

        <?PHP
				}
				else
				{
		?>
          		<form action="ExamenAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <center><button class="btn-danger" type="submit" disabled title="No se ha habilitado este examen, contacte a su instructor">Realizar evaluación &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
                </form>

        <?PHP
				}
			}
		?>
    		</a></li>

            <li> <a href='#'>
    <?PHP
            $sqlas = "SELECT * FROM tema_actividad WHERE id_Tema = '$filases[id_Tema]';";
			//print_r($sqlas);
			$resuxas = mysqli_query($conexia, $sqlas);
			$rowyas = mysqli_fetch_array($resuxas);
			$opciones = substr($rowyas['id_Actividad'],0, 3);

			if($rowyas['ubica'] == "")
			{
	?>
    		<!--
    		<form action="Actividad.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            	<input type="hidden" value="<?PHP //echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="btn-danger" type="submit" disabled title="No se ha habilitado alguna actividad">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>
            -->
    <?PHP
			}
			else if($opciones == "ACT")
			{
		?>
        	<form action="Actividad.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            	<input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="buttonTransparentBorder buttonMedium" type="submit" title="Actividad de este tema">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>

        <?PHP
			}
			else if($opciones == "DAD")
			{
		?>
        	<form action="DAD.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            	<input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="buttonTransparentBorder buttonMedium" type="submit" title="Actividad de este tema">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>
        <?PHP
			}
			else
			{
				$Imagen = $rowyas['ubica'];
		?>
        	<form action="Puzzle.php" class="form-horizontal" method="post" target="_blank">
            	<input type="hidden" value="<?PHP echo htmlentities($Imagen); ?>" name="Imagen">
            	<input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                <center><button class="buttonTransparentBorder buttonMedium" type="submit" title="Actividad de este tema">Actividad &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>
            </form>
        <?PHP
			}
		?>
    		</a></li>

        </ul>
    </li>
	<?PHP
		} //Fin del while para los temas
		desconectarBD();
	?>

    </ul>
</div>

<!--
<div class="embed-responsive embed-responsive-16by9 Contenido">
	<iframe class="embed-responsive-item" src="Default.php" name="tema"></iframe>
</div>
-->
	<?PHP
		} //FIn del if para comprobar si existe al menos un Tema dado de alta en el curso
		else
		{
	?>
    <center>
	<h3 class="whiteClass2">No se ha registrado ningun tema para este curso</h3>
	</center>
<?PHP
		}
?>

</div> <!-- Fin del class Vertical -->

<div class="contenido col-md-9  top">

<center>

<img src="../img/Icons/Png/PrincipalAdmin-04.png"/><br>
    <h3 style="color:white">Seleccione un subtema del panel izquierdo</h3>

</center>

</div>

<?PHP
}
?>

</div> <!-- Fin del class Contenedor -->

<!-- </div><!-- Fin del div principal -->


</body>

<br><br>



</html>