class Examen {
    constructor(idTema) {
        this.preguntas = [];
        this.idTema = idTema;
    }

    eliminar(guid){
        var examen = this;

        for(var i = 0, max = examen.preguntas.length ; i < max; i++){
            if(examen.preguntas[i].guid == guid){
                examen.preguntas.splice(i, 1);
                $("#" + guid).remove();
                return;
            }
        }
    }
}