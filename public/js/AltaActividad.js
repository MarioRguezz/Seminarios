$(document).ready(function () {

    $('#Memorama').hide();
	$('#Aceptar').hide();
	$('#DAD').hide();
	$('#Rompecabezas').hide();

    $('#TAct').change(function () {

        if ($('#TAct').val() == 'Memorama') 
		{	
			$('#Memorama').show(1000);
			$('#Aceptar').show(1000);
			$('#Rompecabezas').hide(1000);
			$('#DAD').hide(1000);		            
        } 
		else if ($('#TAct').val() == 'DAD') 
		{	
			$('#Memorama').hide(1000);
			$('#Aceptar').hide(1000);
			$('#Rompecabezas').hide(1000);
			$('#DAD').show(1000);					            
        }
		else if ($('#TAct').val() == 'Rompecabezas') 
		{	
			$('#Memorama').hide(1000);			
			$('#DAD').hide(1000);
			$('#Rompecabezas').show(1000);
			$('#Aceptar').show(1000);
        }
		else
		{
			$('#Memorama').hide(1000);					
			$('#Aceptar').hide(1000);
			$('#DAD').hide(1000);
			$('#Rompecabezas').hide(1000);
		}
    });
    
});