<?php 

 include '../../php/conexion.php';
      session_start();

  $conexia = conect();

	$queryze = "SELECT IdPersona FROM persona WHERE email = '" .$_SESSION['email']."';";
	$resultas = mysqli_query($conexia,$queryze);
	$row = mysqli_fetch_array($resultas);
$idPersona = $_SESSION['IdPersona']; ?>

<?php if($_SESSION['tipoP']  == "Alumno"){ ?>
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>ALUMNO</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="../alumno">
        <div class="col-xs-10">
            <img src="../../public/img/byondiconos/BEYOND2-42.png">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="CursosDisponibles.php" target="_self">
          <div class="col-xs-10">
            <img src="../../public/img/byondiconos/BEYOND2-43.png"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>

     </div>
</div>

<?php } ?>

<?php if($_SESSION['tipoP']  == "Instructor"){ ?>
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>INSTRUCTOR</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="MisCursosInstructor.php">
        <div class="col-xs-10">
            <img src="../../public/img/byondiconos/BEYOND2-31.png">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="AltaCurso.php"  target="_self">
          <div class="col-xs-10">
            <img src="../../public/img/byondiconos/BEYOND2-32.png"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>

     </div>
</div>
</div>

<?php } ?>



