/**
 * Created by uriel on 3/04/17.
 */
var respuestas = [];

$(function(){

    //ASIGNAR BOTON DE GUARDAR
    $('#guardarExamen').click(function () {
        var elem = this;
        var isAll = false;
        var count = 0;
        for(var q=0; q< respuestas.length; q++){
            if(respuestas[q].respuestas.length == 0) {
                count = 1;
            }
        }
        if(count == 1){
            isAll = false;
        }else{
            isAll = true;
        }
        console.log(isAll);
        if(total > respuestas.length || isAll == false){
            swal({
                title: "Necesita contestar todas las preguntas",
                text: "Clic en el botón para continuar",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#00FF00",
                confirmButtonText: "Continuar",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        }else {
            console.log(JSON.stringify(respuestas));
            $.ajax({
                url: '../examen/respuesta',
                type: "post",
                dataType: 'json',
                data: {
                    Respuestas: respuestas,
                    Mat_Alumno: $('#Mat_Alumno').val(),
                    IDTema: $('#IDTema').val()
                }
            }).done(function (respuesta) {

                    swal({
                            title: "Ha realizado el examen",
                            text: "Calificación "+respuesta+" de clic en el boton para continuar",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#00FF00",
                            confirmButtonText: "Continuar",
                            cancelButtonText: "Cancelar",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                location.href = "../examen/diploma/"+$('#Mat_Alumno').val()+"/"+$('#IDTema').val()+"" //cambiar por vista de aprobación
                            }
                        });
                        
            });
        }

    });
});


/*
if (respuesta >= "60") {
    swal({
            title: "Ha  pasado el examen",
            text: "de clic en el boton para continuar",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#00FF00",
            confirmButtonText: "Continuar",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },

        function (isConfirm) {
            if (isConfirm) {
                location.href = "../pages/MisCursos.php"
            }
        });
} else {
    swal({
            title: "Ha  reprobado el examen",
            text: "de clic en el boton para continuar",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#F7D358",
            confirmButtonText: "Continuar",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },

        function (isConfirm) {
            if (isConfirm) {
                location.href = "../pages/MisCursos.php"
            }
        });
}
 */
