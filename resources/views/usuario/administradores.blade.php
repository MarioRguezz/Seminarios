<?PHP
?>
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro</title>

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

<center>
    <h3 class="cssTitleRegistro">LISTA DE ADMINISTRADORES</h3>
</center>
<br><br><br>


<!-- <div class="col-xs-6"> -->

<div class="container "> <!-- Div principal -->

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de expiración</th>
                <th>Número de licencias</th>
                <th>Licencias restantes</th>
                <th></th>
                <th><a class="blanco" href="{{url('/usuario/editar')}}">+</a></th>
            </tr>
        </thead>

        <tbody>

            @foreach($administradores as $administrador)
                <tr>
                <td></td>
                <td>{{$administrador->datos->Nombre}}</td>
                <td>{{$administrador->datos->email}}</td>
                <td>{{$administrador->fecha_expiracion}}</td>
                <td>{{$administrador->no_licencias}}</td>
                <td>{{$administrador->restante }}</td>
                <td><a href="{{url('/usuario/editar/'.$administrador->id_persona)}}"><span class="glyphicon glyphicon-pencil blanco"></span></a></td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>



</body>


</html>
