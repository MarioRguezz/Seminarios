c<?PHP
error_reporting(0);

session_start();

function conect($host = "localhost:3306", $user = "root", $psw = "", $db = "durango"){

	$con = mysqli_connect($host,$user,$psw, $db) or die ("PELAS");

	if (!$con){
	}
	return $con;
}

function desconectarBD($con){
	mysql_close($con);
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

    $sql="insert into PERSONA values('$user','$pass','$email','$tipo');";


    if(mysql_query($sql)){
        if(mysql_affected_rows() > 0){$msg = 3;}
        else{$msg = 2;}
    }
    else{$msg = 2;}

    return $msg;

}

//funcion para obtener los datos de una persona
function get_persona(){
    $sql="SELECT U.Mat_Usuario, P.APaterno, P.AMaterno, P.Nombre FROM persona P JOIN Usuario U ON P.email = U.email;
";
    $consulta=mysqli_query($sql);

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
    $sql="select U.Mat_Usuario, CONCAT(P.APaterno,' ',P.AMaterno,' ',P.Nombre) as NombreC FROM persona P JOIN Usuario U ON P.email = U.email WHERE TUser!='Administrador'";
    $i=0;
    $respuesta=array();

    $consulta=mysql_query($sql);

    while($fila=mysql_fetch_array($consulta)){

		$respuesta[$i]=array('id'=>$fila['Mat_Usuario'],'nombre' => $fila['NombreC']);
		$i++;
    }
    return $respuesta;
}

/*
function UserExiste($user){
$sql="select user from PERSONA where user='$user'";

if(mysql_query($sql)){
        if(mysql_affected_rows() > 0){$msg = 1;}
        else{$msg = 2;}
    }
    else{$msg = 2;}

    return $msg;

}
*/

?>
