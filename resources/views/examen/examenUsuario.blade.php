<!DOCTYPE html>
<html lang="es">

<head>
    <title>Examen</title>
    <meta charset="utf-8" />
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


    <script src="../js/pregunta.js"></script>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/radio.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/efectos.js"></script>
    <script src="../js/examen/model/examen.js"></script>
    <script src="../js/examen/model/pregunta.js"></script>
    <script src="../js/examen/model/choice.js"></script>
    <script src="../js/examen/model/item.js"></script>
    <script src="../js/examen/model/casilla.js"></script>
    <script src="../js/examen/app.js"> </script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <style>
        html {
            height: 100%;
        }
    </style>
</head>

<body class="backgroundPrincipal">
<input type="hidden" value="{{url('/')}}" id="_url">
<input type="hidden" value="{{$IDTema}}" id="_idTema">
<div class="container-fluid">
    <div class="form-horizontal ">
        <div class="text-center">
            <label class="control-label" id="VP"><h3 class="whiteClass2 top">NUEVO EXAMEN</h3></label>
        </div>
    </div>
    <div class=" col-md-12 well back" id="menu">
        <div class="row">
            <div class="col-md-7">
                <label class="whiteClass4" style="color: white;">Este es un diseñador de exámenes, para agregar una pregunta haz clic en el
                    botón "Nueva pregunta"</label>
            </div>
            <br>
            <br>
            <br>
            <div id="contenedorPreguntas">

            </div>
            <div class="box rightPosition" >
                <button id="nuevaPregunta" class="btn btn-primary">Nueva Pregunta</button>
                <button id="btnGuardar" class="btn btn-primary">Guardar</button>

            </div>
        </div>
    </div>
</div>


</body>

</html>
