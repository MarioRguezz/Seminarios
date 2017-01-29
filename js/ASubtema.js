$(document).ready(function () {

    $('#ArchivoPDF').hide();
    $('#ArchivoVideo').hide();
    $('#ArchivoAudio').hide();

    $('#TMat').change(function () {

        if ($('#TMat').val() == 'PDF') 
		{			
            $('#ArchivoPDF').show(1000);
			$('#ArchivoVideo').hide();
			$('#ArchivoAudio').hide();
        } 
		else if ($('#TMat').val() == 'Video')
		{
			$('#ArchivoPDF').hide();
			$('#ArchivoVideo').show(1000);
			$('#ArchivoAudio').hide();
		}
		else if ($('#TMat').val() == 'Audio')
		{
			$('#ArchivoPDF').hide();
			$('#ArchivoVideo').hide();
			$('#ArchivoAudio').show(1000);
		}
		else
		{
			$('#ArchivoPDF').hide(1000);
			$('#ArchivoVideo').hide(1000);
			$('#ArchivoAudio').hide(1000);
		}
    });
    
});