<!DOCTYPE html>
<html lang="es">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <script src="../../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../../js/bootstrap/css/bootstrap.min.css">
    <script src="../../js/bootstrap/js/bootstrap.min.js"></script>


    <script src="../js/pregunta.js"></script>
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/radio.css">
    <link rel="stylesheet" href="../../css/Principal.css">


    <style>
        html {
            height: 100%;
        }

       .weight{
          font-weight: bold !important;
        }
    </style>
</head>
<body class="backgroundPrincipal">
  @include('header')
  <?php $var = 0; ?>
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/17.png')}}" height="27" width="27">
          <span class="purpleTitle">DASHBOARD CURSOS</span>
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
              <table class="table designTable"  align="center">
   <thead>
     <tr>
       <th style="font-weight:bold;" class="weight">Tipo de Usuario</th>
       <th class="weight">Nombre</th>
       <th class="weight">Apellido Paterno</th>
       <th class="weight">Apellido Materno</th>
       <th class="weight">Email</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($clientesAdministradores as $clienteAdministrador)
     <?php $var=0; ?>
     <tr>
       <td>Instructores</td>
       <td> </td>
       <td> </td>
       <td></td>
       <td> </td>
     </tr>
     @foreach ($clienteAdministrador->instructores as $instructor)
     <tr>
       <td></td>
       <td> {{ $instructor->datos['Nombre'] }}</td>
       <td> {{ $instructor->datos['APaterno'] }}</td>
       <td>{{ $instructor->datos['AMaterno'] }} </td>
       <td>{{ $instructor->datos['email'] }} </td>
     </tr>
       @endforeach

       @foreach ($clienteAdministrador->alumnos as $alumno)

        @if ( $var == 0)
          <tr>
             <td>Alumnos</td>
             <td> </td>
             <td> </td>
             <td></td>
             <td> </td>
           </tr>
       @endif
               <tr>
                 <td></td>
                 <td> {{ $alumno->datos['Nombre'] }}</td>
                 <td> {{ $alumno->datos['APaterno'] }}</td>
                 <td>{{ $alumno->datos['AMaterno'] }} </td>
                 <td>{{ $alumno->datos['email'] }} </td>
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
</body>

</html>
