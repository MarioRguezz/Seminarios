
$(document).ready(function () {

    $('.errorI').hide();
    $('#errorPass').hide();
    $('#ErrorUser').hide();
    $('.errorU').hide();
    var Error=true;

    var Error = true; //si existe error no ver boton

    $('#passwordR2').keyup(function () { //funcion comparra cajas de texto para contraseñas correctas
        var pas1 = $('#passwordR').val();

        if ($('#passwordR2').val() != pas1) {
            $('#otraPass').addClass("has-error has-feedback");
            $('.errorI').show();
            $('#errorPass').show();
            Error=true;
        } else {
            $('#otraPass').removeClass("has-error has-feedback");
            $('.errorI').hide();
            $('#errorPass').hide();
            Error=false;
        }
    });

    $('#email').focusout(function () {
        var us = $('#email').val();
        console.log("dasdasd");
        $.ajax({
           // url: '../php/userexiste.php',
            url: '../verificarCorreo',
            type: "post",
            dataType: 'json',
            data: {
                email: us
            }
        }).done(function (respuesta) {
          console.log(respuesta);
            if (respuesta == 1) {
              console.log("existe");
               /* $('#ErrorUser').show();
                $('#nU').addClass("has-error has-feedback");
                $('.errorU').show();*/
                $('#email').css("background-color","red");
                $('#email').css("color","white");
                swal("Oops...", "Este correo ya ha sido registrado", "error");
                btn-registro
                $("#btn-registro" ).prop( "disabled", true);

            } else {
                /*
                $('#ErrorUser').hide();
                $('#nU').removeClass("has-error has-feedback");
                $('.errorU').hide();*/
                $('#email').css("background-color","");
                $('#email').css("color","");
                $("#btn-registro" ).prop( "disabled", false);
            }
        });

    });


    $("#register-form").submit(function () {
        if($('#passwordR2').val!="" && $('#passwordR').val!="" && $('#usernameR').val()!="" && $('#emailR').val()!="" && $('#tipo').val()!="" && !Error){
            return true;
        }
        return false;
    });





});
