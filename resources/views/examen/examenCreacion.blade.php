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
    @include('header')
<input type="hidden" value="{{url('/')}}" id="_url">
<input type="hidden" value="{{$IDTema}}" id="_idTema">
<input type="hidden" value="{{$tipo}}" id="tipo">
    <div class="container-fluid">
      @if(!isset($active))
        <div class="form-horizontal ">
            <div class="text-center">
              @if($tipo == "examen")
                <label style="margin-top:100px" class="control-label" id="VP"><h3 class="pinkTitle top">NUEVO EXAMEN</h3></label>
              @else
                <label class="control-label" id="VP"><h3 class="purpleTitle top">NUEVA ACTIVIDAD</h3></label>
              @endif
            </div>
        </div>
        <div class=" col-md-12 well back" id="menu">
          @if($tipo == "actividad")
        <div class="row">
                    <div class="form-group">
                        <label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre de la actividad:</label>
                        <div class="col-md-6">
                            <input class="form-control NoRadius" id="nombre" name="Nombre" type="text" placeholder="" required="">
                        </div>
                    </div>
        </div>
            <br>
            <div class="row">
                    <div class="form-group">
                        <label for="nombre" class="control-label col-md-3 whiteClassThin">Descripción</label>
                        <div class="col-md-6">
                            <textarea class="form-control NoRadius" maxlength="200" rows="5" id="descripcion" name="Descripcion" placeholder="" required=""></textarea>
                        </div>
                    </div>
            </div>

            @endif
            <br>
                <div class="row">
                    <div class="col-md-7">
                    <label class="grayTitle" >Este es un diseñador de actividades, para agregar una pregunta haz clic en el
                        botón "Nueva pregunta"</label>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div id="contenedorPreguntas">

                    </div>
                    <div class="box rightPosition" >
                        <button id="nuevaPregunta" class="NoRadiusColorButtonCircle">Nueva Pregunta</button>
                        <button id="btnGuardar" class="NoRadiusColorButtonCircle">Guardar</button>

                    </div>
                </div>
        </div>

      @else
      <div class="form-horizontal ">
          <div class="text-center">
              <label  style="margin-top:100px;" class="control-label" id="VP"><h3 class="purpleTitle top">Ya hay un examen registrado para este tema</h3></label>
          </div>
      </div>
      @endif
    </div>


</body>

</html>
