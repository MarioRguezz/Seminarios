<?PHP
include '../php/conexion.php';

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];

$IDCurso = $_GET['IDCurso'];


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
		echo '<script>alert("Acceso denegado... Sitio exclusivo para instructores y administradores")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();


	$queryxe = "SELECT * FROM persona WHERE email = '$email';";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
}


$email = $_SESSION["email"];

$Matricula = 0;
$conexia = conect();


	$Total = 0;
	$qwerty = "SELECT COUNT(*) as Total From curso_participante";
	$baia = mysqli_query($conexia,$qwerty);
	$fila = mysqli_fetch_array($baia);
	$Total = $fila['Total'];

mysqli_close($conexia);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Cursos Instructor</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Main.css">
    <link href="../css/radiocss.css" rel="stylesheet" />
    <script src="../dist/sweetalert.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
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

    <link rel="stylesheet" type="text/css" href="../css/jquery.tzCheckbox.css" />
	<script src="../js/CB.js"></script>
	<script src="../js/jquery.tzCheckbox.js"></script>


	<style>
	html{
		height:100%;
	}
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
					<span class="greenTitle">LISTA DE ALUMNOS INSCRITOS AL CURSO</span>
				</div>
			</div>
		</div>
<!--
<div class = container>
-->

<div >
	<table  class="tableSize"  align="center">
    <tr class="pinkbackground">
    	<th class="weight borderpillbegin"><center>Nombre</center></th>
        <th class="weight"><center>Correo</center></th>
        <th class="weight"><center>Estatus</center></th>
        <th class="weight borderpillend"><center>Información</center></th>
    </tr>
		<tr class="separateRow">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
	 </tr>

	<?PHP
		$color = 0;
		$conex = conect();
		$consulta = "SELECT P.APaterno, P.AMaterno, P.Nombre, P.email, CP.status, CP.Mat_Alumno FROM alumno A JOIN curso_participante CP ON A.Mat_Alumno = CP.Mat_Alumno JOIN persona P ON A.email = P.email WHERE CP.id_Curso = '$IDCurso'";

		$res = mysqli_query($conex,$consulta);
		while($row = mysqli_fetch_array($res))
		{
			if ($color == 0)
			{
	?>
    <tr class="graybackground">
     		<?PHP
			$color = 1;
			}
			else
			{
			?>
    <tr class="graybackground">
            <?PHP
			$color = 0;
			}
			?>
    	<td class="borderpillbegin"><center> <?PHP echo htmlentities($row['APaterno']." ". $row['AMaterno']." ".$row['Nombre']); ?> </center></td>
        <td><center> <?PHP echo htmlentities($row['email']); ?> </center></td>
            <!--<td><center> <?PHP// echo htmlentities($row['Mat_Alumno']); ?> </center></td> -->



            <?PHP
            if($row['status'] == '1'){
                echo '  <td>
               <input type="hidden" value=" '.$row['Mat_Alumno'].' " name="Mat_Alumno">
               <input type="hidden" value=" '.$IDCurso.' " name="id_Curso">
               <center> <button  type="submit" style="width:200px;" class="elementoButton buttonpill"> Alta  </button></center></td>
            ';


           //



            } else if ($row['status'] == '0'){
                echo '<td>
               <input type="hidden" value=" '.$row['Mat_Alumno'].' " name="Mat_Alumno">
               <input type="hidden" value=" '.$IDCurso.' " name="id_Curso">
                <center> <button type="submit" style="width:200px;" class="elementoButton buttonpill"> Baja </button></center></td>
            ';
            }
            ?>




            <form action="Perfil.php" class="form-horizontal" method="post" enctype="multipart/form-data" >
        <input type="hidden" value="<?PHP echo htmlentities($row['email']); ?>" name="email">
        <td class="borderpillend"><center> <button type="submit"  class="buttonpillicon"> <span class="glyphicon glyphicon-info-sign"></span> </button></center></td>
        </form>

    </tr>
		<tr class="separateRow">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
	 </tr>
    <?PHP
		}
		desconectarBD();
	?>

	</table>

</div><!-- Fin del div principal -->

</body>
</html>
