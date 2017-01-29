<?PHP
include '../php/conexion.php';

$accion = $_GET['accion'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
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
        });
    </script>

    <script src="../js/personaJS.js"></script>

</head>

<body>

<center>
<h3 class="cssTitleRegistro">REGISTRO PARA NUEVOS USUARIOS</h3>
</center>
<br><br><br>


<!-- <div class="col-xs-6"> -->

<div class="container"> <!-- Div principal -->

<form action="Registro.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClass">Nombre</label>
    <div class="col-md-6">
    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="apaterno" class="control-label col-md-3 whiteClass">Apellido Paterno</label>
    <div class="col-md-6">
    <input class="form-control" id="apaterno"  name="apaterno" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="amaterno" class="control-label col-md-3 whiteClass">Apellido Materno</label>
    <div class="col-md-6">
    <input class="form-control" id="amaterno" name="amaterno" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="email" class="control-label col-md-3 whiteClass">Email</label>
    <div class="col-md-6">
    <input class="form-control" id="email" name="email" type="email" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="password" class="control-label col-md-3 whiteClass">Contraseña</label>
    <div class="col-md-6">
    <input class="form-control" id="password" name="password" type="password" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="opcion" class="control-label col-md-3 whiteClass">Sexo</label>
    <div class="col-md-6">
    <select class="form-control" name="sexo" id="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>
    </div>
</div>

<div class="form-group">
<label for="telofi" class="control-label col-md-3 whiteClass">Telefono de oficina</label>
    <div class="col-md-6">
    <input class="form-control" id="telofi" name="telofi" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="telcasa" class="control-label col-md-3 whiteClass">Telefono de casa</label>
    <div class="col-md-6">
    <input class="form-control" id="telcasa" name="telcasa" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="celular" class="control-label col-md-3 whiteClass">Telefono celular</label>
    <div class="col-md-6">
    <input class="form-control" id="celular" name="celular" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="estado" class="control-label col-md-3 whiteClass">Estado</label>
    <div class="col-md-6">
    <input class="form-control" id="estado" name="estado" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="municipio" class="control-label col-md-3 whiteClass">Municipio</label>
    <div class="col-md-6">
    <input class="form-control" id="municipio" name="municipio" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
	<label for="opcion1" class="control-label col-md-3 whiteClass">Tipo de usuario</label>
    <div class="col-md-6">
    <select class="form-control" name="Tuser" id="Tuser">
        <option value="0">Seleccione una opcion</option>
        <option value="Alumno">Alumno</option>
        <option value="Instructor">Instructor</option>
    </select>
    </div>
</div>

<!-- Parte oculta del formulario -->

<div class="form-group" id="foto">
<label for="foto" class="control-label col-md-3 whiteClass">Adjunte fotografía no mayor a 5 Mb</label>
<br>

  <label for="fotos" class="custom-file-upload">
    Fotografía
</label>
	<input type="file" name="Archivo1" id="fotos" class="btn btn-info">

</div>



<div class="form-group" id="CV">
<label for="foto" class="control-label col-md-3 whiteClass" whiteClass>Adjunte CV en PDF no mayor a 10 Mb</label>
<br>

  <label for="curriculum" class="custom-file-upload">
    Archivo PDF
</label>
<input type="file" class="inputfile" name="Archivo" id="curriculum" class="btn-register">

</div>

<div class="form-group">
	<div class="col-md-2 col-md-offset-4 ">
		<button class="buttonTransparentBorder buttonAlta" id="btn-registro" type="submit">Guardar registro &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
        <!-- <input type="submit" class="btn btn-primary" value="Guardar registro"> -->
    </div>
</div>

<!-- Fin de la parte oculta del formulario -->

</form>

</div> <!-- Fin del div principal Alumno-->


<?PHP

if($accion == 'Nu3v@')
		{
            $conec = conect();
			$archivo = "";
			$destino = "";

			if($_REQUEST['Tuser'] == 'Instructor')
			{
				$archivo = $_FILES["Archivo"]["name"];
				$carpeta = "../CV/";

				if($archivo != "")
				{
					opendir($carpeta);
					$destino = $carpeta.$archivo;
					copy($_FILES['Archivo']['tmp_name'],$destino);
				}

			}
			else
			{

				$archivo = $_FILES["Archivo1"]["name"];
				$carpeta = "../img/Profile/";

				if($archivo != "")
				{
					opendir($carpeta);
					$destino = $carpeta.$archivo;
					copy($_FILES['Archivo1']['tmp_name'],$destino);
				}
			}
			if($_REQUEST['Tuser'] == 'Instructor')
			{
        //echo "entro a instruc";
				$Consulta = "INSERT INTO usuario (email,curriculum) VALUES ('$_POST[email]', '$destino');";
			}
			else
			{
				$Consulta = "INSERT INTO alumno (email,fotografia) VALUES ('$_POST[email]', '$destino');";
			}
      //  echo $Consulta;
						if(mysqli_query($conec,$Consulta))
						{
                          //  echo $Consulta;
						}
						else
						{
						//	echo "hubo un error al enviar el mensaje intente de nuevo".mysqli_error();
						}

				$sql = "INSERT INTO persona (APaterno, AMaterno, Nombre, email, password, TUser, Estado, Municipio, TelOfi, TelCas,Celular, Sexo) VALUES ('$_POST[apaterno]', '$_POST[amaterno]', '$_POST[nombre]', '$_POST[email]', '$_POST[password]', '$_REQUEST[Tuser]', '$_POST[estado]', '$_POST[municipio]', '$_POST[telofi]', '$_POST[telcasa]', '$_POST[celular]', '$_REQUEST[sexo]');";
              //  echo $Consulta ."<br>";
              //  echo $sql;
				if(mysqli_query($conec,$sql))
				{
					echo '<script>

					swal({
					title: "Su solicitud ha sido enviada, por favor espere respuesta del administrador",
					text: "de clic en el boton para continuar",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#00FF00",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="login.php"
					}
					});

					</script>';


				}
				else
				{
					/*
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='Registro.php'</script>";
					//*/
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
						location.href="Registro.php"
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

</body>


</html>
