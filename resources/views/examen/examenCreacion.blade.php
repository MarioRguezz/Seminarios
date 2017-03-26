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


<div class="container-fluid   ">
    <div class="form-horizontal ">
        <div class="text-center">
            <label class="control-label" id="VP"><h3 class="whiteClass2 top">VISTA PREVIA</h3></label>
        </div>
    </div>
    <div class="row affix-row col-sm-3 well back" id="menu">
        <div class="form-horizontal">
            <div class="form-group-sm ">

                <form action="guardarExamen.php" method="post">
                <input type="hidden" value="<?PHP /*echo htmlentities($IDTema);*/ ?>" id="IDTema">
                <button class="buttonTransparentBorder buttonAlta " id="guardar"><span class="glyphicon glyphicon-saved"></span> Guardar examen</button>
                <!--
               </form>
               -->
            </div>

            <div class="form-group">
                <label class="control-label whiteClassThin">Pregunta:</label>
                <textarea class="form-control" name="nomPreg" id="pregunta" rows="3" style="resize:none;" required></textarea>

            </div>
            <div class="form-group-sm">
                <div class="funkyradio rad">
                    <div class="funkyradio-primary">
                        <input type="radio" name="tipoPregunta" value="A" id="Abr" checked/>
                        <label for="Abr">Completar</label>
                    </div>
                    <div class="funkyradio-success">
                        <input type="radio" name="tipoPregunta" value="M" id="Mul" />
                        <label for="Mul">Respuesta Múltiple</label>
                    </div>

                    <div class="funkyradio-info">
                        <input type="radio" name="tipoPregunta" value="C" id="Col" />
                        <label for="Col">Relaciónar columnas</label>
                    </div>

                </div>
            </div>

            <div class="form-group" id="Nop">
                <div class="col-sm-11">
                    <label class="control-label"> Número de respuestas: </label>
                </div>
                <div class="col-sm-7">
                    <input type="number" name="nuop" id="nuop" min="2" max="10" value="3" class="form-control">
                </div>
                <div class="col-sm-5">

                    <button class="btn btn-info" id="okop"><span class="glyphicon glyphicon-ok"></span></button>
                </div>
            </div>

            <div class="form-group" id="NopC">
                <div class="col-sm-11">
                    <label class="control-label whiteClassThin"> Número de opciones: </label>
                </div>
                <div class="col-sm-7">
                    <input type="number" name="nuopC" id="nuopC" min="2" max="10" value="4" class="form-control">
                </div>
                <div class="col-sm-5">

                    <button class="btn btn-info" id="okopC"><span class="glyphicon glyphicon-ok"></span></button>
                </div>
            </div>

            <div id="opcion"></div>

            <div class="form-group-sm ">
                <button class="buttonTransparentBorder buttonMedium" id="botonG"><span class=" glyphicon glyphicon-plus"></span>Agregar </button>
            </div>
        </div>
    </div>

    <div class="affix-row  col-sm-4 col-sm-offset-1" id="2p">

        <div class="form-horizontal" id="exm"></div>

    </div>
</div>
</div>

</body>


<br><br><br><br>
<br><br>
</html>
