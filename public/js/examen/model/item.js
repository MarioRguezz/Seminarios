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

        input.change(() => {
            item.nombre = input.val();
        });

        contenedor.append(remove).append(input);
        return contenedor;
    }
}