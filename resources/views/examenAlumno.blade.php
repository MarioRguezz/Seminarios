<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Examen | Alumno</title>

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/passwordval.js')}}"></script>

    <link rel="stylesheet" href="{{url('js/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/Main.css')}}">

    <link rel="stylesheet" href="{{url('css/general.css')}}">
    <link rel="stylesheet" href="{{url('css/radio.css')}}">
    <link rel="stylesheet" href="{{url('css/Principal.css')}}'">
    <link rel="stylesheet" href="{{url('css/jquery-ui.css')}}'">

    <link href="{{url('css/radiocss.css')}}" rel="stylesheet" />

    <script src="{{url('js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/inicio.js')}}"></script>
    <script src="{{url('js/jquery-ui.js')}}"></script>
    <script src="{{url('js/examen/examen.js')}}"></script>
    <script src="{{url('js/examen/model/respuesta.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <script src="{{url('js/efectos.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{url('js/spinner.js')}}"></script>

    <script src="{{url('js/autcomp.js')}}|"></script>

    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <style>
        html{
            height: 100%;
        }
    </style>
</head>

<body class="backgroundPrincipal">
<center>
    <h3 class="cssTitleRegistro">EXAMEN</h3>
</center>
<div id="preguntas">
    @foreach($preguntas as $pregunta)

        <?php
            $json = json_decode($pregunta->json);
        ?>

        @if($pregunta->tipo == 1)
            <div class='box contenedorpregunta col-md-10 col-md-offset-1' data-type="{{$pregunta->tipo}}" id="{{$json->guid}}">
                <h3 class="whiteClass">{{$pregunta->titulo}}</h3>
                <input type='text' class='textArea space leftPosition respuestaInput' placeholder='Coloca aquí tu respuesta'>
            </div>
                <script type="text/javascript">
                    var newIndex =   respuestas.length;
                    respuestas.push(new Respuesta());
                    respuestas[newIndex].id ="{{$json->guid}}";
                    respuestas[newIndex].id_pregunta ="{{$json->id}}";
                    $('#'+respuestas[newIndex].id).children('input').change(function () {
                        respuestas[newIndex].respuestas  =  $('#'+respuestas[newIndex].id).children('input').val();
                    });
                </script>
        @endif
        @if($pregunta->tipo == 2)
            <div class='box contenedorpregunta col-md-10 col-md-offset-1' data-type="{{$pregunta->tipo}}" id="{{$json->guid}}">
                <h3 class="whiteClass">{{$pregunta->titulo}}</h3>
                @foreach($json->choices as $choice)

                    <input type='radio' name='{{$json->guid}}' class='marginForceRight' value='{{$choice->guid}}'> {{$choice->name}}
                    <br>
                @endforeach
            </div>
        @endif

        @if($pregunta->tipo == 3)
                <div class='box contenedorpregunta col-md-10 col-md-offset-1' data-type="{{$pregunta->tipo}}" id="{{$json->guid}}">
                    <h3 class="whiteClass">{{$pregunta->titulo}}</h3>
                    <div class='leftPosition leftBox boxTop items' id="items-{{$json->guid}}">
                        @foreach($json->items as $item)
                            <div class='boxItem' id='{{$item->guid}}'> {{$item->nombre}} </div>
                        @endforeach
                    </div>
                    <div class='rightPosition leftBox boxTop' id="casillas-{{$json->guid}}">
                        @foreach($json->casillas as $casilla)
                            <div class='text marco' id='{{$casilla->guid}}'> {{$casilla->nombre}} </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    $( function() {
                        $( ".boxItem" ).draggable({
                            revert: true
                        });

                        $( ".marco" ).droppable({
                            classes: {
                                "ui-droppable-active": "ui-state-active",
                                "ui-droppable-hover": "ui-state-hover"
                            },
                            drop: function( event, ui ) {
                                $( this )
                                        .addClass( "ui-state-highlight" )
                                        .find( "p" )
                                        .html( "Dropped!" );
                            }
                        });
                    } );
                </script>
                <script src="{{url('js/respuestas.js')}}"></script>
        @endif

    @endforeach
    <button type="button" id="guardarExamen" class="btn btn-primary">Guardar</button>

</div>


</body>

</html>
