<?PHP
    include 'conexion.php';
    $con = conect();
    $user= $_POST['email'];
  //  echo json_encode(UserExiste($user));
   $sql="select user from PERSONA where email='$user'";

  if(mysqli_query($con,$sql)){
          if(mysqli_affected_rows() > 0){
            $msg = 1;
          }
          else{
            $msg = 2;
          }
      }
      else{
        $msg= 2;
      }

      echo $msg;

?>
