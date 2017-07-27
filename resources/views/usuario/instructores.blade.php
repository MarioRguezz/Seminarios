@extends('principal')

@section('titulo')
    Lista de instructores
@endsection
        
@section('head')
    <script src="{{url('/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/inicio.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/login.css')}}">
    <script src="{{url('/js/efectos.js')}}"></script>
    <script src="{{url('/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/dist/sweetalert.css')}}">

    <script src="{{url('/js/personaJS.js')}}"></script>
@endsection


@section('content')
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/18.png')}}" height="27" width="27">
          <span class="purpleTitle">LISTA DE INSTRUCTORES</span>
        </div>
      </div>
    </div>


<!-- <div class="col-xs-6"> -->

<div class="container "> <!-- Div principal -->

    <table class="table designTable"  align="center">
        <thead>
            <tr>
                <th class="weight">Nombre</th>
                <th class="weight">Email</th>
                <th class="weight">Estatus</th>
                <th class="weight"></th>
                <th><a class="azul" href="{{url('/usuario/instructornuevo/'.$administradores->id.'/'.$administradores->id_persona)}}">+</a></th>
            </tr>
        </thead>

        <tbody>

            @foreach($instructores as $administrador)
                <tr>
                <td>{{$administrador->datos['Nombre']}}</td>
                <td>{{$administrador->datos['email']}}</td>
                <td>{{$administrador->datos['Status']}}</td>
                <td><a href="{{url('/usuario/instructoresedicion/'.$administrador->datos['IdPersona'].'/'.$administradores->id_persona)}}"><span class="glyphicon glyphicon-pencil verde"></span></a></td>
                <td> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<!--{{$instructores->links()}}-->
{{ $instructores->links('vendor.pagination.custom') }}
</div>

@endsection
