<?PHP

include '../php/conexion.php';
include'../PHPMailer/class.phpmailer.php';

$accion = $_GET['accion'];

$tipoPer = $_SESSION["tipoP"];
$email = $_SESSION["email"];

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
		echo '<script>alert("Acceso denegado... Sitio exclusivo para Instructores y administradores")</script> ';
		echo "<script>location.href='login.php'</script>";
}

	$conexia = conect();

		$queryCA = "SELECT id_cliente_administrador FROM usuario WHERE email = '$email'";
		$resultadoQueryCA  = mysqli_query($conexia,$queryCA);
		$rowCA = mysqli_fetch_array($resultadoQueryCA);
		$idCliente = $rowCA['id_cliente_administrador'];
		$queryLicencia = "SELECT no_licencias FROM cliente_administrador  WHERE id = '$idCliente'";
		$resultadoQueryLicencia = mysqli_query($conexia,$queryLicencia);
		$rowLic = mysqli_fetch_array($resultadoQueryLicencia);
		$licencias = $rowLic['no_licencias'];

	$queryxe = "SELECT * FROM persona WHERE email = '$email' ;";
	$resultadoses = mysqli_query($conexia,$queryxe);
	$rowses = mysqli_fetch_array($resultadoses);

	if($rowses['Status'] == "BAJA")
	{
		logout();
		echo '<script>alert("Acceso denegado... No esta dado de alta, contacte a un administrador para solucionar su problema")</script> ';
		echo "<script>location.href='login.php'</script>";
}

			$IDCurso = 0;

			$conexia = conect();

			$queryze = "SELECT MAX(id_Curso) as id_Curso FROM curso;";

			$resultas = mysqli_query($conexia,$queryze);

			$row = mysqli_fetch_array($resultas);

			$IDCurso = $row['id_Curso'];

			$IDCurso = $IDCurso + 1;

			mysqli_close($conexia);


$con = conect();
$res= get_Personas();

	$queryzex = "SELECT Mat_Usuario FROM usuario WHERE email = '$email';";
	$resultass = mysqli_query($con,$queryzex);
	$rows = mysqli_fetch_array($resultass);
	$Matricula = $rows['Mat_Usuario'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Alta de curso</title>

<script src="../js/jquery.min.js"></script>
<script src="../js/passwordval.js"></script>

    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Main.css">
    <link href="../css/radiocss.css" rel="stylesheet" />

    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/inicio.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/efectos.js"></script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="../js/spinner.js"></script>

    <script src="../js/autcomp.js"></script>

    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<script>
		var data = [
    <?php
        for($i=0;$i<count($res);$i++){//25
    echo '{ value: "'.$res[$i]['nombre'].'", label: "'.$res[$i]['id'].'"},';}
            //echo '{ value: "nombre'.$i.'", label: "000'.$i.'"},';}
            ?>

            ];
</script>
</head>

<body class="backgroundPrincipal" >

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/header2.blade.php') ?>

<!--	FIN	Menu en el Encabezado	-->
<?php include('../../resources/views/barra_lateral2.blade.php'); ?>


<div class="container-fluid">
<button class="NoRadiusColorButtonPill" onclick="window.history.back();"><center> &nbsp; ⬅ &nbsp; </center> </button>
		<div style="margin-top:100px"   class="titleContainer">
				<div class="titleImg">
					<img  class="imageMargin" src="../img/byondiconos/textcajita.png" height="40" width="40">
					<span class="pinkTitle">ALTA DE CURSOS</span>
				</div>
			</div>


<div class="col-xs-9" >
<form action="AltaCurso.php?accion=Nu3v@" class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin gray normal">Nombre del curso</label>
    <div class="col-md-6">
    <input class="form-control NoRadiusColor2" id="nombre" name="nombre" type="text" placeholder="" required>
    </div>
</div>

<div class="form-group">
                    <label class="control-label col-md-3 whiteClassThin gray normal">Cupo</label>
                <div class="col-xs-6">
                    <div class="input-group number-spinner" style="border: 1px solid #009999; border-radius:12px; ">
                        <span class="input-group-btn data-dwn">
					<button type="button" class="btn btn-default NoRadiusColor2 " data-dir="dwn"><span class="">-</span></button>
                        </span>
                        <input id="Cupo" type="number" disabled class="form-control NoRadiusColor2 text-center" value="30" min="1" max="<?php  echo $licencias; ?>">
                        <input id="Cupo" name="Cupo" type="hidden" class="form-control" value="30">
                        <span class="input-group-btn data-up">
					<button type="button" class="btn btn-default NoRadiusColor2" data-dir="up"><span class="">+</span></button>
                        </span>
                    </div>
                </div>
 </div>

 <!--<div class="form-group">
 	<label class="control-label col-md-3 whiteClassThin">Su ID como instructor del curso</label>
    <div class="col-md-3">
    	<input class="form-control NoRadius" id="autocomplete" name="IDinstructor" type="text" placeholder="" required value="<?PHP echo htmlentities($Matricula); ?>" readonly>
    </div>
 </div> -->
    <input type="hidden" class="form-control NoRadiusColor2" id="autocomplete" name="IDinstructor" type="text" placeholder="" required value="<?PHP echo htmlentities($Matricula); ?>" readonly>

 <div class="form-group">
<label for="nombre" class="control-label col-md-3 whiteClassThin gray normal">Descripción</label>
    <div class="col-md-6">
    <textarea class="form-control NoRadiusColor2" maxlength="200" id="Descrip" name="Descripcion" placeholder="" required></textarea>
    </div>
</div>

    <div class="form-group">
        <label for="nombre" class="control-label col-md-3 whiteClassThin gray normal">Curso público</label>
        <div class="col-md-6">
            <input type="checkbox" class="form-control textPublic" name="publico" value="1" checked>
        </div>
    </div>
    <div class="form-group emailsGroup">


    </div>




<div class="form-group">
	<div class="col-md-2 col-md-offset-3">
		<button class="NoRadiusColorButtonPill " id="btn-registro" type="submit">Crear curso </button>
        <!-- <input type="submit" class="btn btn-primary" value="Guardar registro"> -->
    </div>
</div>

</form>

</div> <!-- Fin del div principal Alta curso-->
</div>

<?PHP

if($accion == 'Nu3v@')
		{

			//*


			$conec = conect();

			//var_dump($IDCurso);
		//	var_dump($_GET[IDinstructor]);

			$Consulta = "INSERT INTO curso_instructor (id_Curso, Mat_Usuario) VALUES ($IDCurso, '$_POST[IDinstructor]');";
           if($_POST[publico] == null) {
               $_POST[publico] = 0;
               include '../PHPMailer/PHPMailerAutoload.php';
               $arra = explode(" ", $_POST[emails]);
            //   var_dump($arra);
               for($i=0; $i< count($arra); $i++) {
                   //select Mat_Alumno from alumno where email='nerox@hotmail.com'
                   // $IDCurso
                 //  var_dump(count($arra));
                   $mail = new PHPMailer;
                   $mail->addAddress($arra[$i]);
                   $mail->isSMTP();                                      // Set mailer to use SMTP
                   $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                   $mail->SMTPAuth = true;                               // Enable SMTP authentication
                   $mail->Username = '08bits.team@gmail.com';                 // SMTP username
                   $mail->Password = '08bits_Team';                           // SMTP password
                   $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
                   $mail->Port = 587;
                   $mail->From = '08bits.team@gmail.com';
                   $mail->FromName = 'Byond';
                   // Add a recipient
                  // $mail->addReplyTo($arra[i], 'Information');
                   //$mail->addCC('cc@example.com');
                   // $mail->addBCC('bcc@example.com');
                   $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                   $mail->isHTML(true);                                  // Set email format to HTML
                   $mail->Subject = 'Here is the subject';
                   $mail->Body = 'Bienvenido al curso de Byond<b> ¡Desde tu navegador presiona el botón para quedar inscrito!</b> '.
                       '<form action="http://189.211.207.173/Seminarios/public/validar" class="form-horizontal" method="post" enctype="multipart/form-data" target="_blank">'.
                        '<input type="text" value=" '.$IDCurso.' " id="idCurso" name="idCurso">'.
                        '<input type="text" value="'.$arra[$i].'" id="email"name="email">'.
                      '<center> <button type="submit" class="elementoButton buttonTransparentBorder buttonAlta"> Ingresar Curso </button></center>'.
                    '</form>';
                   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                   if (!$mail->send()) {
                     //  echo 'Message could not be sent.';
                      // echo 'Mailer Error: ' . $mail->ErrorInfo;
                   } else {
                      // echo 'Message has been sent';
                   }
               }
               //http://189.211.207.173/Seminarios/public/ http://localhost/Seminarios
           }

						if(mysqli_query($conec,$Consulta))
						{
						}
						else
						{
							echo "hubo un error al ejecuta query curso_instructor intente de nuevo".mysqli_error();
						}

			$Consulta = "INSERT INTO curso_informacion (ID_Curso, per_num, Descrip, publico) VALUES ($IDCurso, '$_POST[Cupo]', '$_POST[Descripcion]', '$_POST[publico]');";

						if(mysqli_query( $conec,$Consulta))
						{
						}
						else
						{
							echo "hubo un error al ejecuta query curso_información intente de nuevo ".$Consulta;
						}

			$sql = "INSERT INTO curso (id_Curso, nombre, estatus) VALUES ($IDCurso, '$_POST[nombre]', 'ALTA');";

				if(mysqli_query($conec,$sql))
				{
					/*
					echo '<script>alert("Este curso se ha dado de alta")</script> ';
					$accion="VACIO";
                    echo "<script>location.href='MisCursosInstructor.php'</script>";
					*/

					echo '<script>

					swal({
					title: "Este curso se ha dado de alta",
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
						location.href="MisCursosInstructor.php"
					}
					});

					</script>';
				}
				else
				{
					/*
					echo '<script>alert("hubo un error intente de nuevo más tarde")</script> ';
					$accion="VACIO";
					echo "<script>location.href='MisCursosInstructor.php'</script>";
					*/
                    echo '<script>

					swal({
					title: "Error",
					text: "hubo un error intente de nuevo más tarde",
					type: "error",
					showCancelButton: false,
					confirmButtonColor: "#FF0000",
					confirmButtonText: "Continuar",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false },

					function(isConfirm){
					if (isConfirm)
					{
						location.href="MisCursosInstructor.php"
					}
					});

					</script>';

				}

						mysqli_close($conec);
			//*/
		}

		?>

		<br><br><br><br>
</body>

</html>
