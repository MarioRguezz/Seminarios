class Pregunta{
    constructor(idExamen){
        this.id = null,
        this.idExamen = idExamen,
        this.tipo = "1",
        this.titulo = "Nueva pregunta",
        this.inputTitulo = null,
        this.guid = this.guid(),
        this.respuestas = [];
        this.choices = [];
        //Pregunta abierta
        this.textarea = null;
        //Relacionar columnas
        this.items = [];
        this.casillas = [];
        this.btnLeft = null;
        this.btnRight = null;
    }

   tJSON() {
        var clon = JSON.parse(JSON.stringify(this));
        delete clon.textarea,
            clon.btnLeft,
            clon.btnRight,
            clon.contenedor,
            clon.inputTitulo;

       clon.choices.forEach((choice) => {
           delete choice.titulo,
               choice.borrar,
               choice.contenedor,
               choice.radio;
       });

       clon.items.forEach((item) => {
           delete item.input,
               item.remove;
       });

       clon.casillas.forEach((casilla) => {
           delete casilla.input,
               casilla.remove;
       })

       clon.items.forEach((item) => {
           delete item.remove,
               item.input;
       })


        return clon;
    }


    /**
     * Método que define cómo será la vista que se agrega al cuadro de encuesta.
     * @returns {*|jQuery|HTMLElement}
     */
    template() {
        var p = this,
            contenedor = $("<div class='box contenedorpregunta col-md-10 col-md-offset-1' />"),
            titulo = $("<input type='text' class='tituloPregunta space leftPosition' placeholder='Nueva pregunta'>"),
            subContenedor  = $("<div class='select space leftPosition'/>"),
            select = $("<select />"),
            option1 = $("<option value='1'>Pregunta abierta</option>"),
            option2 = $("<option value='2'>Opción múltiple</option>"),
            option3 = $("<option value='3'>Relacionar columnas</option>"),
            remove = $("<button class='btn btn-danger rightPosition'>&times;</button>"),
            textarea = $("<input type='text' class='textArea space leftPosition' placeholder='Introduzca la respuesta correcta'>"),
            Area = $("<div class='clear'/>"),
            qArea = $("<div id='contenedor' class='boxTop'/>"),
            addElement = $("<div class='boxTop'/>"),
            textarea = $("<input type='text' class='textArea space leftPosition boxTop' placeholder='Introduzca la respuesta correcta'>"),
            buttonAdd = $("<button class='btn btn-primary'>Agregar</button>"),
            nota = $("<label class='text'>La opción que escojas será tu respuesta</label>");

        contenedor.attr('id', p.guid);
        subContenedor.append(select);
        select.append(option1)
            .append(option2)
            .append(option3);


        contenedor.append(titulo)
            .append(subContenedor)
            .append(remove)
            .append(Area)
            .append(qArea);

        addElement.append(buttonAdd);

        buttonAdd.click(() =>{
            var longitud = this.choices.length;
            this.choices.push(new Choice(longitud+1, this.guid));
            qArea.append(this.choices[this.choices.length-1].tpl());
            this.choices[this.choices.length-1].eventoCambioTexto();
            this.choices[this.choices.length-1].borrado(this.choices);
            this.choices[this.choices.length-1].respuestaSeleccionado(this.respuestas);

        });

        //Por defecto que se muestre un textarea
        qArea.append(textarea);
        p.textarea = textarea;
        p.eventosPreguntaAbierta();

        p.contenedor = contenedor;

        titulo.change(() => {
            p.titulo = titulo.val();
        })

        //Evento que permite la selección de diferentes tipos de preguntas.
        select.change(() => {
            p.respuestas = [];
            qArea.empty();
            this.tipo = select.val();
            switch(select.val()){
                case "1":
                    textarea = $("<input type='text' class='textArea space leftPosition boxTop' placeholder='Introduzca la respuesta correcta'>"),
                    qArea.append(textarea);
                    p.textarea = textarea;
                    p.eventosPreguntaAbierta();
                    break;
                case "2":
                    qArea.append(nota);
                    contenedor.append(addElement);
                    break;
                case "3":
                    var divLeft = $("<div class='leftPosition leftBox boxTop'/>"),
                        divRight = $("<div class='rightPosition rightBox boxTop'/>"),
                        btnLeft = $("<button class='boxItem'> Agregar Item </button>"),
                        btnRight= $("<button class='text marco'> Agregar casilla </button>"),
                        item1 = new Item("Item1"),
                        item2 = new Item("Item2"),
                        casilla1 = new Casilla("Casilla1");

                    p.respuestas = [
                        {
                            casilla: casilla1.guid,
                            item: item1.guid
                        }
                    ]

                    p.items.push(item1);
                    p.items.push(item2);
                    p.casillas.push(casilla1);

                    p.btnLeft = btnLeft;
                    p.btnRight = btnRight;


                    divLeft.append(item1.template()).append(item2.template()).append(btnLeft);
                    divRight.append(casilla1.template()).append(btnRight);

                    item1.asignarEventos(p);
                    item2.asignarEventos(p);
                    casilla1.asignarEventos(p);

                    qArea.append(divLeft);
                    qArea.append(divRight);
                    qArea.append(Area);

                    p.eventosRelacionarColumnas();
                    break;
            }
        });

        remove.click(() => {
            var p = this;
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
        p.btnLeft.click(() => {
            var nItem = new Item("Nuevo Item");
            p.items.push(nItem);
            p.btnLeft.before(nItem.template());
            nItem.asignarEventos(p);
            p.actualizarRespuestaCasillas();
        });

        p.btnRight.click(() => {
            var nCasilla = new Casilla("Nueva casilla");
            p.casillas.push(nCasilla);
            p.btnRight.before(nCasilla.template());
            nCasilla.asignarEventos(p);
            p.actualizarRespuestaCasillas();
        });
    }


    actualizarRespuestaCasillas() {
        var p = this;
        p.respuestas = [];
        p.casillas.forEach((casilla,index)=> {
            if(p.items[index]){
                p.respuestas.push({casilla: casilla.guid, item: p.items[index].guid});
            }
            else {
                p.respuestas.push({casilla: casilla.guid, item: null});
            }

        });
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


    renderAbierta () {
        var p = this,
            contenedor = $("<div class='box contenedorpregunta col-md-10 col-md-offset-1' />"),
            titulo = $("<input type='text' class='tituloPregunta space leftPosition' placeholder='Nueva pregunta'>"),
            subContenedor  = $("<div class='select space leftPosition'/>"),
            textarea = $("<input type='text' class='textArea space leftPosition' placeholder='Introduzca la respuesta correcta'>"),
            Area = $("<div class='clear'/>"),
            qArea = $("<div id='contenedor' class='boxTop'/>"),
            addElement = $("<div class='boxTop'/>"),
            textarea = $("<input type='text' class='textArea space leftPosition boxTop' placeholder='Introduzca la respuesta correcta'>");

        contenedor.append(titulo)
            .append(textarea)

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