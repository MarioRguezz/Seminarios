<?PHP
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_POST['IDTema'];
$IDCurso = $_POST['IDCurso'];

$Mat_Alu = $_POST['Mat_Alumno'];

$accion = $_GET['accion'];

$sql="SELECT * FROM examen WHERE id_Tema = '$id'";
$resultado = mysqli_query($conexion,$sql);
$row = mysqli_fetch_array($resultado);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Examen Instructor</title>

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

<center>
<h3>Instrucciones: En las opciones de completar, escriba la respuesta en MAYUSCULA</h3>
</center>
<br><br><br>

<form class="form-horizontal" action="GuardarExAlumno.php" method="POST" target="_self">

<div class="col-sm-9 col-sm-offset-1">

<?PHP
echo $row['htmlExa'];

?>
</div>
<br><br>
<input type="hidden" name="IDExamen" value="<?PHP echo htmlentities($row['ID_Examen']); ?>">
<input type="hidden" name="Mat_Alu" value="<?PHP echo htmlentities($Mat_Alu); ?>">
<input type="hidden" name="IDTema" value="<?PHP echo htmlentities($id); ?>">
<input type="hidden" value="<?PHP echo htmlentities($IDCurso); ?>" name="IDCurso">
<button type="submit" class="btn-register col-md-offset-6">Enviar examen	&nbsp; <span class="glyphicon glyphicon-saved"></span></button>
</form>


</body>

</html>
