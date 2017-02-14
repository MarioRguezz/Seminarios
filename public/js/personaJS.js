$(document).ready(function () {

    $('#btn-registro').hide();
    $('#foto').hide();
    $('#CV').hide();

    $('#Tuser').change(function () {

        if ($('#Tuser').val() == 'Alumno') 
		{
            $('#btn-registro').show();
			$('#foto').show();
			$('#CV').hide();
        } 
		else if ($('#Tuser').val() == 'Instructor')
		{
			$('#btn-registro').show();
			$('#CV').show();
			$('#foto').hide();
		}
		else
		{
			$('#btn-registro').hide();
            $('#foto').hide();
            $('#CV').hide();
		}
    });

    $('#tipoPar').change(function () {

        if ($('#tipoPar').val() == 'pr') {
            $('#profesorstatus').show();
        } else {
            $('#profesorstatus').hide();
        }
    });
});