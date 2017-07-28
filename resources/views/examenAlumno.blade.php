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
    <link rel="stylesheet" href="{{url('css/Principal.css')}}">
    <link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">

    <link href="{{url('css/radiocss.css')}}" rel="stylesheet" />

    <script src="{{url('js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/inicio.js')}}"></script>
    <script src="{{url('js/jquery-ui.js')}}"></script>
    <script src="{{url('js/examen/examen.js')}}"></script>
    <script src="{{url('js/examen/model/respuesta.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
    <script src="{{url('js/efectos.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{url('js/spinner.js')}}"></script>

  <!-- <script src="{{url('js/autcomp.js')}}|"></script>-->

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
@include('header')
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
<div    class="titleContainer">
    <div class="titleImg">
      <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-33.png')}}" height="40" width="40">
      <span class="greenTitle">EXAMEN</span>

    </div>
  </div>
</div>
<div id="preguntas">
    <?php
    $IDTema = $_POST['IDTema'];
    $MatAlumno = $_POST['Mat_Alumno'];
        ?>
        <input type="hidden" value="<?PHP echo htmlentities($IDTema); ?>" name="IDTema" id="IDTema">
        <input type="hidden" value="<?PHP echo htmlentities($MatAlumno); ?>" name="Mat_Alumno" id="Mat_Alumno">
    @foreach($preguntas as $pregunta)
        <script type="text/javascript">
            var total = "{{count($preguntas)}}";
            </script>
        <?php
            $json = json_decode($pregunta->json);
        ?>
        @if($pregunta->tipo == 1)
            <div class='box contenedorpregunta col-md-10 col-md-offset-1' data-type="{{$pregunta->tipo}}" id="{{$json->guid}}">
                <h3 class="whiteClass gray normal">{{$pregunta->titulo}}</h3>
                <input type='text' class='textAreaExam space leftPosition examenInput   respuestaInput' placeholder='Coloca aquí tu respuesta'>
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
                <h3 class="whiteClass  pilltitle  pinkbackground  normal">&nbsp;&nbsp; {{$pregunta->titulo}}</h3>
                <script type="text/javascript">
                    var newIndex2 =   respuestas.length;
                   respuestas.push(new Respuesta());
                    respuestas[newIndex2].id ="{{$json->guid}}";
                    respuestas[newIndex2].id_pregunta ="{{$json->id}}";

                </script>
                @foreach($json->choices as $choice)
                    <input class="graybackground"  type='radio' id='{{$choice->guid}}' name='{{$json->guid}}' class='marginForceRight' value='{{$choice->value}}'><label class=" selectElements graybackground normal">&nbsp;&nbsp; {{$choice->name}}</label>

                    <script type="text/javascript">
                        $('#{{$choice->guid}}').change(function () {
                            for(var x=0; x<respuestas.length; x++){
                                if($(this).parent().attr('id') == respuestas[x].id ){
                                    respuestas[x].respuestas = $(this).val();
                               }
                            }
                        });
                    </script>
                    <br>
                @endforeach
            </div>
        @endif

            @if($pregunta->tipo == 3)
                <div class='box contenedorpregunta col-md-10 col-md-offset-1' data-type="{{$pregunta->tipo}}" id="{{$json->guid}}">
                    <h3 class="pilltitle   pinkbackground normal">&nbsp;&nbsp;{{$pregunta->titulo}}</h3>
                    <div class='leftPosition leftBox boxTop items' style="width:40%; height:200px" id="items-{{$json->guid}}">
                        @foreach($json->items as $item)
                            <div class='boxItem item normal' id='{{$item->guid}}'> {{$item->nombre}} </div>
                        @endforeach
                    </div>
                    <div class='rightPosition leftBox boxTop' style="width:40%; height:200px" id="casillas-{{$json->guid}}">
                        @foreach($json->casillas as $casilla)
                            <div class='text marco' id='{{$casilla->guid}}'> {{$casilla->nombre}} </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    $( function() {
                        $("#casillas-{{$json->guid}} > div").sortable({
                            connectWith: "#items-{{$json->guid}}",
                            revert:true,
                            receive: function(evento, ui) {
                                //Desde
                                console.log(evento.toElement.id);

                                //Hasta
                                console.log(evento.target.id);
                                var cas = evento.target.id;
                                var item = evento.toElement.id;


                                var checked = false;
                                respuestas.forEach((respuesta) => {
                                   if (respuesta.id == "{{$json->guid}}") {
                                       checked = true;
                                       for(var i = 0 ; i < respuesta.respuestas.length ; i++) {
                                           if(respuesta.respuestas[i].casilla == cas) {
                                               respuesta.respuestas[i].item = item;
                                               return;
                                           }

                                       }
                                       respuesta.respuestas.push( {
                                           casilla: cas,
                                           item: item
                                       });

                                   }
                                });

                                if(!checked) {
                                    var resp = new Respuesta();
                                    resp.id = "{{$json->guid}}";
                                    resp.id_pregunta ="{{$json->id}}";
                                    resp.respuestas.push({
                                        casilla: evento.target.id,
                                        item: evento.toElement.id
                                    });
                                    respuestas.push(resp);
                                }
                            }
                        });

                        $("#items-{{$json->guid}}").sortable({
                            //items: "> li."+cve_pregunta,
                            scroll: false,
                            connectWith: "#casillas-{{$json->guid}} > div",
                            revert:true
                        })
                    } );
                </script>
                <script src="{{url('js/respuestas.js')}}"></script>
            @endif

    @endforeach
    <button type="button" id="guardarExamen" class="NoRadiusColorButtonPill" style="width:100px;">Guardar</button>

</div>


</body>

</html>
