/**
 * Created by marioalbertonegreterodriguez on 26/03/17.
 */


class Choice {
    constructor(length, name) {
        this.guid =  guid(),
        this.name = "Opcion",
        this.value = length,
        this.titulo = null,
        this.group = name;
        this.borrar = null;
        this.contenedor = null;
        this.radio = null;
        this.valor = null;
    }


    tpl(){
        var p = this,
            contenedor = $("<div class='fullSize left box' />"),
            radio = $("<input type='radio' name='"+this.group+"' class='marginForceRight' value='"+this.value+"'>"),
            titulo= $("<input class='large' value='"+this.name + " "+this.value+"'/>"),
            borrar = $("<button class='btn btn-danger rightPosition'>&times;</button>");
        contenedor.append(radio);
        contenedor.append(titulo);
        contenedor.append(borrar);
        p.titulo = titulo;
        p.borrar = borrar;
        p.contenedor = contenedor;
        p.radio = radio;
        return contenedor ;
    }


    eventoCambioTexto() {
        var p = this;
        p.titulo.change(() => {
            p.name = p.titulo.val();
            console.log(p.name);
        });
    }

    borrado(choiceArray) {
        var p = this;
        p.borrar.click(() => {
           p.contenedor.remove();
            choiceArray.splice(p.value-1, 1);
        });
    }


    respuestaSeleccionado(respuestas){
        var p = this;
        p.radio.change(() => {
            console.log(p.radio.val());
            respuestas[0] = p.radio.val();
        });

    }


    guid () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }


}