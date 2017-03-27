/**
 * Created by marioalbertonegreterodriguez on 26/03/17.
 */


class Choice {
    constructor(length, name) {
        this.guid = this.guid(),
        this.name = "Opcion",
        this.value = length,
        this.titulo = null,
        this.group = name;
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
        return contenedor ;
    }


    eventoCambioTexto() {
        var p = this;
        p.titulo.change(() => {
            p.name = p.titulo.val();
            console.log(p.name);
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