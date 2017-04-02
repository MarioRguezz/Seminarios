var examen = new Examen();

$(function(){
    $("#nuevaPregunta").click(() => {
        var pregunta = new Pregunta();
        examen.preguntas.push(pregunta);
        $("#contenedorPreguntas").append(pregunta.template());

    });

    $("#guardar").click(() => {

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