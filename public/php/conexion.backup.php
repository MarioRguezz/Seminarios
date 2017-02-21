<?PHP
error_reporting(0);

session_start();

function conect($host = "localhost:3306", $user = "user", $psw = "password", $db = "database"){

	$con = mysqli_connect($host,$user,$psw, $db) or die ("Error en conexión MySQL");

	if (!$con){
	}
	return $con;
}

function desconectarBD($con){
	mysqli_close($con);
}


function Logear($username,$password){
	$con = conect();
    $username=mysqli_real_escape_string($con,$username);

	if ($password!=NULL)
	{
        $sql="select * from persona where email = '$username'";
		$query = mysqli_query($con, $sql);
        $data = mysqli_fetch_array($query);
		//print_r($data);

		if(($data['email'] != $username ))
		{
            return 0;
		}

		if($data['password'] == $password)
		{
            $_SESSION["tipoP"]=$data['TUser'];
			$_SESSION["email"] = $data['email'];

			//print_r($_SESSION["tipoP"]);

            return 1;
        }
    }
    return 0;
}


function logout(){
  unset($_SESSION['tipoP']);
  unset($_SESSION['email']);
  unset($_SESSION["IDExam"]);
  session_destroy();
}


function InsertPersona($user,$pass,$email,$tipo){
$con = conect();
    $sql="insert into PERSONA values('$user','$pass','$email','$tipo');";


    if(mysqli_query($con,$sql)){
        if(mysqli_affected_rows() > 0){$msg = 3;}
        else{$msg = 2;}
    }
    else{$msg = 2;}

    return $msg;

}

//funcion para obtener los datos de una persona
function get_persona(){
$con = conect();
    $sql="SELECT U.Mat_Usuario, P.APaterno, P.AMaterno, P.Nombre FROM persona P JOIN Usuario U ON P.email = U.email;
";
    $consulta=mysqli_query($con,$sql);

	echo $sql;

	if($fila = mysqli_fetch_array($consulta))
	{
        $persona=new stdClass();
		$persona->Matricula = $fila['Mat_Usuario'];
        $persona->Nombre = $fila['APaterno']." ".$fila['AMaterno']." ".$fila['Nombre'];

		$respuesta=$persona;

    }
    return $respuesta;
}

function get_Personas(){
	$con = conect();
    $sql="select U.Mat_Usuario, CONCAT(P.APaterno,' ',P.AMaterno,' ',P.Nombre) as NombreC FROM persona P JOIN Usuario U ON P.email = U.email WHERE TUser!='Administrador'";
    $i=0;
    $respuesta=array();

    $consulta=mysqli_query($con,$sql);

    while($fila=mysqli_fetch_array($consulta)){

		$respuesta[$i]=array('id'=>$fila['Mat_Usuario'],'nombre' => $fila['NombreC']);
		$i++;
    }
    return $respuesta;
}

/*
function UserExiste($user){
$sql="select user from PERSONA where user='$user'";

if(mysqli_query($sql)){
        if(mysqli_affected_rows() > 0){$msg = 1;}
        else{$msg = 2;}
    }
    else{$msg = 2;}

    return $msg;

}
*/

?>
