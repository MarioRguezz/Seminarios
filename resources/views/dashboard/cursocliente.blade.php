<!DOCTYPE html>
<html lang="es">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>


    <script src="../js/pregunta.js"></script>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/radio.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/efectos.js"></script>
    <script src="../js/examen/model/examen.js"></script>
    <script src="../js/examen/model/pregunta.js"></script>
    <script src="../js/examen/model/choice.js"></script>
    <script src="../js/examen/model/item.js"></script>
    <script src="../js/examen/model/casilla.js"></script>
    <script src="../js/examen/app.js"> </script>

    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/Icons/nuevosiconos/13.png')}}" height="27" width="27">
          <span class="purpleTitle">DASHBOARD CURSOS</span>
        </div>
      </div>
    </div>
  <!--<div class=" col-md-12 well back" id="menu">
        <div class="row">
            <div class="col-md-12">-->
            <div class="form-group">
                              <form action="{{url('/reportes/generaCursoCA')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <button  class=" NoRadiusColorButton buttonDownload" title="Descarga en xls" id="registro" type="submit">Reporte</button>
                                  <div style="clear:both;"> </div>
                              </form>
           </div>
              <table class="table designTable"  align="center">
   <thead>
     <tr>
       <th style="font-weight:bold;" class="weight">Curso </th>
       <th class="weight">Nombre</th>
       <th class="weight">Apellido Paterno</th>
       <th class="weight">Apellido Materno</th>
       <th class="weight">Email</th>
       <th class="weight">Progreso</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($cursos as $curso)
     <tr>
       <td>{{ $curso->nombre }} </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
     </tr>
      @foreach ($curso->alumnos as $alumno)
      <tr>
        <td></td>
        <td> {{ $alumno->datos['Nombre'] }}</td>
        <td> {{ $alumno->datos['APaterno'] }}</td>
        <td>{{ $alumno->datos['AMaterno'] }} </td>
        <td>{{ $alumno->datos['email'] }} </td>
        <td> {{ $alumno->porcentaje }}% </td>
      </tr>
        @endforeach
      @endforeach
   </tbody>
 </table>
  <!-- {{$cursos->links()}}-->
   {{ $cursos->links('vendor.pagination.custom') }}
      <!--  </div>
    </div>
</div>-->
</body>

</html>
