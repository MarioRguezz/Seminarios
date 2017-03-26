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
    <script src="../js/examen/pregunta.js"></script>

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
    <div class="container-fluid">
        <div class="form-horizontal ">
            <div class="text-center">
                <label class="control-label" id="VP"><h3 class="whiteClass2 top">CREACIÓN DE EXAMEN</h3></label>
            </div>
        </div>
        <div class=" col-md-12 well back" id="menu">
                    <div class="row">
                              <div  id="tituloNohay" class="col-md-7 col-md-offset-5 ">
                                <label class="tituloExtra">Aún no ha registrado ningún examen</label>
                                  <button class="btn btn-primary" id="nuevoExamen">Agregar nuevo formulario</button>
                            </div>
                    </div>
                <div class="hidden">
                    <label class="whiteClass2">Formulario</label>
                    <div>
                        <button id="nuevaPregunta"></button>
                    </div>
                    <div id="contenedorPreguntas">

                    </div>
                </div>
        </div>
    </div>


</body>

</html>
