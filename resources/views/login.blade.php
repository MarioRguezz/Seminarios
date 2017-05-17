
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Durango</title>
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

<div class="col-xs-10 col-xs-offset-2">
    <div class="row">
     <img src="img/Icons/logo.png" width="200px" height="125px" />
    </div>
    <div class="row">
        <h1 class="whiteClass2 col-xs-12 col-md-4">SEMINARIO</h1><br>
    </div>
    <div class="row">
        <h3 class="SubtitlewhiteClass col-xs-12 col-md-5">Bienvenido, ingrese usuario y password para entrar</h3>
    </div>
    <div class="row">
        <!--Login-->
        <form id="login-form" action="{{url('/login')}}" method="post" class="col-xs-12 col-md-4 " role="form">
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


                <input type="text" name="user" id="username" tabindex="1" class="form-control NoRadius" placeholder="Nombre de usuario" value="" required>
            </div>
            <div class="form-group ">
                <input type="password" name="pass" id="password" tabindex="2" class="form-control NoRadius " placeholder="Password" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control buttonLogin" value="COMENZAR">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-4">
        <a class="form-control buttonLogin alignCenter col-md-4" href="{{url('/password/reset')}}">¿Olvido su contraseña?</a>
        </div>
    </div>
    <div class="row">
        <h4 class="whiteClass thinWord NormalSizeWord col-xs-12 col-md-4"> ¿No estas registrado? Clic aquí para registrarse.</h4> <br>
    </div>
    <div class="row">
        <div class="col-md-4">
        <a class="form-control buttonLogin alignCenter col-md-4" href="{{url('/usuario/registro')}}">REGISTRO</a>
        </div>
    </div>
</div>

<br><br><br>


</body>
</html>
