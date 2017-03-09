<?PHP
include '../php/conexion.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cerrar sesión</title>

<script src="../dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

</head>

<body>

<?PHP 

	
	/*
	echo '<script>alert("Hasta luego gracias por su visita")</script> '; 	
	echo "<script>location.href='login.php'</script>";
	*/
	
	logout();
	
	echo '<script> 
													
	swal({   
	title: "¡Gracias por su visita!",   
	text: "Hasta luego de clic en el boton para salir",  
	type: "info",   
	showCancelButton: false,   
	confirmButtonColor: "#1A00FF",   
	confirmButtonText: "Salir",   
	cancelButtonText: "No, cancel plx!",   
	closeOnConfirm: false,   
	loseOnCancel: false }, 
	function(isConfirm){   
	if (isConfirm) 
	{
		location.href="login.php"	     
		
	} 
	});										
	</script>';
	
	

?>

</body>
</html>