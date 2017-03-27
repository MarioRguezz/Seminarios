class Casilla {
    constructor(nombre) {
        this.nombre = nombre;
        this.guid = guid();

    }

    template() {
        return "<div class='texto marco'>"+ this.nombre +"</div>";
    }
}