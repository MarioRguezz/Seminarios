@extends('principal')


@section('content')
  <?php $var = 0; ?>
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
            <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-24.png')}}" height="40" width="40">
          <span class="greenTitle">DASHBOARD CLIENTE ADMINISTRADOR</span>
        </div>
      </div>
    </div>
  <!--    <div class=" col-md-12 well back" id="menu">
        <div class="row">
            <div class="col-md-12"> -->
            <div class="form-group">
                              <form action="{{url('/reportes/generarClienteadministrador')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <button  class=" NoRadiusColorButton buttonDownload" title="Descarga en xls" id="registro" type="submit">Reporte</button>
                                  <input id="cve_usuario" name="cve_usuario" type="hidden" value="{{$cve_usuario}}"> </input>
                                  <div style="clear:both;"> </div>
                              </form>
           </div>
              <table class="tableSize"  align="center">
   <thead>
     <tr class="pinkbackground">
       <th class="weight borderpillbegin">Tipo de Usuario</th>
       <th class="weight">Nombre</th>
       <th class="weight">Apellido Paterno</th>
       <th class="weight">Apellido Materno</th>
       <th class="weight borderpillend">Email</th>
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
     @foreach ($clientesAdministradores as $clienteAdministrador)
     <?php $var=0; ?>
     <tr class="greenbackground">
       <td class="borderpillbegin">Instructores</td>
       <td> </td>
       <td> </td>
       <td></td>
       <td class="borderpillend"> </td>
     </tr>
     <tr class="separateRow">
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
    </tr>
     @foreach ($clienteAdministrador->instructores as $instructor)
     <tr class="graybackground">
       <td class="borderpillbegin"></td>
       <td> {{ $instructor->datos['Nombre'] }}</td>
       <td> {{ $instructor->datos['APaterno'] }}</td>
       <td>{{ $instructor->datos['AMaterno'] }} </td>
       <td class="borderpillend">{{ $instructor->datos['email'] }} </td>
     </tr>
     <tr class="separateRow">
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
    </tr>
       @endforeach

       @foreach ($clienteAdministrador->alumnos as $alumno)

        @if ( $var == 0)
          <tr class="greenbackground">
             <td class="borderpillbegin">Alumnos</td>
             <td> </td>
             <td> </td>
             <td></td>
             <td class="borderpillend"> </td>
           </tr>
           <tr class="separateRow">
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
          </tr>
       @endif
               <tr class="graybackground">
                 <td class="borderpillbegin"></td>
                 <td> {{ $alumno->datos['Nombre'] }}</td>
                 <td> {{ $alumno->datos['APaterno'] }}</td>
                 <td>{{ $alumno->datos['AMaterno'] }} </td>
                 <td class="borderpillend">{{ $alumno->datos['email'] }} </td>
               </tr>
               <tr class="separateRow">
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
              </tr>

                 <?php $var++ ?>
                 @endforeach
      @endforeach
   </tbody>
 </table>
 {{ $clientesAdministradores->links('vendor.pagination.custom') }}
   <!--{{$clientesAdministradores->links()}}
        </div>
    </div>
</div>-->
@endsection
