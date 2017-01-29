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

    $('#usernameR').focusout(function () {
        var us = $('#usernameR').val();

        $.ajax({
            url: 'php/userexiste.php',
            type: "post",
            dataType: 'json',
            data: {
                user: us
            }
        }).done(function (respuesta) {
            if (respuesta == 1) {
                $('#ErrorUser').show();
                $('#nU').addClass("has-error has-feedback");
                $('.errorU').show();
                Error=true;

            } else {
                $('#ErrorUser').hide();
                $('#nU').removeClass("has-error has-feedback");
                $('.errorU').hide();
                Error=false;
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