$(document).ready(function () {

    $('#PDF').hide();
    $('#Video').hide();
    $('#Audio').hide();
	$('#nombreArchivo').hide();

    $('#TMat').change(function () {
    //  console.log($('#TMat').val());
        if ($('#TMat').val() == 'PDF')
		{
			$('#nombreArchivo1').show(1000);
      $('.divNombre').remove();
      var tpl = `<div class="divNombre"><label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre corto para el archivo</label>
          <div class="col-md-6">
          <input class="form-control NoRadius" id="nombreArchivo"
          name="nombreArchivo" type="text" placeholder="Sin espacios, no mayor a 15 caracteres" maxlength="15" required>
          </div>`;
      $('.nothing').prepend(tpl);
      $('#PDF').show(1000);
			$('#Video').hide();
			$('#Audio').hide();
        }
		else if ($('#TMat').val() == 'Video')
		{
	 	$('#nombreArchivo1').show(1000);
      $('.divNombre').remove();
			$('#PDF').hide();
			$('#Video').show(1000);
			$('#Audio').hide();

		}
		else if ($('#TMat').val() == 'Audio')
		{
			$('#nombreArchivo1').show(1000);
      $('.divNombre').remove();
      var tpl = `<div class="divNombre"><label for="nombre" class="control-label col-md-3 whiteClassThin">Nombre corto para el archivo</label>
          <div class="col-md-6">
          <input class="form-control NoRadius" id="nombreArchivo"
          name="nombreArchivo" type="text" placeholder="Sin espacios, no mayor a 15 caracteres" maxlength="15" required>
          </div></div>`;
      $('.nothing').prepend(tpl);
			$('#PDF').hide();
			$('#Video').hide();
			$('#Audio').show(1000);
		}
		else
		{
			$('#nombreArchivo1').hide(1000);
			$('#PDF').hide(1000);
			$('#Video').hide(1000);
			$('#Audio').hide(1000);
		}
    });

});
