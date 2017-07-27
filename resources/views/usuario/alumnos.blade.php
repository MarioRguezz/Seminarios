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
          <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-27.png')}}" height="40" width="40">
          <span class="yellowTitle">LISTA DE ALUMNOS</span>
        </div>
      </div>
    </div>


<!-- <div class="col-xs-6"> -->

<div class="container "> <!-- Div principal -->

    <table class="tableSize"  align="center">
        <thead>
            <tr class="pinkbackground">
                <th class="weight borderpillbegin">Nombre</th>
                <th class="weight ">Email</th>
                <th class="weight ">Estatus</th>
                <th class="weight "></th>
                <th class="weight borderpillend"><a class="" style="color:#FFF;" href="{{url('/usuario/alumnonuevo/'.$administradores->id.'/'.$administradores->id_persona)}}">+</a></th>
            </tr>
            <tr class="separateRow">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
           </tr>
        </thead>

        <tbody>

            @foreach($alumnos as $administrador)
                <tr class="graybackground">
                <td class=" borderpillbegin" >{{$administrador->datos['Nombre']}}</td>
                <td>{{$administrador->datos['email']}}</td>
                <td>{{$administrador->datos['Status']}}</td>
                <td><a href="{{url('/usuario/alumnosedicion/'.$administrador->datos['IdPersona'].'/'.$administradores->id_persona)}}"><span style="color:#FFF;"  class="glyphicon glyphicon-pencil "></span></a></td>
                <td class=" borderpillend"> </td>
                </tr>
                <tr class="separateRow">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
               </tr>
            @endforeach
        </tbody>
    </table>
<!--{{$alumnos->links()}}-->
{{ $alumnos->links('vendor.pagination.custom') }}
</div>



</body>


</html>
