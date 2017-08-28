<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Instructor</title>

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
<button class="NoRadiusColorButtonPill" onclick="window.history.back();"><center> &nbsp; ⬅ &nbsp; </center> </button>
  <div    class="titleContainer">
      <div class="titleImg">
          <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-26.png')}}" height="40" width="40">
        <span class="pinkTitle">EDITAR INSTRUCTOR</span>
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

    <form action="{{url('/usuario/editarinstructorregistro')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre" class="control-label col-md-3 ClassThin gray normal">Nombre</label>
            <div class="col-md-6">
              <input  id="idPersona" name="idPersona" type="hidden" value="{{$instructor->IdPersona}}" required>
              <input  id="idCA" name="idCA" type="hidden" value="{{$cve_ca}}" required>
                <input class="form-control NoRadiusGray" id="nombre" name="nombre" type="text" placeholder="" value="{{$instructor->Nombre}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="apaterno" class="control-label col-md-3 ClassThin gray normal">Apellido Paterno</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusGray" id="apaterno"  name="apaterno" type="text" placeholder="" value="{{$instructor->APaterno}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="amaterno" class="control-label col-md-3 ClassThin gray normal">Apellido Materno</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusGray" id="amaterno" name="amaterno" type="text" placeholder="" value="{{$instructor->AMaterno}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-md-3 ClassThin gray normal">Contraseña</label>
            <div class="col-md-6">
                <input class="form-control NoRadiusGray" id="password" name="password" type="password" placeholder="">
            </div>
        </div>
        @if ($instructor->Status === "ALTA")
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 ClassThin gray normal">Estatus</label>
            <div class="col-md-6">
                <select class="form-control NoRadiusGray" name="estatus" id="estatus">
                    <option selected value="ALTA">ALTA</option>
                    <option value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 ClassThin gray normal">Sexo</label>
            <div class="col-md-6">
                <select class="form-control NoRadiusGray" name="estatus" id="estatus">
                    <option value="ALTA">ALTA</option>
                    <option selected value="BAJA">BAJA</option>
                </select>
            </div>
        </div>
         @endif

        <div class="form-group">
            <div class="col-md-2 col-md-offset-4 ">
                <!--<button class="NoRadiusColorColorButton " id="registro" type="submit">Guardar registro</button>-->
                <button class="NoRadiusColorButton "  style="width:300px" id="registro" type="submit">Guardar registro &nbsp; <span class="glyphicon glyphicon-ok"></span></button>

            </div>
        </div>
    </form>
</div>
</body>
</html>
