<?PHP
?>
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro</title>

    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/passwordval.js')}}"></script>


    <link rel="stylesheet" href="{{url('/js/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/Main.css')}}">
    <link href="{{url('/css/radiocss.css" rel="stylesheet')}}" />

    <script src="{{url('/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/inicio.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/login.css')}}">
    <script src="{{url('/js/efectos.js')}}"></script>




    <script src="{{url('/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/dist/sweetalert.css')}}">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


</head>

<body class="registro">

<center>
    <h3 class="cssTitleRegistro">REGISTRO PARA NUEVOS USUARIOS</h3>
</center>
<br><br><br>


<!-- <div class="col-xs-6"> -->

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

    <form action="{{url('/usuario/nuevoalumnoregistro')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="nombre" class="control-label col-md-3 whiteClass">Nombre</label>
            <div class="col-md-6">
                <input  id="idCA" name="idCA" type="hidden" value="{{$cve_ca}}" required>
                <input  id="idCA2" name="idCA2" type="hidden" value="{{$cve_ca2}}" required>
                <input class="form-control NoRadius" id="nombre" name="nombre" type="text" placeholder="" value="{{isset($request) ? $request['nombre'] : ""}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="apaterno" class="control-label col-md-3 whiteClass">Apellido Paterno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="apaterno"  name="apaterno" type="text" placeholder="" value="{{isset($request) ? $request['apaterno'] : ""}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="amaterno" class="control-label col-md-3 whiteClass">Apellido Materno</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="amaterno" name="amaterno" type="text" placeholder="" value="{{isset($request) ? $request['amaterno'] : ""}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="control-label col-md-3 whiteClass">Email</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="email" name="email" type="email" placeholder="" value="{{isset($request) ? $request['email'] : ""}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="control-label col-md-3 whiteClass">Contraseña</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="password" name="password" type="password" placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="opcion" class="control-label col-md-3 whiteClass">Sexo</label>
            <div class="col-md-6">
                <select class="form-control NoRadius" name="sexo" id="sexo">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="telofi" class="control-label col-md-3 whiteClass">Telefono de oficina</label>
            <div class="col-md-6">
                <input class="form-control NoRadius"  maxlength="15" id="telofi" name="telofi" type="tel" pattern="^\d{7,}$" value="{{isset($request) ? $request['telofi'] : ""}}" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="telcasa" class="control-label col-md-3 whiteClass">Telefono de casa</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" maxlength="15" id="telcasa" name="telcasa" type="tel" pattern="^\d{7,}$"  value="{{isset($request) ? $request['telcasa'] : ""}}" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="celular" class="control-label col-md-3 whiteClass">Telefono celular</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" maxlength="20" id="celular" name="celular" type="tel" pattern="^\d{7,}$"  value="{{isset($request) ? $request['celular'] : ""}}" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="estado" class="control-label col-md-3 whiteClass">Estado</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="estado" name="estado" type="text" placeholder="" value="{{isset($request) ? $request['estado'] : ""}}">
            </div>
        </div>

        <div class="form-group">
            <label for="municipio" class="control-label col-md-3 whiteClass">Municipio</label>
            <div class="col-md-6">
                <input class="form-control NoRadius" id="municipio" name="municipio" type="text" value="{{isset($request) ? $request['municipio'] : ""}}" placeholder="">
            </div>
        </div>

        <!-- Parte oculta del formulario -->

        <div class="form-group" id="foto">
            <label for="foto" class="control-label col-md-3 whiteClass">Adjunte fotografía no mayor a 5 Mb</label>
            <br>

            <label for="fotos" class="custom-file-upload">
                Fotografía
            </label>
            <input type="file" name="Archivo1" id="fotos" class="btn btn-info">

        </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-4 ">
                <button class="buttonTransparentBorder buttonAlta" id="btn-registro" type="submit">Guardar registro &nbsp; <span class="glyphicon glyphicon-ok"></span></button>
                <!-- <input type="submit" class="btn btn-primary" value="Guardar registro"> -->
            </div>
        </div>

        <!-- Fin de la parte oculta del formulario -->

    </form>

</div> <!-- Fin del div principal Alumno-->



</body>


</html>