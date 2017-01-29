$(document).ready(function () {

    $('#PDF').hide();
    $('#Video').hide();
    $('#Audio').hide();
	$('#nombreArchivo').hide();

    $('#TMat').change(function () {

        if ($('#TMat').val() == 'PDF') 
		{	
			$('#nombreArchivo').show(1000);		
            $('#PDF').show(1000);
			$('#Video').hide();
			$('#Audio').hide();
        } 
		else if ($('#TMat').val() == 'Video')
		{
			$('#nombreArchivo').show(1000);		
			$('#PDF').hide();
			$('#Video').show(1000);
			$('#Audio').hide();
		}
		else if ($('#TMat').val() == 'Audio')
		{
			$('#nombreArchivo').show(1000);		
			$('#PDF').hide();
			$('#Video').hide();
			$('#Audio').show(1000);
		}
		else
		{
			$('#nombreArchivo').hide(1000);		
			$('#PDF').hide(1000);
			$('#Video').hide(1000);
			$('#Audio').hide(1000);
		}
    });
    
});