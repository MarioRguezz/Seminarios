<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Principal</title>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/passwordval.js"></script>

<link rel="stylesheet" href="../../js/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/Main.css">
<link href="../../css/radiocss.css" rel="stylesheet" />

<script src="../../js/bootstrap/js/bootstrap.min.js"></script>
<script src="../../js/inicio.js"></script>
<link rel="stylesheet" href="../../css/login.css">
<script src="../../js/efectos.js"></script>
<script>
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script src="../../js/spinner.js"></script>

<script src="../../js/autcomp.js"></script>

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/start/jquery-ui.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<style>
html{
    height: 100%;
}
</style>
</head>

<body class="backgroundPrincipal">
<input type="hidden" id="_url" value="{{url('/')}}">
<!--	FIN	Menu en el Encabezado	-->


@include('header')

<!--	FIN	Menu en el Encabezado	-->

<!--<div class="contenedor2"> -->
<div class="contenedorMain">



  <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
      {{ csrf_field() }}

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">Email</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control NoRadiusColor" name="email" value="{{ $email or old('email') }}" required autofocus>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Contraseña</label>

          <div class="col-md-6">
              <input id="password" type="password" class="form-control NoRadiusColor" name="password" required>

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>
          <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control NoRadiusColor" name="password_confirmation" required>

              @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary NoRadiusColorButton">
                  Reestablecer contraseña
              </button>
          </div>
      </div>
  </form>



</div> <!-- Fin del div principal -->

<br><br><br><br>
<br><br>
</body>

</html>
