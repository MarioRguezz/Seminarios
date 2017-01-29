<?PHP

include '../php/conexion.php';

$Alumno = $_POST['Alu'];
$Tema = $_POST['Tema'];

$conex = conect();

$sql = "SELECT Status FROM habilita_exam WHERE Mat_Alu = '$Alumno' AND IDTema = '$Tema';";
$resultadoses = mysql_query($sql);		
$rowses = mysql_fetch_array($resultadoses);


if($rowses['Status'] == ""){
	
	$consulta = "INSERT INTO habilita_exam (IDTema, Mat_Alu, Status) Values('$Tema', '$Alumno', 'ACTIVO');";
	if(mysql_query($consulta, $conex))
	{	}
	else
	{
		echo mysql_error()."<br>";
	}
//*
}
else 
{
	if ($rowses['Status'] == "INACTIVO")
	{
		$consulta = "UPDATE habilita_exam SET Status = 'ACTIVO' WHERE Mat_Alu = '$Alumno';";
	}
	else
	{
		$consulta = "UPDATE habilita_exam SET Status = 'INACTIVO' WHERE Mat_Alu = '$Alumno';";
	}
	if(mysql_query($consulta, $conex))
	{	}
	else
	{
		echo mysql_error()."<br>";
	}
}
//*/
?>