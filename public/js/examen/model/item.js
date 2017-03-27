class Item {
    constructor(nombre) {
        this.nombre = nombre;
        this.guid = guid();
    }

    template() {
        return "<div class='boxItem'>"+this.nombre+"</div>";
    }
}