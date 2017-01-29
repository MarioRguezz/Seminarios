<?PHP 
include '../php/conexion.php';

$accion = $_GET['accion'];

$TipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];


if(isset($_SESSION['tipoP']))
{
}
else
{
	echo '<script>alert("Acceso denegado... Por favor inica sesión")</script> ';   
	echo "<script>location.href='login.php'</script>";	
}

if($TipoPer == "Alumno")
{
	logout();
		echo '<script>alert("Acceso denegado... Sitio exclusivo de los administradores")</script> ';   
		echo "<script>location.href='login.php'</script>";			
}

	$conexia = conect();	
	

	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysql_query($queryxe);		
	$rowses = mysql_fetch_array($resultadoses);
	
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


    <title>Perfil</title>
</head>

<body>

<!--	FIN	Menu en el Encabezado	

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

<?PHP

if($_POST['tipoUs'] == 'Instructor')
{

?>

    <div class="container form-group">
        <div class="row">
            <div class="form-group"></div>
            <div class="btn-group col-xs-6 col-xs-offset-3" data-toggle="buttons">                
                <label class="btn btn-warning rd col-xs-4" title="Datos generales del aspirante" data-toggle="tooltip" data-placement="bottom" title="boton 1" id="2">
                    <input type="radio">Información</label>
                <label class="btn btn-info rd col-xs-4" title="Curriculum del aspirante" data-toggle="tooltip" data-placement="top" title="boton 2" id="3">
                    <input type="radio">Curriculum</label>
            </div>
        </div>
        <br>
        <br>
        <br>    

        <div class="row" id="divpdf">
            <div class="col-xs-12 well">
            <?PHP
			
			$query = "SELECT * FROM persona WHERE email = '$_POST[email]';";
			$resultas = mysql_query($query);		
			$row = mysql_fetch_array($resultas);			
			?>                
            
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="form-group">
                <label for="nombre" class="control-label col-md-3">Nombre</label>
                    <div class="col-md-6">
                    <input class="form-control" id="nombre" name="nombre" type="text" value=" <?PHP echo htmlentities($row['Nombre']." ".$row['APaterno']." ".$row['AMaterno']); ?>" readonly>
                    </div>
                </div>                
                
                
                <div class="form-group">
                <label for="email" class="control-label col-md-3">Correo electronico</label>
                    <div class="col-md-6">
                    <input class="form-control" type="text" id="email" name="email" value="<?PHP echo htmlentities($row['email']); ?>" readonly>
                    </div>
                </div>                
                
                
                <div class="form-group">
                <label for="opcion" class="control-label col-md-3">Sexo</label>
                    <div class="col-md-5">
                    <input class="form-control" type="text" id="sex" name="sex" value="<?PHP echo htmlentities($row['Sexo']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="telofi" class="control-label col-md-3">Telefono de oficina</label>
                    <div class="col-md-6">
                    <input class="form-control" id="telofi" name="telofi" type="text" value="<?PHP echo htmlentities($row['TelOfi']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="telcasa" class="control-label col-md-3">Telefono de casa</label>
                    <div class="col-md-6">
                    <input class="form-control" id="telcasa" name="telcasa" type="text" value="<?PHP echo htmlentities($row['TelCas']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="celular" class="control-label col-md-3">Telefono celular</label>
                    <div class="col-md-6">
                    <input class="form-control" id="celular" name="celular" type="text" value="<?PHP echo htmlentities($row['Celular']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="estado" class="control-label col-md-3">Estado</label>
                    <div class="col-md-6">
                    <input class="form-control" id="estado" name="estado" type="text" value="<?PHP echo htmlentities($row['Estado']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="municipio" class="control-label col-md-3">Municipio</label>
                    <div class="col-md-6">
                    <input class="form-control" id="municipio" name="municipio" type="text" value="<?PHP echo htmlentities($row['Municipio']); ?>" readonly>
                    </div>
                </div>      
		</form>
            
            </div>
        </div>

        <div class="row" id="video">
            <div class="col-xs-12">
            	<div class="embed-responsive embed-responsive-16by9">
                <?PHP
				$querys = "SELECT curriculum FROM usuario WHERE email = '$_POST[email]';";
				$resultado = mysql_query($querys);		
				$fila = mysql_fetch_array($resultado);
				?>
                    <object data=" <?PHP echo htmlentities($fila['curriculum']); ?>" width="100%" height="100%" type="application/pdf">
                    </object>
                </div>
                <!--
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="100%" height='auto' src="https://www.youtube.com/embed/PIh2xe4jnpk">
                    </iframe>
                </div>
                -->
            </div>


        </div>
    </div>
<?PHP
}
else
{
			
			$querys = "SELECT fotografia FROM alumno WHERE email = '$_POST[email]';";
			$resultad = mysql_query($querys);		
			$fila = mysql_fetch_array($resultad);			
			
			?>                

<div class="container">           
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
				
                 <div class="form-group">                
                    <div class="col-md-6">
							<?PHP
								if($fila['fotografia'] != "")
								{
							?>
                           	<img src=" <?PHP echo htmlentities($fila['fotografia']); ?>" width="200" height="200"  alt="Perfil"/>
<?PHP
								}
								else
								{
							?>
                            <img src="../img/iconos/profile.png" width="200" height="200"  alt="Perfil"/>
                            <?PHP
								}
							?>
                    </div>
                </div> 
                
                <?PHP
				$query = "SELECT * FROM persona WHERE email = '$_POST[email]';";
				$resultas = mysql_query($query);		
				$row = mysql_fetch_array($resultas);			
				
				?> 
                
                <div class="form-group">
                <label for="nombre" class="control-label col-md-3">Nombre</label>
                    <div class="col-md-6">
                    <input class="form-control" id="nombre" name="nombre" type="text" value=" <?PHP echo htmlentities($row['Nombre']." ".$row['APaterno']." ".$row['AMaterno']); ?>" readonly>
                    </div>
                </div>                
                
                
                <div class="form-group">
                <label for="email" class="control-label col-md-3">Correo electronico</label>
                    <div class="col-md-6">
                    <input class="form-control" type="text" id="email" name="email" value="<?PHP echo htmlentities($row['email']); ?>" readonly>
                    </div>
                </div>                
                
                
                <div class="form-group">
                <label for="opcion" class="control-label col-md-3">Sexo</label>
                    <div class="col-md-5">
                    <input class="form-control" type="text" id="sex" name="sex" value="<?PHP echo htmlentities($row['Sexo']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="telofi" class="control-label col-md-3">Telefono de oficina</label>
                    <div class="col-md-6">
                    <input class="form-control" id="telofi" name="telofi" type="text" value="<?PHP echo htmlentities($row['TelOfi']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="telcasa" class="control-label col-md-3">Telefono de casa</label>
                    <div class="col-md-6">
                    <input class="form-control" id="telcasa" name="telcasa" type="text" value="<?PHP echo htmlentities($row['TelCas']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="celular" class="control-label col-md-3">Telefono celular</label>
                    <div class="col-md-6">
                    <input class="form-control" id="celular" name="celular" type="text" value="<?PHP echo htmlentities($row['Celular']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="estado" class="control-label col-md-3">Estado</label>
                    <div class="col-md-6">
                    <input class="form-control" id="estado" name="estado" type="text" value="<?PHP echo htmlentities($row['Estado']); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="municipio" class="control-label col-md-3">Municipio</label>
                    <div class="col-md-6">
                    <input class="form-control" id="municipio" name="municipio" type="text" value="<?PHP echo htmlentities($row['Municipio']); ?>" readonly>
                    </div>
                </div>      
		</form>
</div>

<?PHP
}
?>

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