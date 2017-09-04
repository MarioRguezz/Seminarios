@extends('principal')

@section('titulo')
    Mis cursos
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
            <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-18.png')}}" height="40" width="40">
            <span class="blueTitle">MIS CURSOS</span>
          </div>
        </div>
      </div>


<div class="container" >
	<table class="tableSize" align="center">
    <thead>
    <tr class="pinkbackground">
    	<th class="weight borderpillbegin" style="border:none !important"><center>Nombre del curso</center></th>
        <th class="weight " style="border:none !important"><center>Instructor</center></th>
        <th class="weight" style="border:none !important"><center>Progreso</center></th>
        <th class="weight" style="border:none !important"><center>Calificación</center></th>
        <th class="weight borderpillend" style="border:none !important"><center></center></th>
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
    @foreach($alumno->cursos as $curso)
    <tr>
          
    	<td  class="borderpillbegin graybackground"><center> {{$curso->nombre}} </center></td>
        
        <td class="graybackground"><center> {{$curso->instructor[0]->datos->Nombre}} </center></td>

        <td class="graybackground">
        <?php 
            $progress = $alumno->avanceCurso($curso->id_Curso);
        ?>
        <!-- <center> <?PHP //echo htmlentities($Total." / ".$row['per_num']); ?> </center>-->

        <div class="progress">
        		@if($progress == 0)
                  <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                    0%
                  </div>

               	
				@elseif($progress <= 20)
				  <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%">
                    {{$progress}}%
                  </div>
            	@elseif($progress <= 50)
			      <div class="progress-bar progress-bar-warning " role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%">
                    {{$progress}}%
                  </div>
				@elseif($progress <= 70)
				 <div class="progress-bar progress-bar-info " role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%">
                    {{$progress}}%
                  </div>
                @else
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%">
                    {{$progress}}%
                 </div>
                @endif

        </div>

        </td> 
		<td class=" graybackground" >
			<center>{{$alumno->calificacionCurso($curso->id_Curso)}}</center>
		</td>
<td class="borderpillend graybackground" >
       
        <form action="pages/CursoTemaAlumno.php" class="form-horizontal" method="get" enctype="multipart/form-data">   
        <input type="hidden" value="{{$curso->id_Curso}}" name="IDCurso">
        <input type="hidden" value="{{$alumno->Mat_Alumno}}" name="Mat_Alumno">
        <center> <button class="NoRadiusColorButtonCircle" id="btn-Ir" type="submit">Ir al curso &nbsp; <span class="glyphicon glyphicon-log-in"></span></button> </center>
        </form>
		</td>
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

</div><!-- Fin del div principal -->
@endsection
