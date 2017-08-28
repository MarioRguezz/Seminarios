$(document).ready(function () {
	var pdftpl = `<label for="PDF" class="control-label col-md-3 whiteClassThin normal verde">Adjunte Archivo en PDF no mayor a 15 Mb</label>
<label for="pdffile" class="custom-file-upload whiteClassThin normal verde"> Archivo PDF</label>
	<input type="file" name="PDF" id="pdffile" class="btn btn-warning">`;

    var videotpl = `
 <div class="row" style="margin-bottom:20px;">
		<label for="nombre" class="control-label col-md-3 whiteClassThin normal verde">Adjunte la URL de su video</label>
	<div class="col-md-6">
	<input class="form-control " id="videoUrl" name="videoUrl" type="url" placeholder="" required>
	</div>
	</div>
 <div class="row">
	 <label for="nombre" class="control-label col-md-3 whiteClassThin verde normal">Tipo de video</label>
	<div class="col-md-6">
	<select class="form-control " name="tipoVideo" id="tipoVideo" required name="TMat" id="TMat">
			<option value="1">Youtube</option>
			<option value="2">Vimeo</option>
	</select>
	</div>
	</div>`;





    var audiotpl = `<label for="Audio" class="control-label col-md-3 whiteClassThin normal verde">Adjunte Audio no mayor a 20 Mb</label>
<label for="listenfile" class="custom-file-upload whiteClassThin normal verde"> Audio</label>
	<input type="file" name="Audio" id="listenfile" class="btn btn-primary">`;

   /* var tpl = `<div class="divNombre"><label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre corto para el archivo</label>
          <div class="col-md-6">
          <input class="form-control NoRadius" id="nombreArchivo"
          name="nombreArchivo" type="text" placeholder="Sin espacios, no mayor a 15 caracteres" maxlength="15"  required>
          </div>`;*/


   // $('#PDF').hide();
   // $('#Video').hide();
   // $('#Audio').hide();
	$('#nombreArchivo').hide();

    $('#TMat').change(function () {
    //  console.log($('#TMat').val());
        if ($('#TMat').val() == 'PDF')
		{
			$('#nombreArchivo1').show(1000);
			$('.divNombre').remove();
      		//$('.nothing').prepend(tpl);
      		$('#PDF').append(pdftpl);
			$('#Video').remove();
			$('#Audio').remove();
        }
		else if ($('#TMat').val() == 'Video')
		{
	 		$('#nombreArchivo1').show(1000);
			$('.divNombre').remove();
			$('#PDF').remove();
			//$('#Video').show(1000);
            $('#Video').append(videotpl);
			$('#Audio').remove();

		}
		else if ($('#TMat').val() == 'Audio')
		{
			$('#nombreArchivo1').show(1000);
			$('.divNombre').remove();
      		//$('.nothing').prepend(tpl);
			$('#PDF').remove();
			$('#Video').remove();
			$('#Audio').append(audiotpl);
		}
		else
		{
			$('#nombreArchivo1').hide(1000);
			$('#PDF').remove();
			$('#Video').remove();
			$('#Audio').remove();
		}
    });

});
