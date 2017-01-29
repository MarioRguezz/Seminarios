<?PHP
    include 'conexion.php';
    $con = conect();
    $user= $_POST['user'];
    
    echo json_encode(UserExiste($user));

?>