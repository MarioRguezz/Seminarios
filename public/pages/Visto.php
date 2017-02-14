<?PHP

include '../php/conexion.php';

$Alumno = $_POST['Alu'];
$Tema = $_POST['Tema'];
$Curso = $_POST['Curso'];

$conex = conect();

$sql = "SELECT Visto FROM subtema_visto WHERE Mat_Alumno = '$Alumno' AND id_Subtema = '$Tema' AND id_Curso = '$Curso';";
$resultadoses = mysqli_query($conex,$sql);
$rowses = mysqli_fetch_array($resultadoses);


if($rowses['Visto'] == ""){

	$consulta = "INSERT INTO subtema_visto (id_Curso, id_Subtema, Mat_Alumno, Visto) Values('$Curso','$Tema', '$Alumno', '1');";
	if(mysqli_query($conex,$consulta))
	{	}
	else
	{
		echo mysqli_error()."<br>";
	}
//*
}
else
{
	if ($rowses['Visto'] == "0")
	{
		$consulta = "UPDATE subtema_visto SET Visto = '1' WHERE Mat_Alumno = '$Alumno' AND id_Subtema = '$Tema' id_Curso = '$Curso';";
	}
	/*
	else
	{
		$consulta = "UPDATE subtema_visto SET Visto = '0' WHERE Mat_Alumno = '$Alumno' AND id_Subtema = '$Tema';";
	}
	//*/
	if(mysqli_query($conex,$consulta))
	{	}
	else
	{
		echo mysqli_error()."<br>";
	}
}
//*/
?>
