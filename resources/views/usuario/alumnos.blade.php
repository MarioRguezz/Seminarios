<?PHP
?>
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro Alumnos</title>

    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/passwordval.js')}}"></script>


    <link rel="stylesheet" href="{{url('/js/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/Main.css')}}">
    <link href="{{url('/css/radiocss.css" rel="stylesheet')}}" />

    <script src="{{url('/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/inicio.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/login.css')}}">
    <script src="{{url('/js/efectos.js')}}"></script>
    <script src="{{url('/js/efectos.js')}}"></script>




    <script src="{{url('/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/dist/sweetalert.css')}}">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{url('/js/personaJS.js')}}"></script>

</head>

<body class="registro">
  @include('header')
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/19.png')}}" height="27" width="27">
          <span class="purpleTitle">LISTA DE ALUMNOS</span>
        </div>
      </div>
    </div>


<!-- <div class="col-xs-6"> -->

<div class="container "> <!-- Div principal -->

    <table class="table designTable"  align="center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estatus</th>
                <th></th>
                <th><a class="azul" href="{{url('/usuario/alumnonuevo/'.$administradores->id.'/'.$administradores->id_persona)}}">+</a></th>
            </tr>
        </thead>

        <tbody>

            @foreach($alumnos as $administrador)
                <tr>
                <td>{{$administrador->datos['Nombre']}}</td>
                <td>{{$administrador->datos['email']}}</td>
                <td>{{$administrador->datos['Status']}}</td>
                <td><a href="{{url('/usuario/alumnosedicion/'.$administrador->datos['IdPersona'].'/'.$administradores->id_persona)}}"><span class="glyphicon glyphicon-pencil verde"></span></a></td>
                <td> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<!--{{$alumnos->links()}}-->
{{ $alumnos->links('vendor.pagination.custom') }}
</div>



</body>


</html>
