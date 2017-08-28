<div style="position:absolute; z-index:200; background: #FFF; top: 0px; left:0px; right:0px; padding:20px; margin:0px;  border-bottom: 4px solid #A1A1A1;" class="col-sm-12 row">
  <div class="col-xs-4" >
  <a style="color:#009999 !important"
              href="http://<?php echo $_SERVER['SERVER_NAME']?>/Seminarios/public/logout">
    <img src="../img/byondiconos/BEYOND2-56.png"  height="45">
  </div>
    <?php

      include '../../php/conexion.php';
      session_start();

  $conect = conect();

	$queryname = "SELECT Nombre, APaterno, AMaterno FROM persona WHERE email = '" .$_SESSION['email']."';";
	$resultadoquery = mysqli_query($conect,$queryname);
	$row_fetch_array = mysqli_fetch_array($resultadoquery);
	$nombre_usuario = $row_fetch_array['Nombre'];
	$apPaterno_usuario = $row_fetch_array['ApPaterno'];
	$apMaterno_usuario = $row_fetch_array['ApMaterno'];
    ?>
      <div class="col-xs-6 down" >
    <!--  	<a class="menuOption NoShadow " href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/Seminarios/public/">PÁGINA PRINCIPAL</a>-->
      </div>
      <div class="col-xs-2">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" style="border:none !important; color:#009999 !important;"
          type="button" id="menu1" data-toggle="dropdown"><?php echo "$nombre_usuario $apPaterno_usuario $apMaterno_usuario";?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a style="color:#009999 !important"
              href="http://<?php echo $_SERVER['SERVER_NAME']?>/Seminarios/public/logout">
              CERRAR SESIÓN</a>
           </li>
        </ul>

        </div>
      </div>
    </div>
