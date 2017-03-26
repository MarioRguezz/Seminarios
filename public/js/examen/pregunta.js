class Pregunta{
    constructor(idExamen, tipo){
        this.idExamen = idExamen,
        this.tipo = tipo,
        this.guid = this.guid(),
        this.select = null;
        this.respuestas = [];
    }
    getJSON = function(){
        var clon = JSON.parse(JSON.stringify(this));
        delete clon.idExamen,
            clon.tipo;
        return JSON.stringify(clon);
    }

    template = function(){
        var p = pregunta,
            contenedor = $("<div/>"),
            titulo = $(`<input type='text' placeholder='Nueva pregunta'>`),
            select = $("<select/>"),
            option1 = $("<option value='1'>Pregunta abierta</option>"),
            option2 = $("<option value='2'>Opción múltiple</option>"),
            option3 = $("<option value='3'>Relacionar columnas</option>"),
            qArea = $("<div/>"),
            textarea = $("<input type='text' placeholder='Introduzca la respuesta correcta'>"),
            choice1 = $("<input type='radio' value='1'> Opcion 1"),
            choice2 = $("<input type='radio' value='2'> Opcion 2"),
            divLeft = $("<div/>"),
            divRight = $("<div/>"),
            item1 = $("<div> Item 1 </div>"),
            item2 = $("<div> Item 2 </div>"),
            casilla1 = $("<div>Casilla 1</div>");

        contenedor.css('width', '100%');

        select.append(option1)
            .append(option2)
            .append(option3);

        divLeft.append(item1).append(item2);
        divRight.append(casilla1);

        contenedor.append(titulo)
            .append(select)
            .append(qArea);



        select.change(() => {
            qArea.empty();
            switch(select.val()){
                case 1:
                    qArea.append(textarea);
                    break;
                case 2:
                    qArea.append(choice1);
                    qArea.append(choice2);
                    break;
                case 3:
                    qArea.append(divLeft);
                    qArea.append(divRight);
                    break;
            }
        })
        return contenedor;

    }

    guid = function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }
}