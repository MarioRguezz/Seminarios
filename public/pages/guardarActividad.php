<?PHP
//conexion

include '../php/conexion.php';

$conexion = conect();

$id=$_POST['idCurso'];
$html=$_POST['examen'];
$fecha = date("Y-m-d");

$IDExamen = 'DAD'.substr($id,0, 2).rand(1000, 9999);

$sql="INSERT INTO tema_actividad (id_Tema, id_Actividad, ubica) VALUES('$id', '$IDExamen', '$html');";


//*
if(mysqli_query($conexion, $sql))
				{

					echo json_encode($sql);
					$_SESSION["ActDAD"] = $IDExamen;
				}
				else
				{

				}

			mysqli_close($conec);

//*/

?>
