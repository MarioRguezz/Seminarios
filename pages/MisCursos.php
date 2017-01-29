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
	

	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysql_query($queryxe);		
	$rowses = mysql_fetch_array($resultadoses);
	
	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';   
		echo "<script>location.href='login.php'</script>";		
}




$Matricula = 0;			
$conexia = conect();	

	$queryze = "SELECT Mat_Alumno FROM alumno WHERE email = '$email';";
	$resultas = mysql_query($queryze);		
	$row = mysql_fetch_array($resultas);			
	$Matricula = $row['Mat_Alumno'];

			
			/*
			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante";
			$baia = mysql_query($qwerty);
			$fila = mysql_fetch_array($baia);
			$Total = $fila['Total'];	
			//*/
			
mysql_close($conexia);		

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Cursos</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
    <link href="../css/radiocss.css" rel="stylesheet" />
    
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/inicio.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/efectos.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
    <script src="../js/spinner.js"></script>         


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
<h1><b>Mis Cursos</b></h1>
</center>

<br><br>
<div class="container">
	<table class="table table-bordered table-hover table-responsive">
    <tr class="danger">
    	<th><center>Nombre del curso</center></th>        
        <th><center>Instructor</center></th>
        <th><center>Progreso</center></th>
        <th><center></center></th>        
    </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "SELECT * FROM curso C JOIN curso_informacion CI ON C.id_Curso = CI.ID_Curso JOIN curso_participante CP ON C.id_Curso = CP.id_Curso JOIN curso_instructor CIN ON C.id_Curso = CIN.id_Curso WHERE CP.Mat_Alumno = '$Matricula';"; 
		
		$res = mysql_query($consulta);
		while($row = mysql_fetch_array($res))
		{
			
			$queryta = "SELECT * FROM curso_tema CT JOIN curso C ON CT.id_curso = C.id_Curso WHERE C.id_Curso = '$row[id_Curso]';";
			$resultasxax = mysql_query($queryta);	
			$rowta = mysql_fetch_array($resultasxax);
			
			$queryTotal = "SELECT * FROM curso_subtema CS JOIN curso_tema CT ON CS.id_Tema = CT.id_Tema WHERE CT.id_Curso = '$row[id_Curso]';";
			$resultadoTotal = mysql_query($queryTotal);
			$TotalSub = mysql_num_rows($resultadoTotal);
			          
			$sqlx = "SELECT * FROM subtema_visto WHERE id_Curso = '$row[id_Curso]' AND Mat_Alumno = '$row[Mat_Alumno]' AND Visto != '0';";
			$resulx = mysql_query($sqlx);
			$TotalVisto = mysql_num_rows($resulx);
			
			$Regla3 = ($TotalVisto * 100) / $TotalSub;
			
			if($Regla3 < 100)
			{
				$Progreso = round($Regla3, 0, PHP_ROUND_HALF_UP);
			}
			else
			{
				$Progreso = $Regla3;
			}
			
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
    	<td><center> <?PHP echo htmlentities($row['nombre']); ?> </center></td> 
        <?PHP
		
			$Total = 0;
			$qwerty = "SELECT COUNT(*) as Total From curso_participante WHERE id_Curso = '$row[id_Curso]';";
			$baia = mysql_query($qwerty);
			$fila = mysql_fetch_array($baia);
			$Total = $fila['Total'];
		
			$querys = "SELECT P.APaterno, P.AMaterno, P.Nombre FROM Persona P JOIN usuario U ON P.email = U.email WHERE u.Mat_Usuario = '$row[Mat_Usuario]'";
			$Nombre_Ins = "";
			$resultado = mysql_query($querys);		
			$rowses = mysql_fetch_array($resultado);			
			$Nombre_Ins = $rowses['APaterno']." ".$rowses['AMaterno']." ".$rowses['Nombre'];	
		?>       
        <td><center> <?PHP echo htmlentities($Nombre_Ins); ?> </center></td>
        
        <td>
        <!-- <center> <?PHP //echo htmlentities($Total." / ".$row['per_num']); ?> </center>-->
        
        <div class="progress">
        		<?PHP
				if($Progreso == 0)
				{
				?>
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                    0%
                  </div>
                
               	<?PHP
				}
				else if($Progreso <= 20)
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
        
        </td>        
        
        <?PHP
			if($tipoPer == "Instructor")
			{
				$Mat = $row['Mat_Usuario'];
		?>
        <form action="CursoTemaAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data">
        <?PHP
			}
			else if($tipoPer == "Alumno")						
			{
				$Mat = $row['Mat_Alumno'];
		?>
        	<form action="CursoTemaAlumno.php" class="form-horizontal" method="post" enctype="multipart/form-data">
            <?PHP
			}
			else 
			{
				echo '<script>alert("Por el momento no hay opciones para otros usuarios")</script> '; 
				$accion="VACIO";   
				echo "<script>location.href='MisCursos.php'</script>";  
			}
		?>
        <input type="hidden" value="<?PHP echo htmlentities($row['id_Curso']); ?>" name="IDCurso">
        <input type="hidden" value="<?PHP echo htmlentities($Mat); ?>" name="Mat_Alumno">
        <td><center> <button class="btn btn-success" id="btn-Ir" type="submit">Ir al curso &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center></td>
        </form>
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