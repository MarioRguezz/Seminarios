<div style="position:absolute; background: #FFF; top: 0px; left:0px; right:0px; padding:20px; margin:0px" class="col-sm-12 row">
  <div class="col-sm-4" >
    <img src="{{url('/img/Icons/nuevosiconos/BEYOND2-56.png')}}" width="200" height="45">
  </div>
    @if(Auth::user() != null)
      <div class="col-sm-4 down" >
    <!--  	<a class="menuOption NoShadow " href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/Seminarios/public/">PÁGINA PRINCIPAL</a>-->
      </div>
      <div class="dropdown  col-sm-4">
    <button class="btn btn-default dropdown-toggle" style="border:none !important; color:#009999 !important;" type="button" id="menu1" data-toggle="dropdown"><?php echo Auth::user()->Nombre. " ".Auth::user()->APaterno;?>
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation">  <a style="color:#009999 !important" class="menuOption  col-sm-12 " href="http://<?php echo $_SERVER['SERVER_NAME']?>/Seminarios/public/logout">  CERRAR SESIÓN</a></li>
    </ul>
  </div>
</div>
    @endif
</div>
