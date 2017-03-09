<?PHP
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_POST['idCurso'];
$html=$_POST['examen'];
$fecha = date("Y-m-d");

$IDExamen = substr($id,0, 2).'ex'.rand(1000, 9999);

$sql="INSERT INTO examen (ID_Examen, id_Tema, htmlExa, fecha) VALUES('$IDExamen', '$id', '$html', '$fecha');";


//*
if(mysqli_query($conexion,$sql))
				{

					echo json_encode($sql);
					$_SESSION["IDExam"] = $IDExamen;
				}
				else
				{

				}

			mysqli_close($conec);

//*/

?>
