var examen = new Examen();

$(function(){
    $("#nuevaPregunta").click(() => {
        var pregunta = new Pregunta();
        examen.preguntas.push(pregunta);
        $("#contenedorPreguntas").append(pregunta.template());

    })
})