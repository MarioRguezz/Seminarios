<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Guardar examen</title>

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

</head>

<body>
<?PHP
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_POST['idCurso'];
$html=$_POST['examen'];
$fecha = date("Y-m-d");

$IDExamen = substr($id,0, 2).'ex'.rand(1000, 9999);
//echo  json_encode($sql);

$sql="INSERT INTO examen (ID_Examen, id_Tema, htmlExa, fecha) VALUES('$IDExamen', '$id', '$html', '$fecha');";
print_r($sql);

if(mysqli_query($conexion,$sql1))
				{
			?>
					<div class="alert alert-success" align="center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <label class="btn-large ">El examen ha sido creado clic en el botón para continuar</label>
                    </div>
                    <center>
                    <form action="ExamenInstructor.php" method="post" target="_self">
                    	<input type="hidden" value="<?PHP echo htmlentities($id); ?>" name="IDTema">
                        <input type="submit" class="btn btn-info" value="Continuar">
                    </form>
                    </center>
             <?PHP
				}
				else
				{
					/*
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
					*/
				}

			mysqli_close($conec);

?>
</body>
</html>
