$(document).ready(function () {
    //$("#PDF").hide();
    $("#Video").hide();
	$("#Audio").hide();

    $(".rd").click(function () {
        $("#PDF").hide();
        $("#Video").hide();
        $("#Audio").hide();
        var divver = $(this).attr("id");
        switch (divver) {
        case '4':
            $("#PDF").show();
            break;
        case '5':
            $("#Video").show();
            break;
        case '6':
            $("#Audio").show();
            break;			
        }

    });
	
	$('#SelectPDF').change(function(){
		var Selectedoption = $('#SelectPDF').val();
		alert(Selectedoption);
			$('#PDF').attr('src', Selectedoption);
	});
	
	$('.boton').click( function()
	{			
		  var X = $(this).attr("id");
        switch (X) {
        case '10':
            $("#PDF").show();
            break;
        case '11':
            alert("Boton 12");
            break;
        case '12':
            alert("Boton 13");
            break;
        }
		 
	});
	
	

});

