/**
 * Created by uriel on 3/04/17.
 */
var respuestas = [];

$(function(){

    //ASIGNAR BOTON DE GUARDAR
    $('#guardarExamen').click(function () {
        var elem = this;
        $.ajax({
            url: '../examen/respuesta',
            type: "post",
            dataType: 'json',
            data: {
                Respuestas:  respuestas
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
});