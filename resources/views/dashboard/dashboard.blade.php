@extends('principal')

@section('titulo')
  Dashboard Licencias
@endsection

@section('head')
    <script src="../js/efectos.js"></script>
    <script src="../js/examen/model/examen.js"></script>
    <script src="../js/examen/model/pregunta.js"></script>
    <script src="../js/examen/model/choice.js"></script>
    <script src="../js/examen/model/item.js"></script>
    <script src="../js/examen/model/casilla.js"></script>
    <script src="../js/examen/app.js"> </script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
@endsection

@section('content')

  <?php $var = 0; ?>
  <div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
      <div    class="titleContainer">
          <div class="titleImg">
            <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-03.png')}}" height="40" width="40">
            <span class="pinkTitle">DASHBOARD LICENCIAS</span>
          </div>
        </div>
      </div>
  <!--  <div class=" col-md-12 well back" id="menu">
        <div class="row">
            <div class="col-md-12">-->
            <div class="form-group">
                              <form action="{{url('/reportes/generarLicencias')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <button  class=" NoRadiusColorButton buttonDownload" title="Descarga en xls" id="registro" type="submit">Reporte</button>
                                  <div style="clear:both;"> </div>
                              </form>
           </div>
              <table class="tableSize"  align="center">
   <thead>
     <tr class="pinkbackground">
       <th class="weight borderpillbegin">Tipo de Usuario</th>
       <th class="weight">Nombre</th>
       <th class="weight">Apellidos</th>
       <th class="weight">Email</th>
       <th class="weight">Fecha vigencia</th>
       <th class="weight borderpillend">No. de licencias</th>
     </tr>
     <tr class="separateRow">
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
    </tr>
   </thead>
   <tbody>
     <tr class="graybackground">
       <td class="borderpillbegin">Cliente Administrador </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td class="borderpillend"> </td>
     </tr>
     <tr class="separateRow">
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
    </tr>
     @foreach ($clientesAdministradores as $clienteAdministrador)
     <tr class="graybackground">
       <td class="borderpillbegin"> </td>
       <td>{{ $clienteAdministrador->datos->Nombre }} </td>
       <td>{{ $clienteAdministrador->datos->APaterno }} {{ $clienteAdministrador->datos->AMaterno }} </td>
       <td>{{ $clienteAdministrador->datos->email }} </td>
       <td> {{ $clienteAdministrador->fecha_expiracion }}</td>
       <td class="borderpillend"> {{ $clienteAdministrador->no_licencias }}</td>
     </tr>
     <tr class="separateRow">
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
  <!-- {{$clientesAdministradores->links()}}-->
    {{ $clientesAdministradores->links('vendor.pagination.custom') }}
    <!--    </div>
    </div>
</div>-->
@endsection