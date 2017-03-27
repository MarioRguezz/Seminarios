class Pregunta{
    constructor(idExamen, tipo){
        this.idExamen = idExamen,
        this.tipo = tipo,
        this.guid = guid(),
        this.respuestas = [],
        this.choices = [];

        //Pregunta abierta
        this.textarea = null;

        //Relacionar columnas
        this.items = [];
        this.casillas = [];
        this.btnLeft = null;
        this.btnRight = null;

    }
    getJSON() {
        var clon = JSON.parse(JSON.stringify(this));
        delete clon.idExamen,
            clon.tipo;
        return JSON.stringify(clon);
    }


    /**
     * Método que define cómo será la vista que se agrega al cuadro de encuesta.
     * @returns {*|jQuery|HTMLElement}
     */
    template() {
        var p = this,
            contenedor = $("<div class='box contenedorpregunta col-md-10 col-md-offset-1' />"),
            titulo = $(`<input type='text' class='tituloPregunta space leftPosition' placeholder='Nueva pregunta'>`),
            subContenedor  = $("<div class='select space leftPosition'/>"),
            select = $("<select />"),
            option1 = $("<option value='1'>Pregunta abierta</option>"),
            option2 = $("<option value='2'>Opción múltiple</option>"),
            option3 = $("<option value='3'>Relacionar columnas</option>"),
            remove = $("<button class='btn btn-danger rightPosition'>&times;</button>"),
            Area = $("<div class='clear'/>"),
            qArea = $("<div class='boxTop'/>"),
            textarea = $("<input type='text' class='textArea space leftPosition' placeholder='Introduzca la respuesta correcta'>"),
            choice1 = $("<div class='fullSize left box'><input type='radio'  value='1'> <label class='text'>Opcion 1</label></div>"),
            choice2 = $("<div class='fullSize left box'><input type='radio' value='2'> <label class='text'>Opcion 2</label></div>"),
            divLeft = $("<div class='leftPosition leftBox boxTop'/>"),
            divRight = $("<div class='rightPosition rightBox boxTop'/>"),
            btnLeft = $("<button class='boxItem'> Agregar Item </button>"),
            btnRight= $("<button class='text marco'> Agregar casilla </button>");

        contenedor.attr('id', p.guid);
        subContenedor.append(select);
        select.append(option1)
            .append(option2)
            .append(option3);


        contenedor.append(titulo)
            .append(subContenedor)
            .append(remove)
            .append(Area)
            .append(qArea)


        //Por defecto que se muestre un textarea
        qArea.append(textarea);
        p.textarea = textarea;
        p.eventosPreguntaAbierta();

        p.contenedor = contenedor;


        //Evento que permite la selección de diferentes tipos de preguntas.
        select.change(() => {
            p.respuestas = [];
            qArea.empty();
            this.tipo = select.val();
            switch(select.val()){
                case "1":
                    limpiarElementos();
                    qArea.append(textarea);
                    p.textarea = textarea;
                    p.eventosPreguntaAbierta();
                    break;
                case "2":
                    qArea.append(choice1);
                    qArea.append(choice2);
                    break;
                case "3":
                    var item1 = new Item("Item 1"),
                        item2 = new Item("Item 2"),
                        casilla1 = new Casilla("Casilla 1");

                    p.items.push(item1);
                    p.items.push(item2);
                    p.casillas.push(casilla1);

                    divLeft.append(item1.template()).append(item2.template()).append(btnLeft);
                    divRight.append(casilla1.template()).append(btnLeft);
                    qArea.append(divLeft);
                    qArea.append(divRight);
                    qArea.append(Area);
                    break;
            }
        });

        remove.click(() => {
            var p = this;
            console.log(p.guid)
            examen.eliminar(p.guid);
        });
        return contenedor;

    }

    /**
     * Eventos utilizados en pregunta abierta
     */
    eventosPreguntaAbierta() {
        var p = this;
        p.textarea.change(() => {
            p.respuestas = [p.limpiarAcentosYMayus(p.textarea.val())];
        })
    }

    /**
     * Eventos relacionar columnas
     */
    eventosRelacionarColumnas() {
        var p = this;
    }

    /**
     * En esta función deben ponerse todos los elementos que se van a limpiar (Radio buttons, botones e inputs)
     */
    limpiarElementos() {
        p.textarea = null;
    }


    /**
     * Método para limpiar acentos y mayúsculas en la respuesta principal.
     * @param texto
     * @returns {string}
     */
    limpiarAcentosYMayus(texto) {
        var nTexto = texto.toLowerCase();
        nTexto.replace("á", "a")
            .replace("Á" , "A")
            .replace("é" , "e")
            .replace("É" , "E")
            .replace("í" , "i")
            .replace("Í" , "I")
            .replace("ó" , "o")
            .replace("Ó" , "O")
            .replace("ú" , "u")
            .replace("Ú" , "U")
            .replace("ü" , "u")
            .replace("Ü" , "U");

        return nTexto.trim();
    }

}