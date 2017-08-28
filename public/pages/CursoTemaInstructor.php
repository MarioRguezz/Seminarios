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

	$IDCurso = $_GET['IDCurso'];

	//var_dump($IDCurso);
	//print_r("El ID del curso es: ".$IDCurso);


	//$queryze = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$IDCurso';";
	$queryze = "SELECT * FROM curso_tema WHERE id_Curso = '$IDCurso';";
	$resultas = mysqli_query($conexia,$queryze);
	$NumRow = mysqli_num_rows($resultas);

	$queryzexa = "SELECT * FROM curso WHERE id_Curso = '$IDCurso';";
	$resultasa = mysqli_query($conexia,$queryzexa);
	$row = mysqli_fetch_array($resultasa);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Curso Instructor</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Main.css">
    <link href="../css/radiocss.css" rel="stylesheet" />

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/inicio.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/efectos.js"></script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();


			$("#form-eliminar").submit(function() {

				swal({
					title: "Eliminar examen",
					text: "¿Estás seguro que deseas eliminar este examen del tema?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Sí, eliminar",
					closeOnConfirm: true
					},
					function(){
						$("#form-eliminar").off('submit').submit();
						swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
				return false;
			});
        });


    </script>

    <script src="../js/spinner.js"></script>
<style>

</style>
</head>

<body class="backgroundPrincipal">
<!--	FIN	Menu en el Encabezado	-->

<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">

<button class="NoRadiusColorButtonPill" onclick="window.history.back();"><center> &nbsp; ⬅ &nbsp; </center> </button>
<div    class="titleContainer">
		<div class="titleImg">
				<img  class="imageMargin" src="../img/byondiconos/BEYOND2-33.png" height="40" width="40">
				<span class="greenTitle">ADMINISTRADOR DE CURSO <?PHP echo htmlentities($row['nombre']); ?></span>
		</div>
	</div>
</div>
<div class="form-group">
	<form action="CursoTemaInstructor.php" class="form-horizontal" method="get" enctype="multipart/form-data">
    <label for="nombre" class="control-label col-md-3 grayTitle">Nombre del tema</label>
	<input type="hidden" value="Nu3v@" name="accion">
    <div class="col-md-4">
    	<input class="form-control  weightAddCurso NoRadiusColor2" id="nombre" name="nombreTema" type="text" placeholder="" required>
    </div>

	<div class="col-md-3">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
            <th  class="tablaDesign"><button class="NoRadiusColorButtonPill alignCenter" type="submit" >Agregar Tema </button></th>
    </div>
    </form>
</div>


	<?PHP
	if($NumRow > 0)
	{
		$resx = mysqli_query($conexia,$queryze);
		while($filases = mysqli_fetch_array($resx))
		{
	?>
<div class="container">
	<table class="tableSize" style="width: 100% !important; margin-top:20px;"  align="center">
    <tr>
    	<th class="weight gray ">Tema</th>
        <th class="weight gray tablaDesign"><center><?PHP echo htmlentities($filases['Nombre']); ?> </center></th>
        <!--<form action="AltaSubtema.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">-->
				<form action="AltaSubtema.php" class="form-horizontal" method="get" enctype="multipart/form-data">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
          <!--  <th><center><button class="btn-info" type="submit">Agregar subtema &nbsp;<span class="glyphicon glyphicon-blackboard"></span> </center> </button></th> -->
 					<th class="tablaDesign">
						<center><button  style="width:205" class="NoRadiusColorButtonPill" type="submit">Agregar Subtema &nbsp;<img  src="../img/Icons/nuevosiconos/27.png"> </button></center></th>
				</form>


            <?PHP
            $sqlas = "SELECT * FROM tema_actividad WHERE id_Tema = '$filases[id_Tema]';";
			$resuxas = mysqli_query($conexia,$sqlas);
			$rowyas = mysqli_fetch_array($resuxas);

			if($rowyas['ubica'] == "")
			{
			?>
            <form action="../actividad/creacion" class="form-horizontal" method="get" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
                    <input type="hidden" value="actividad" name="type">
                    <!--<center><button class="btn-primary" type="submit">Agregar actividad &nbsp;<span class="glyphicon glyphicon-text-background"></span> </center> </button>-->
									<th class="tablaDesign">		<!--<center><button  class="buttonTransparent" type="submit"><img height="50" src="../img/Icons/Png/agregaractividad.png"> </button></center>--> </th>
                </form>
            <?PHP
			}
			else
			{
			?>
            <form action="../actividad/creacion" class="form-horizontal" method="get" enctype="multipart/form-data" target="_self">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
										<input type="hidden" value="actividad" name="type">
								  <!--  <center><button class="btn-danger" type="submit" disabled>Agregar actividad &nbsp;<span class="glyphicon glyphicon-text-background"></span> </center> </button> -->
									<th class="tablaDesign">	<!--<center><button  class="buttonTransparent" type="submit" disabled><img height="50" src="../img/Icons/Png/agregaractividad.png"> </button></center>  --> </th>
								</form>
            <?PHP
			}
			?>



            <?PHP
            $sql1 = "SELECT * FROM examen WHERE id_Tema = '$filases[id_Tema]';";
			$resux = mysqli_query($conexia,$sql1);
			$rowy = mysqli_fetch_array($resux);

			if($rowy['id_Tema'] == "")
			//htmlExa
			{
			?>
               <!-- <form action="examen.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">-->
                <form action="../examen/creacion" class="form-horizontal" method="get" enctype="multipart/form-data" target="_blank">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
										<input type="hidden" value="examen" name="type">
                  <!--  <center><button class="btn-primary" type="submit">Agregar examen &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>-->
                    <th class="tablaDesign">
												<center><button  class="NoRadiusColorButtonPill" style="width:205px" type="submit" >Agregar examen<img height="20" src="../img/Icons/nuevosiconos/26.png"> </button></center>  </th>
                </form>

        	<?PHP
			}
			else
			{
			?>
			<!--
            <form action="examen.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
            						  <th class="tablaDesign">	<center><button  class="NoRadiusColorButtonPill" style="width:205px" type="submit" disabled title="El examen ya ha sido creado para este tema">Agregar examen<img height="20" src="../img/Icons/nuevosiconos/26.png"> </button></center>  </th>

			</form>
			-->
			<form action="../examen/eliminar" id="form-eliminar" class="form-horizontal" method="post" enctype="multipart/form-data" >
                    <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
                    <input type="hidden" value="<?php echo $IDCurso ?>" name="IDCurso">
										<input type="hidden" value="examen" name="type">
                  <!--  <center><button class="btn-primary" type="submit">Agregar examen &nbsp;<span class="glyphicon glyphicon-list-alt"></span> </center> </button>-->
                    <th class="tablaDesign">
												<center><button  class="NoRadiusColorButtonPill" style="width:205px" type="submit" >Eliminar examen<img height="20" src="../img/Icons/nuevosiconos/26.png"> </button></center>  </th>
                </form>
            <?PHP
			}
			?>



        <?PHP
		if($rowy['id_Tema'] == "")
//htmlExa
		{
		?>
        <form action="ListaExamen.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
            <!--<center><button class="btn-danger" type="submit" title="No hay examen para este tema" disabled> <span class="glyphicon glyphicon-pencil"></span> </center> </button>-->
					<th class="tablaDesign">	<center><button  class="NoRadiusColorButtonPillicon verde" type="submit" title="No hay examen para este tema" disabled><img  src="../img/Icons/nuevosiconos/25.png"></button></center></th>
			  	</form>
        <?PHP
		}
		else
		{
		?>
        <form action="ListaExamen.php" class="form-horizontal" method="get" enctype="multipart/form-data">
            <input type="hidden" value="<?PHP echo htmlentities($filases['id_Tema']); ?>" name="IDTema">
            <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
          <!--  <center><button class="btn-info" type="submit" title="Editar participantes"> <span class="glyphicon glyphicon-pencil"></span> </center> </button>-->
				<th class="tablaDesign ">	<center><button  class="NoRadiusColorButtonPillicon verde" type="submit" title="Editar participantes"><img  src="../img/Icons/nuevosiconos/25.png"> </button></center></th>

				</form>
        <?PHP
		}
		?>

    </tr>
    <tr  class="graybackground">
    	<th  class="tablaDesign borderpillbegin">&nbsp;</th>
        <th class="weight tablaDesign">Subtema</th>
        <th class="weight tablaDesign">Descripción</th>
        <th></th>
				<th></th>
				<th   class="tablaDesign borderpillend">&nbsp;</th>
    </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "Select * FROM curso_subtema where id_Tema = '$filases[id_Tema]';";

		$res = mysqli_query($conex,$consulta);
		while($fila = mysqli_fetch_array($res))
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
    <tr>
            <?PHP
			$color = 0;
			}
			?>
    	<td class="tablaDesign"><center> &nbsp; </center></td>
        <td class="tablaDesign"><center> <h5 class="cells gray"> <?PHP echo htmlentities($fila['Nombre']); ?> </h5></center></td>
        <td class="tablaDesign"><h5 class="cells gray"> <?PHP echo htmlentities($fila['Descrip']); ?> </h5></td>
      <!--  <form action="EditaSubtema.php" class="form-horizontal" method="post" enctype="multipart/form-data" target="_self">-->
			<form action="EditaSubtema.php" class="form-horizontal" method="get" enctype="multipart/form-data">
        <input type="hidden" value="<?PHP echo htmlentities($fila['id_Subtema']); ?>" name="IDSubtema">
        <input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
        <td class="tablaDesign">
				<!--	<center> <button type="submit" class="btn-warning">editar &nbsp;<span class="glyphicon glyphicon-pencil"></span></center>-->
				<center><button  style="background:transparent; border:none;" class=" " type="submit"><img style="width:100px; " src="../img/Icons/nuevosiconos/editar1.png"> </button></center>
					</td>
        </form>

    </tr>
    <br>
    <?PHP
		}
	} //Fin del while para los temas
		//desconectarBD();
	?>

	</table>
	<?PHP
		} //FIn del if para comprobar si existe al menos un Tema dado de alta en el curso
		else
		{
	?>
    <center>
	<h3 class="purpleTitle top"><b>No se ha registrado ningun tema para este curso</b></h3>
	</center>
    <?PHP
		}
	?>

</div><!-- Fin del div principal -->

</body>

<?PHP

if($accion == 'Nu3v@')
		{
			$clave = substr($_GET['nombreTema'],0, 2).rand(1000, 9999);
			$fecha = date("Y-m-d");
			$IdeCurso = $_GET['IDCurso'];
			//var_dump($IdeCurso);

			$conec = conect();
			$sql = "INSERT INTO curso_tema (id_Curso, id_Tema, Nombre, fecha) VALUES ('$IdeCurso', '$clave',  '$_GET[nombreTema]', '$fecha');";


				if(mysqli_query($conec,$sql))
				{
					/*
					echo "<script>location.href='CursoTemaInstructor.php'</script>";

					echo '<script>alert("El tema se ha dado de alta de clic en boton actualizar")</script> ';
					$accion="VACIO";
					//*/

					echo '<script>swal("AVISO","El tema se ha dado de alta de clic en boton actualizar", "success");</script> ';
					?>


                    <br><br>
                    <center>
                    <div class="form-group">
                    <form action="CursoTemaInstructor.php" method="get">
                    	<input type="hidden" value="<?PHP echo htmlentities($IdeCurso); ?>" name="IDCurso">
                        <button type="submit" class="buttonTransparentBorder buttonAlta" style="color:#409798;" title="Clic aquí para actualizar datos"> Actualizar lista &nbsp; <span class="glyphicon glyphicon-log-in"></span></button>
                    </form>
                    </div>
                    </center>
                    <br><br>
                    <?PHP

				}
				else
				{
				/*
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='CursoTemaInstructor.php'</script>";
					echo mysqli_error();
				*/
				echo '<script>

					swal({
					title: "Hubo un error, intentelo más tarde",
					text: "de clic en el boton para continuar",
					type: "error",
					showCancelButton: false,
					confirmButtonColor: "#FF0000",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="CursoTemaInstructor.php"
					}
					});

					</script>';
				}

						mysqli_close($conec);
			//*/
		}

?>

<br><br><br><br>
<br><br>

</html>
