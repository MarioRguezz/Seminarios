var examen = new Examen($("#_idTema").val());

$(function(){
    $("#nuevaPregunta").click(() => {
        var pregunta = new Pregunta();
        examen.preguntas.push(pregunta);
        $("#contenedorPreguntas").append(pregunta.template());

    });

    $("#btnGuardar").click(() => {
        examen.idTema = $("#_idTema").val();
        examen.actividad = $("#tipo").val() == "actividad"? true : false;
        examen.guardar();
    });
});



/**
 * Método que devuelve un id único para asignar a la pregunta.
 * @returns {string}
 */
function guid () {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
        s4() + '-' + s4() + s4() + s4();
}
