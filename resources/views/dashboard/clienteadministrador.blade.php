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
  <div class="Menu">
      <div class="col-md-4" >
          <a class="SubtitlewhiteClass NoShadow WithTop" href="{{url('/')}}">Menú principal</a>
      </div>
      <div class="col-md-offset-4 col-md-4 ">
          <a class="SubtitlewhiteClass NoShadow WithTop" href="{{url('/logout')}}">Cerrar sesión</a>
      </div>
  </div>
  <?php $var = 0; ?>
<div  style="margin-top:5%" class="container-fluid">
    <div class="form-horizontal ">
        <div class="text-center">
            <label class="control-label" id="VP"><h3 class="whiteClass2 top">DASHBOARD CLIENTE ADMINISTRADOR</h3></label>
        </div>
    </div>
    <div class=" col-md-12 well back" id="menu">
        <div class="row">
            <div class="col-md-12">
              <table class="table">
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
        </div>
    </div>
</div>
</body>

</html>
