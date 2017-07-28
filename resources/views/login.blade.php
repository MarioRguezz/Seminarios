
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Byond</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/passwordval.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Main.css">
    <link href="css/radiocss.css" rel="stylesheet" />

    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/inicio.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/efectos.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>

<body class="backgroundLogin">

<div  class="col-md-12" style="background-color:#2F302E; margin-top:22%; height:280px;">
  <div class="row">
    <div class="col-md-1" >
    </div>
    <div class="col-md-3" style=" height:280px; margin-right:20px;">
     <img src="img/Icons/logo.png" class="logologin" height="150px" />
   </div>
    <div class="col-md-2" style=" height:280px; margin-right:20px;">
      <div class="row">
          <!--Login-->
          <div class="row">
              <h1 class="titleLogin col-xs-12 col-md-12">SEMINARIO</h1><br>
              <h3 class="Subtitlelogin col-xs-12 col-md-12" style="margin-top:-10px; margin-bottom:20px;">Bienvenido,ingrese usuario y password para entrar</h3>

          <form id="login-form" action="{{url('/login')}}" method="post" class="col-xs-12 col-md-12 " role="form">
              <div class="form-group">
                  @if($res==0)
                      <div class="alert alert-danger" align="center">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <label class="btn-large ">Usuario o constraseña incorrectos</label>
                      </div>
                  @endif

                  @if($res==1)
                      <div class="alert alert-danger" align="center">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <label class="btn-large ">El usuario no ha sido dado de alta por el administrador.</label>
                      </div>
                  @endif
                  @if($res==2)
                      <div class="alert alert-danger" align="center">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <label class="btn-large ">Su licencia ha caducado, contacte al administrador.</label>
                      </div>
                  @endif


                  <input type="text" name="user" id="username" tabindex="1" class="form-control NoRadiusColorlogin" placeholder="Nombre de usuario" value="" required>
              </div>
              <div class="form-group ">
                  <input type="password" name="pass" id="password" tabindex="2"  class="form-control NoRadiusColorlogin " placeholder="Password" required>
              </div>
      </div>
        </div>
    </div>



    <div class="col-md-2" style=" height:280px;">
      <div class="form-group">
        <div class="row containerregister" >
          <div class="row">
            <h4 class="whiteClass  NormalSizeWord col-xs-12 col-md-12"> ¿No estas registrado? Clic aquí para registrarse.</h4>
          </div>
            <div class="row">
            <a  target="_blank" class="form-control buttonLoginRegistro alignCenter " href="{{url('/usuario/registro')}}">REGISTRO</a>
          </div>
        </div>
        <!--  <div class="row">
              <div class="col-xs-12">
                  <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control buttonLogin" value="COMENZAR">
              </div>
          </div>-->
      </div>
      <div class="row">
          <div class="col-md-12">
          <a target="_blank" class="form-control buttonForget alignCenter" href="{{url('/password/reset')}}">¿Olvido su contraseña?</a>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <input type="submit" name="login-submit" id="login-submit" tabindex="4"  class="form-control buttonLoginComenzar" value="COMENZAR">
          </div>
      </div>
    </div>
  </form>
    <div class="col-md-3" >
    </div>


  </div>

</div>

</body>
</html>
