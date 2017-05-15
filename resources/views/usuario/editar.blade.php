<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar</title>

    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/passwordval.js')}}"></script>
    <script src="{{url('/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/js/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/Main.css')}}">
    <link href="{{url('/css/radiocss.css" rel="stylesheet')}}" />
    <link rel="stylesheet" href="{{url('/css/login.css')}}">

</head>

<body class="registro">

<center>
    <h3 class="cssTitleRegistro">EDITAR USUARIO CLAVE ADMINISTRADOR</h3>
</center>
<br><br><br>
<div class="container "> <!-- Div principal -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{url('/usuario/editarregistro')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="control-label col-md-3 whiteClass">Nombre</label>
            <div class="col-md-6">
              <input  id="idPersona" name="idPersona" type="hidden" value="{{$usuario->IdPersona}}" required>
                <input class="form-control NoRadius" id="nombre" name="nombre" type="text" placeholder="" value="{{$usuario->Nombre}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="apaterno" class="control-label col-md-3 whiteClass">Apellido Paterno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="apaterno"  name="apaterno" type="text" placeholder="" value="{{$usuario->APaterno}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="amaterno" class="control-label col-md-3 whiteClass">Apellido Materno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="amaterno" name="amaterno" type="text" placeholder="" value="{{$usuario->AMaterno}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-md-3 whiteClass">Contraseña</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="password" name="password" type="password" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="telcasa" class="control-label col-md-3 whiteClass">Fecha de Expiración</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" maxlength="15" id="telcasa" name="telcasa" type="date" value="{{$administrador->fecha_expiracion}}" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="celular" class="control-label col-md-3 whiteClass">Limite de licencias</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" maxlength="20" id="celular" name="celular" type="number"  value="{{$administrador->no_licencias}}" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-offset-4 ">
                <button class="buttonTransparentBorder buttonAlta" id="registro" type="submit">Guardar registro</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
