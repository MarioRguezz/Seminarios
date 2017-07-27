@extends('principal')

@section('titulo')
   Alta de usuarios por CSV
@endsection

@section('head')

    <script src="../js/jquery.csv.js"></script>
    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

@endsection

@section('content')
<body class="backgroundPrincipal">
<div style="margin-top:100px; margin-bottom: 2%;" class="container-fluid">
    <div   style="margin-top:10px;" class="titleContainer">
        <div class="titleImg">
        <img  class="imageMargin" src="{{url('/img/byondiconos/BEYOND2-25.png')}}" height="40" width="40">
          <span class="greenclearTitle">ALTA DE USUARIOS POR CSV</span>
        </div>
      </div>
    <div  class=" col-xs-12 wellalternative back middle"  id="menu">
        <div class="row">
            <div class="col-xs-3">
              <label style="margin-top:5px;" class="SubtitleMainPurpleClass"> CARGA CSV  </label>
        </div>
        <div class="col-xs-3">
          <!--<button  style="margin-top:10px;"class="btn btn-primary"> Subir archivo </button>-->
          <div id="dvImportSegments" class="fileupload ">
   <label   for="txtFileUpload"  class="control-label    NoRadiusColorButtonCircle">SUBIR ARCHIVO</label>
         <input type="file" name="txtFileUpload" id="txtFileUpload" accept=".csv" />
       </div>
        </div>
          <div class="col-xs-3">
        <button   class="NoRadiusColorButtonCircletype2 btnsub">Subir</button>
        </div>
        <div style="margin-top:1%;" class="col-xs-3">
        <a  href="" data-toggle="modal" data-target="#myModal" class="glyphicon designahref glyphicon-question-sign questionMark verde" aria-hidden="true"><span style="color:#292a28;  font-weight: 600;">Ayuda</span> </a>
        </div>
    </div>
</div>
</div>

<!-- Modal Instructions -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Instrucciones</h4>
            </div>
            <div class="modal-body">
                <p>Podrá subir un archivo .csv para registrar sus usuarios siguiendo los siguientes pasos:</p>
                <ol>
                    <li>Podrá descargar el archivo, para llenarlo con la información correspondiente desde <a href="{{url('/docs/download/lista.csv')}}" download="byond.csv">aquí</a></li>
                    <li>Ingrese el correo de los usuarios que piensa agregar al sistema</li>
                    <li>Verifique su número de licencias ya que si trata de ingresar más de los que puede no serán dados de alta</li>
                    <li>Una vez agregados los correos, agregar una fila más con el texto "alta"</li>
                    <li>Presione el botón subir en caso de surgir algún inconveniente se le será notificado si no </li>
                    <li>Llegará un correo a los usuarios informandoles de su registro</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
// The event listener for the file upload
document.getElementById('txtFileUpload').addEventListener('change', upload, false);
var data = null;
// Method that checks that the browser supports the HTML5 File API
function browserSupportFileUpload() {
    var isCompatible = false;
    if (window.File && window.FileReader && window.FileList && window.Blob) {
    isCompatible = true;
    }
    return isCompatible;
}

// Method that reads and processes the selected file
function upload(evt) {
if (!browserSupportFileUpload()) {
    alert('El archivo no es soportado por el navegador!');
    } else {

        var file = evt.target.files[0];
        var reader = new FileReader();
        reader.readAsText(file);
        reader.onload = function(event) {
            var csvData = event.target.result;
            data = $.csv.toArrays(csvData);
            if (data && data.length > 0) {
              console.log(data);
            } else {
                alert('No hay datos por subir');
            }
        };
        reader.onerror = function() {
            alert('Imposible de leer ' + file.fileName);
        };
    }
}

$( ".btnsub" ).click(function() {
    var emails = [];
  for(var x=1; x<data.length; x++){
    emails.push(data[x][0]);
  }

    $.ajax({
        method: 'POST',
        url: '{{url('/usuario/emails')}}',
        data: {
            emails: emails,
            restantes: '{{$administrador->restantes}}'
        },
        success:function(data) {
            swal("Emails enviados", "Se han enviado los correos electrónicos con éxito", "success");
            setTimeout(() => {
                location.href = "../";
            },3000);
        },

    error: function(data) {
        swal("Error", "Hubo un error al cargar la lista de correos", "error");
        }
    });
});
</script>
@endsection
