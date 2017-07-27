@extends('principal')

@section('titulo')
    Lista de administradores
@endsection

@section('head')
    <script src="{{url('/js/passwordval.js')}}"></script>
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
            <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-18.png')}}" height="40" width="40">
            <span class="blueTitle">LISTA DE ADMINISTRADORES</span>
          </div>
        </div>
      </div>


<!-- <div class="col-xs-6"> -->
<!--container-->
<div class=" "> <!-- Div principal -->

    <table class="tableSize"  align="center">
        <thead>
            <tr class="pinkbackground">
                <th class="borderpillbegin"></th>
                <th class="weight">Nombre</th>
                <th class="weight">Email</th>
                <th class="weight">Fecha de expiración</th>
                <th class="weight">Número de licencias</th>
                <th class="weight">Licencias restantes</th>
                <th></th>
                <th class="weight borderpillend"><a style="color:white;" href="{{url('/usuario/editar')}}">+</a></th>
            </tr>
            <tr class="separateRow">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
           </tr>
        </thead>

        <tbody>

            @foreach($administradores as $administrador)
                <tr class="graybackground">
                <td class="borderpillbegin"></td>
                <td>{{$administrador->datos->Nombre}}</td>
                <td>{{$administrador->datos->email}}</td>
                <td>{{$administrador->fecha_expiracion}}</td>
                <td>{{$administrador->no_licencias}}</td>
                <td>{{$administrador->restante }}</td>
                <td><a href="{{url('/usuario/editar/'.$administrador->id_persona)}}"><span  style="color:white;" class="glyphicon glyphicon-pencil"></span></a></td>
                <td class="borderpillend"></td>
                </tr>
                <tr class="separateRow">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
               </tr>
            @endforeach
        </tbody>
    </table>
  <!--  {{$administradores->links()}}-->
   {{ $administradores->links('vendor.pagination.custom') }}
</div>

@endsection
