class Pregunta{
    constructor(idExamen, tipo){
        this.idExamen = idExamen,
        this.tipo = tipo,
        this.guid = this.guid(),
        this.respuestas = [];
    }
    getJSON() {
        var clon = JSON.parse(JSON.stringify(this));
        delete clon.idExamen,
            clon.tipo;
        return JSON.stringify(clon);
    }


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
            item1 = $("<div class='boxItem'> Item 1 </div>"),
            item2 = $("<div class='boxItem'> Item 2 </div>"),
            casilla1 = $("<div class='text marco'>Casilla 1</div>");

        contenedor.attr('id', p.guid);
        subContenedor.append(select);
        select.append(option1)
            .append(option2)
            .append(option3);

        divLeft.append(item1).append(item2);
        divRight.append(casilla1);

        contenedor.append(titulo)
            .append(subContenedor)
            .append(remove)
            .append(Area)
            .append(qArea)


        //Por defecto que se muestre un textarea
        qArea.append(textarea);
        p.contenedor = contenedor;


        //Evento que permite la selección de diferentes tipos de preguntas.
        select.change(() => {
            console.log( select.val());
            qArea.empty();
            this.tipo = select.val();
            switch(select.val()){
                case "1":
                    qArea.append(textarea);
                    break;
                case "2":
                    qArea.append(choice1);
                    qArea.append(choice2);
                    break;
                case "3":
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