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
  <?php $var = 0; ?>
<div style="margin-top:5%" class="container-fluid">
    <div class="form-horizontal ">
        <div class="text-center">
            <label class="control-label" id="VP"><h3 class="whiteClass2 top">DASHBOARD LICENCIAS</h3></label>
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
       <th class="weight">Apellidos</th>
       <th class="weight">Email</th>
       <th class="weight">Fecha vigencia</th>
       <th class="weight">No. de licencias</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td>Cliente Administrador </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
     </tr>
     @foreach ($clientesAdministradores as $clienteAdministrador)
     <tr>
       <td> </td>
       <td>{{ $clienteAdministrador->datos->Nombre }} </td>
       <td>{{ $clienteAdministrador->datos->APaterno }} {{ $clienteAdministrador->datos->AMaterno }} </td>
       <td>{{ $clienteAdministrador->datos->email }} </td>
       <td> {{ $clienteAdministrador->fecha_expiracion }}</td>
       <td> {{ $clienteAdministrador->no_licencias }}</td>
     </tr>
      @endforeach
   </tbody>
 </table>
   {{$clientesAdministradores->links()}}
        </div>
    </div>
</div>
</body>

</html>
