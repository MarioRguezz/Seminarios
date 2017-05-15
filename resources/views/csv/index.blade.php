<!DOCTYPE html>
<html lang="es">

<head>
    <title>CSV</title>
    <meta charset="utf-8" />
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../js/bootstrap/css/bootstrap.min.css">
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/radio.css">
    <link rel="stylesheet" href="../css/Principal.css">

    <script src="../js/jquery.csv.js"></script>
    <script src="../dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <style>
        html {
            height: 100%;
        }

       .weight{
          font-weight: bold !important;
        }
    </style>
</head>

<body class="backgroundPrincipal">
<div class="container-fluid">
    <div class="form-horizontal ">
        <div class="text-center">
            <label class="control-label" id="VP"><h3 class="whiteClass2 top">ALTA DE USUARIOS POR CSV</h3></label>
        </div>
    </div>
    <div class=" col-md-12 well back" id="menu">
      <div class="row">
      <div style="" class="col-md-12">
          <a  href="" data-toggle="modal" data-target="#myModal" class="glyphicon designahref glyphicon-question-sign questionMark" aria-hidden="true">Ayuda </a>
       </div>
     </div>
        <div class="row">
            <div class="col-md-2">
              <label class="SubtitleMainwhiteClass"> Carga CSV  </label>
        </div>
        <div class="col-md-2">
          <!--<button  style="margin-top:10px;"class="btn btn-primary"> Subir archivo </button>-->
          <div id="dvImportSegments" class="fileupload ">
   <label   for="txtFileUpload" class="control-label uploadbtn whiteClassThin">Subir archivo</label>
         <input type="file" name="txtFileUpload" id="txtFileUpload" accept=".csv" />
</div>
        </div>
    </div>
    <div class="row">
      <button class="btn btn-primary btnsub">Subir</button>
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
            emails: emails
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
</body>
</html>
