class Item {
    constructor(nombre) {
        this.nombre = nombre;
        this.guid = guid();
        this.input = null;
        this.remove = null;
    }

    template() {

        var item = this,
            contenedor = $("<div class='boxItem' id='"+item.guid+"'>"),
            input = $("<input type='text' value="+this.nombre+" style='text-align:center'>"),
            remove = $("<button class='btn btn-danger rightPosition'>&times;</button>");

        item.input = input;
        item.remove = remove;

        item.asignarEventos()

        contenedor.append(remove).append(input);
        return contenedor;
    }

    asignarEventos(p) {
        var itemX = this;
        itemX.remove.click(function() {
            p.items.forEach((item, index) => {
                console.log(itemX.guid == item.guid);
                if(itemX.guid == item.guid){
                    console.log(index);
                    console.log(p.items.splice(index, 1));
                    return;
                }
            })
            $("#"+itemX.guid).remove();
            p.actualizarRespuestaCasillas();
        });

        itemX.input.change(() => {
            console.log(itemX.input.val())
            itemX.nombre = itemX.input.val();
        });
    }
}