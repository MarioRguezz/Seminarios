<!DOCTYPE html>
<html lang="es">

<head>
    <title>Diploma</title>
    <meta charset="utf-8" />
    <script src="../../../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../../../js/bootstrap/css/bootstrap.min.css">
    <script src="../../../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../css/general.css">
    <link rel="stylesheet" href="../../../css/radio.css">
    <link rel="stylesheet" href="../../../css/Principal.css">
    <script src="../../../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../dist/sweetalert.css">

    <style>
        html {
            height: 100%;
        }
    </style>
</head>

<body class="backgroundPrincipal">
<div class="container-fluid">
  <div  style="margin-top:10%;" class="row">
  <div class="col-sm-offset-5 col-md-6">
      <img src="../../../img/Icons/logo.png" alt="Smiley face" height="30%" width="30%">
  </div>
</div>
<div style=" text-align: center;" class="row">
        <div  class="col-md-12">
            <label  id="VP"><h3  class="whiteClass3 control-label top">¡Felicidades  {{$alumno->datos->Nombre}} {{$alumno->datos->APaterno}}  {{$alumno->datos->AMaterno}}!</h3></label>
        </div>
      </div>
        <div style=" text-align: center;" class="row">
            <div  class="col-md-12">
                <label class="whiteClass2" style="color: white;">Ha concluido el curso {{$tema->Nombre}}</label>
            </div>
        </div>
        <button id="continuar" style=" margin-left:48%;  margin-top:5%;"class="btn btn-primary"> Continuar </button>
</div>

<script>
$("#continuar").click(function(){
      location.href = "../../../pages/MisCursos.php" //cambiar por vista de aprobación
});

</script>
</body>

</html>
