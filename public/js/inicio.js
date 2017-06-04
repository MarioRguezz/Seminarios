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


    $('.textPublic').change(function(){
       if( $('.textPublic').is(":checked")){
           $(".emailsGroup").empty();
       }else{
           $(".emailsGroup").append('<label for="nombre" class="control-label col-md-3 whiteClassThin">Los correos deben ir separados por un espacio en blanco</label>' +
               '<div class="col-md-6"><textarea class="form-control NoRadiusColor2" maxlength="20000" id="emails" name="emails" placeholder="correo@hotmail.com, correo2@hotmail.com" required></textarea> </div>');

       }
    });


    $('.elementoButton').click(function () {
        var elem = this;
        $.ajax({
            url: '../usuario/status',
            type: "post",
            dataType: 'json',
            data: {
                Mat_Alumno: $($(this).parent().siblings()[0]).val(),
                id_Curso: $($(this).parent().siblings()[1]).val()
            }
        }).done(function (respuesta) {
            console.log(respuesta);
            console.log($(elem).children());
            if (respuesta == 1) {
                swal({
                        title: "Ha dado de alta el usuario",
                        text: "Clic en el botón para continuar",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#00FF00",
                        confirmButtonText: "Continuar",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    });
                $(elem).html("Alta");
            } else {
                swal({
                    title: "Ha dado de baja el usuario",
                    text: "Clic en el botón para continuar",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#00FF00",
                    confirmButtonText: "Continuar",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                });
                $(elem).html("Baja");
            }
        });

    });






	//swal({   title: "Error!",   text: "Here's my error message!",   type: "error",   confirmButtonText: "Cool" });

});
