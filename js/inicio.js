$(document).ready(function () {
    $("#logindiv").hide();
    $("#video").hide();

    $(".rd").click(function () {
        $("#logindiv").hide();
        $("#video").hide();
        $("#divpdf").hide();
        var divver = $(this).attr("id");
        switch (divver) {
        case '1':
            $("#logindiv").show();
            break;
        case '2':
            $("#divpdf").show();
            break;
        case '3':
            $("#video").show();
            break;
        }

    });
	
	//swal({   title: "Error!",   text: "Here's my error message!",   type: "error",   confirmButtonText: "Cool" });

});