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
@include('header')
<div style="margin-top:8%; margin-bottom: 2%;" class="container-fluid">
<div    class="titleContainer">
    <div class="titleImg">
      <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-27.png')}}" height="40" width="40">
      <span class=" yellowTitle">EDITAR ALUMNO</span>
    </div>
  </div>
</div>
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

    <form action="{{url('/usuario/editaralumnoregistro')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="control-label col-md-3 whiteClass verde normal">Nombre</label>
            <div class="col-md-6">
              <input  id="idPersona" name="idPersona" type="hidden" value="{{$alumno->IdPersona}}" required>
              <input  id="idCA" name="idCA" type="hidden" value="{{$cve_ca}}" required>
                <input class="form-control NoRadiusColor" id="nombre" name="nombre" type="text" placeholder="" value="{{$alumno->Nombre}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="apaterno" class="control-label col-md-3 whiteClass verde normal">Apellido Paterno</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusColor" id="apaterno"  name="apaterno" type="text" placeholder="" value="{{$alumno->APaterno}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="amaterno" class="control-label col-md-3 whiteClass verde normal">Apellido Materno</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusColor" id="amaterno" name="amaterno" type="text" placeholder="" value="{{$alumno->AMaterno}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-md-3 whiteClass verde normal">Contraseña</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusColor" id="password" name="password" type="password" placeholder="">
            </div>
        </div>
        @if ($alumno->Status === "ALTA")
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 whiteClass verde normal">Estatus</label>
            <div class="col-md-6">
                <select class="form-control NoRadiusColor" name="estatus" id="estatus">
                    <option selected value="ALTA">ALTA</option>
                    <option value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 whiteClass verde normal">Sexo</label>
            <div class="col-md-6">
                <select class="form-control NoRadiusColor" name="estatus" id="estatus">
                    <option value="ALTA">ALTA</option>
                    <option selected value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
         @endif

        <div class="form-group">
            <div class="col-md-2 col-md-offset-4 ">
                <button class=" NoRadiusColorButton" id="registro" style="width:300px;" type="submit">Guardar registro</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
