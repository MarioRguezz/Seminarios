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
    <h3 class="cssTitleRegistro">EDITAR INSTRUCTOR</h3>
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

    <form action="{{url('/usuario/editarinstructorregistro')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="control-label col-md-3 whiteClass">Nombre</label>
            <div class="col-md-6">
              <input  id="idPersona" name="idPersona" type="hidden" value="{{$instructor->IdPersona}}" required>
              <input  id="idCA" name="idCA" type="hidden" value="{{$cve_ca}}" required>
                <input class="form-control NoRadius" id="nombre" name="nombre" type="text" placeholder="" value="{{$instructor->Nombre}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="apaterno" class="control-label col-md-3 whiteClass">Apellido Paterno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="apaterno"  name="apaterno" type="text" placeholder="" value="{{$instructor->APaterno}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="amaterno" class="control-label col-md-3 whiteClass">Apellido Materno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="amaterno" name="amaterno" type="text" placeholder="" value="{{$instructor->AMaterno}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-md-3 whiteClass">Contraseña</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="password" name="password" type="password" placeholder="">
            </div>
        </div>
        @if ($instructor->Status === "ALTA")
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 whiteClass">Estatus</label>
            <div class="col-md-6">
                <select class="form-control NoRadius" name="estatus" id="estatus">
                    <option selected value="ALTA">ALTA</option>
                    <option value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 whiteClass">Sexo</label>
            <div class="col-md-6">
                <select class="form-control NoRadius" name="estatus" id="estatus">
                    <option value="ALTA">ALTA</option>
                    <option selected value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
         @endif

        <div class="form-group">
            <div class="col-md-2 col-md-offset-4 ">
                <button class="buttonTransparentBorder buttonAlta" id="registro" type="submit">Guardar registro</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
