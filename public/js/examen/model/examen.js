class Examen {
    constructor(idTema) {
        this.preguntas = [];
        this.idTema = idTema;
        this.actividad = false;
    }

    eliminar(guid){
        var examen = this;

        for(var i = 0, max = examen.preguntas.length ; i < max; i++){
            if(examen.preguntas[i].guid == guid){
                examen.preguntas.splice(i, 1);
                $("#" + guid).remove();
                return;
            }
        }
    }

    tJSON() {
        var examen = this,
            clone = JSON.parse(JSON.stringify(examen));

        clone.preguntas = [];

        examen.preguntas.forEach((pregunta) => {
            clone.preguntas.push(pregunta.tJSON());
        });
        return clone;
    }

    guardar () {
        var examen = this,
            guardar = examen.tJSON();

        guardar.nombre = $("#nombre").val();
        guardar.descripcion = $("#descripcion").val();

        $.ajax({
            url: $("#_url").val() + "/examen/guardar",
            data: guardar,
            method: "POST",
            type: 'json',
            success: function(response) {
                console.log(response);
                examen.id = response.id;
                examen.idSubtema = response.idSubtema;
                examen.preguntas.forEach((pregunta, index) => {
                    pregunta.id = response.preguntas[index];
                });
                swal({
      					title: "Examen creado",
      					text: "de clic en el boton para continuar",
      					type: "success",
      					showCancelButton: false,
      					confirmButtonColor: "#FF0000",
      					confirmButtonText: "Continuar",
      					cancelButtonText: "No, cancel plx!",
      					closeOnConfirm: false,
      					closeOnCancel: false },

      					function(isConfirm){
      					if (isConfirm)
      					{
      						location.href="../"
      					}
      					});
            }
        })

    }
}
