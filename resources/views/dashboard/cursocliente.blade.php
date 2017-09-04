@extends('principal')
@section('titulo')
  Dashboard Cursos
@endsection

@section('head')
    <script src="../js/pregunta.js"></script>
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
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
    <div    class="titleContainer">
        <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-15.png')}}" height="40" width="40">
          <span class="greenTitle">DASHBOARD CURSOS</span>
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
              <table class="tableSize"  align="center">
   <thead>
     <tr class="pinkbackground">
       <th  class="weight borderpillbegin">Curso </th>
       <th class="weight">Nombre</th>
       <th class="weight">Apellido Paterno</th>
       <th class="weight">Apellido Materno</th>
       <th class="weight">Email</th>
       <th>Progreso</th>
       <th class="weight borderpillend">Calificación</th>
     </tr>
     <tr class="separateRow">
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
     @foreach ($cursos as $curso)
     <tr class="greenbackground">
       <td   class="borderpillbegin">{{ $curso->nombre }} </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td  class="borderpillend"> </td>
     </tr>
     <tr class="separateRow">
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
    </tr>
      @foreach ($curso->alumnos as $alumno)
      <tr class="graybackground">
        <td class="borderpillbegin"></td>
        <td> {{ $alumno->datos['Nombre'] }}</td>
        <td> {{ $alumno->datos['APaterno'] }}</td>
        <td>{{ $alumno->datos['AMaterno'] }} </td>
        <td>{{ $alumno->datos['email'] }} </td>
        <td> {{ $alumno->porcentaje }}% </td>
        <td class="borderpillend"> {{ $alumno->calificacionCurso($curso->id_Curso) }}% </td>
      </tr>
      <tr class="separateRow">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
     </tr>
        @endforeach
      @endforeach
   </tbody>
 </table>
      <!--  </div>
    </div>
</div>-->
{{ $cursos->links('vendor.pagination.custom') }}
@endsection
