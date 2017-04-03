class Casilla {
    constructor(nombre) {
        this.nombre = nombre;
        this.guid = guid();

    }

    template() {
        var casilla = this,
            contenedor = $("<div class='texto marco' id='"+casilla.guid+"'>"),
            input = $("<input type='text' value="+this.nombre+" style='text-align:center'>"),
            remove = $("<button class='btn btn-danger rightPosition'>&times;</button>");

        casilla.input = input;
        casilla.remove = remove;



        contenedor.append(remove).append(input);
        return contenedor;
    }


    asignarEventos(p) {
        var casillaX = this;
        casillaX.remove.click(function() {
            p.casillas.forEach((item, index) => {
                console.log(casillaX.guid == item.guid);
                if(casillaX.guid == item.guid){
                    p.casillas.splice(index, 1);
                    return;
                }
            })
            $("#"+casillaX.guid).remove();

            p.actualizarRespuestaCasillas();
        });

        casillaX.input.change(() => {
            casillaX.nombre = casillaX.input.val();
        });
    }
}