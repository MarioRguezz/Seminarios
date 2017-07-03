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
    <script type="text/javascript" src="{{url('js/xepOnline.jqPlugin.js')}}"></script>
    <style>
        html {
            height: 100%;
        }

        @media print
      {
          * {-webkit-print-color-adjust:exact;}

      }

      @media print {
 .container-fluid {
    background-color: #9360AC !important;
    -webkit-print-color-adjust: exact;
}

h3{
  color: #FFF !important;
  -webkit-print-color-adjust: exact;
}

label{
  color: #FFF !important;
  -webkit-print-color-adjust: exact;
}

button{
  visibility:hidden !important;
}
}



    </style>
</head>

<body  class="backgroundPrincipal">
<div  class="container-fluid">
  <div  style="margin-top:10%;" class="row">
        <img style="margin-left:40%;background-color:#409798;"src="../../../img/Icons/logo.png" alt="Smiley face" height="20%" width="20%">

</div>
<div  style=" text-align: center;" class="row">

        <div  class="col-md-12">
            <label  id="VP"><h3  class="whiteClass3 control-label top" style="color:#409798">¡Felicidades  {{$alumno->datos->Nombre}} {{$alumno->datos->APaterno}}  {{$alumno->datos->AMaterno}}!</h3></label>
        </div>
      </div>
        <div style=" text-align: center;" class="row">
            <div  class="col-md-12">
                <label class="whiteClass2" style="color: #409798;">Ha concluido el curso {{$tema->Nombre}}</label>
            </div>
        </div>
        <div style=" margin-left:45%;  margin-top:5%;">
        <button id="continuar" class="btn btn-primary"> Continuar </button>
        <button id="print" class="btn btn-primary"> Imprimir </button>
      </div>
</div>

<script>
$("#continuar").click(function(){
      location.href = "../../../pages/MisCursos.php" //cambiar por vista de aprobación
});

$("#print").click(function(){
    window.print();
});




</script>
</body>

</html>
