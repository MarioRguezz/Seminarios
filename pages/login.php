<?PHP
include '../php/conexion.php';

//$con = conect();
$res=20;

//*
if($_POST['user']!=NULL){
    $res=Logear($_POST['user'],$_POST['pass']);
    unset($_POST['user']);

}

if(isset($_SESSION['tipoP'])){
    //echo '<meta http-equiv="refresh" content="0;URL=principal.php">';
	//echo "Ya ha iniciado sesión";
}
//*/

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Durango</title>
<script src="../js/jquery.min.js"></script>
    <script src="../js/passwordval.js"></script>


    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Principal.css">
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
    <style>
    html{
    	height: 100%;
    }
    </style>

</head>

<body class="backgroundLogin">

    <div class="col-xs-10 col-xs-offset-2">
  <img src="../img/Icons/logo.png" width="350px" height="250px" />
    <br>
    <h1 class="whiteClass2 marginlefttitle">  SEMINARIO</h1>
    <h3 class="SubtitlewhiteClass">Bienvenido, ingrese usuario </h3>
    <h3 class="SubtitlewhiteClass">y password para entrar</h3>

    <br><br>

                 <!--Login-->
                                <form id="login-form" action="#" method="post" class="" role="form" style="display:inline-block; width:350px;">
                                    <div class="form-group">
                                        <?PHP
										if($res==0)
										{
										?>

                                            <div class="alert alert-danger" align="center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <label class="btn-large ">Usuario o constraseña incorrectos</label>
                                            </div>

                                        <?PHP
										}
										?>

                                                <?PHP
												if($res==1)
												{
													/*
													echo '<script>alert("Bienvenido")</script> ';

													echo '<script>sweetAlert("Bienvenido", "success");</script> ';

													echo "<script>location.href='principal.php'</script>";
													*/

													$accion="VACIO";
													echo '<script>

													swal({
													title: "¡Bienvenido!",
													text: "de clic en el boton para continuar",
													type: "success",
													showCancelButton: false,
													confirmButtonColor: "#00E02D",
													confirmButtonText: "Continuar",
													cancelButtonText: "No, cancel plx!",
													closeOnConfirm: false,
													closeOnCancel: false },

													function(isConfirm){
													if (isConfirm)
													{
														location.href="principal.php"
													}
													});

													</script>';


												}
												?>
                                <input type="text" name="user" id="username" tabindex="1" class="form-control NoRadius" placeholder="Nombre de usuario" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass" id="password" tabindex="2" class="form-control NoRadius " placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6 col-xs-offset-0">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control buttonLogin" value="COMENZAR">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <br><br><br>

                            <div class="form-group">
                            	<div class="col-md-5 col-md-offset-2">
                                	<h4 class="whiteClass thinWord NormalSizeWord"> ¿No estas registrado? Clic aqui para registrarse.</h4> <br>
                                  <a class="form-control buttonLogin alignCenter" href="Registro.php">REGISTRO</a>
                                </div>
                            </div>

</body>
</html>
