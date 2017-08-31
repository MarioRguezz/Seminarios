<?php $idPersona = Auth::user()->IdPersona ?>

@if(Auth::user()->TUser == "Alumno")
<div class="row" style="height:100%;" >
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>ALUMNO</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="{{url('/alumno')}}">
        <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-42.png')}}">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/pages/CursosDisponibles.php')}}" target="_self">
          <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-43.png')}}"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>

     </div>
</div>
<div class="col-md-9">

    @yield('content')
</div>
</div>

  @endif
@if(Auth::user()->TUser == "AdminCliente")
<div class="row" style="height:auto;" >
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>CLIENTE ADMINISTRADOR</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="{{url('/dashboard/clientedashboard/'.$idPersona)}}">
        <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-04.png')}}">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/usuario/instructores/'.$idPersona)}}" target="_self">
          <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-21.png')}}"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/usuario/alumnos/'.$idPersona)}}" target="_self">
         <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-22.png')}}">
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div>
       </a></div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/csv/SubirCSV')}}" target="_self">
          <div class="col-xs-10">
         <img src="{{url('/img/byondiconos/BEYOND2-23.png')}}">
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div>
       </a> </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/dashboard/cursosca')}}" target="_self">
          <div class="col-xs-10">
         <img src="{{url('/img/byondiconos/BEYOND2-02.png')}}">
         </div>
         <div class="col-xs-1" style="height:125px; margin-bottom: 25px; border-right: 2px solid white;  border-radius: 1px;"> </div>
       </a>
           </div>
     </div>
</div>
<div class="col-md-9">
  @yield('content')
</div>
</div>
@endif

@if(Auth::user()->TUser == "Instructor")
<div class="row" style="height:100%;" >
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:90%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>INSTRUCTOR</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="{{url('/pages/MisCursosInstructor.php')}}">
        <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-31.png')}}">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/pages/AltaCurso.php')}}"  target="_self">
          <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-32.png')}}"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>

     </div>
</div>
<div class="col-md-9">

    @yield('content')
</div>
</div>

@endif


@if(Auth::user()->TUser == "Administrador")
<div class="row" style="height:100%;" >
<div class="col-xs-3" style="background-color:#2F302E; height:120%; position:fixed;   width:300px; padding-top:100px; z-index:10 !important;"></div>
<div class="col-xs-3" style="height:100%;   width:300px; padding-top:100px; z-index:10 !important;">
  <div style="height:100%; position:absolute;  margin-top:25px; !important; padding-right:0px !important; border-left: 1px solid white;">
  </div>
    <div class="col-xs-10 col-xs-offset-1">
      <div class="row" style="margin-bottom:10px; ">
          <h2 style="color:#FFF; font-size: 1.5em;">OPCIONES <br> PARA EL <br>ADMINISTRADOR</h1>
      </div>
      <div class="row" style="margin-bottom:10px;">
        <a href="{{url('/dashboard/index')}}" >
        <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-02.png')}}">
        </div>
        <div class="col-xs-1" style="height:125px; border-right: 2px solid white; border-radius: 1px;"> </div></a>
       </div>
      <div class="row"  style="margin-bottom:10px;">
        <a href="{{url('/dashboard/dashboard')}}"   target="_self">
          <div class="col-xs-10">
            <img src="{{url('/img/byondiconos/BEYOND2-09.png')}}"  >
         </div>
         <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
       </div>
       <div class="row"  style="margin-bottom:10px;">
         <a href="{{url('/dashboard/administrador')}}"  target="_self">
           <div class="col-xs-10">
             <img src="{{url('/img/byondiconos/BEYOND2-10.png')}}"  >
          </div>
          <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
        </div>
        <div class="row"  style="margin-bottom:10px;">
          <a href="{{url('/usuario/administradores')}}"  target="_self">
            <div class="col-xs-10">
              <img src="{{url('/img/byondiconos/BEYOND2-12.png')}}"  >
           </div>
           <div class="col-xs-1" style="height:125px; border-right: 2px solid white;  border-radius: 1px;"> </div></a>
         </div>

     </div>
</div>
<div class="col-md-9">

    @yield('content')
</div>
</div>

@endif
