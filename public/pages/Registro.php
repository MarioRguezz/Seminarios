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

<div class="container "> <!-- Div principal -->

<form action="Registro.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClass">Nombre</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="nombre" name="nombre" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="apaterno" class="control-label col-md-3 whiteClass">Apellido Paterno</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="apaterno"  name="apaterno" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="amaterno" class="control-label col-md-3 whiteClass">Apellido Materno</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="amaterno" name="amaterno" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="email" class="control-label col-md-3 whiteClass">Email</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="email" name="email" type="email" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="password" class="control-label col-md-3 whiteClass">Contraseña</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="password" name="password" type="password" placeholder="" required>
    </div>
</div>

<div class="form-group">
<label for="opcion" class="control-label col-md-3 whiteClass">Sexo</label>
    <div class="col-md-6">
    <select class="form-control NoRadius" name="sexo" id="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>
    </div>
</div>


<div class="form-group">
<label for="telofi" class="control-label col-md-3 whiteClass">Telefono de oficina</label>
    <div class="col-md-6">
    <input class="form-control NoRadius"  maxlength="15" id="telofi" name="telofi" type="tel" pattern="^\d{7,}$" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="telcasa" class="control-label col-md-3 whiteClass">Telefono de casa</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" maxlength="15" id="telcasa" name="telcasa" type="tel" pattern="^\d{7,}$"  placeholder="">
    </div>
</div>

<div class="form-group">
<label for="celular" class="control-label col-md-3 whiteClass">Telefono celular</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" maxlength="20" id="celular" name="celular" type="tel" pattern="^\d{7,}$"  placeholder="">
    </div>
</div>

<div class="form-group">
<label for="estado" class="control-label col-md-3 whiteClass">Estado</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="estado" name="estado" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
<label for="municipio" class="control-label col-md-3 whiteClass">Municipio</label>
    <div class="col-md-6">
    <input class="form-control NoRadius" id="municipio" name="municipio" type="text" placeholder="">
    </div>
</div>

<div class="form-group">
	<label for="opcion1" class="control-label col-md-3 whiteClass">Tipo de usuario</label>
    <div class="col-md-6">
    <select class="form-control NoRadius" name="Tuser" id="Tuser">
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


      /*  $extension = substr($_FILES["PDF"]["type"], (strlen($_FILES["PDF"]["type"])-3), strlen($_FILES["PDF"]["type"]));
        $NuevoNombre = 	$_POST['email'].".".$extension;
        $archivo = $NuevoNombre;
        $carpeta = "../Mat_Doc/";


        if($archivo != "")
        {
          opendir($carpeta);
          $destino = $carpeta.$archivo;
          copy($_FILES['PDF']['tmp_name'],$destino);

          $consulta = "INSERT INTO material_doc (id_Subtema, ubica) VALUES ('$clave', '$destino');";

          if(mysqli_query($conec,$consulta))
          {				}
          else
          {
            echo "hubo un error al subir el archivo de audiointente de nuevo".mysqli_error();
          }
        }
      */


		?>
</body>


</html>
