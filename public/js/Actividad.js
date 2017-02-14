$(document).ready(function () {
	var preg = 1;
	$('#Nop').show();
	$('#NopC').hide();
	$('#botonG').hide();
	$('#Mul').hide();
	$('#guardar').hide();
	var edit = true;

	$('#VP').click(function () { //vista previa o editar

		if (edit) {
			$(this).text("Editar");
			$(this).addClass('LabelEdit');
			$('#menu').hide();
			$('#2p').removeClass('col-sm-offset-1');
			$('#2p').addClass('col-sm-offset-2');
			$('#exm').children().children('.btn').hide();

			var numPreg = 1;
			$('#exm').children().children().children('.lp').each(function () {
				$(this).before('<label class="lnp">' + numPreg + '.- </label>');
				numPreg++;
			});

		} else {
			$(this).text("Vista previa");
			$(this).removeClass('LabelEdit');
			$('#menu').show();
			$('#2p').removeClass('col-sm-offset-2');
			$('#2p').addClass('col-sm-offset-1');
			$('#exm').children().children('.btn').show();
			$('.lnp').remove();

		}
		edit = !edit;
	});

	$('#okop').click(function () { //multiple
		var oo = $('#nuop').val();
		var l = 97;

		$('.dvop').remove();
		for (i = 0; i < oo; i++) {
			let = String.fromCharCode(l);
			$('#opcion').append('<div class="form-group dvop"><label class="whiteClassThin"> Opcion ' +
				let +' : </label>' +
				'<input type="text" class="form-control"></div>');
			l++;
		}
		$('#botonG').show();

	});


	$('#okopC').click(function () { //columnas
		var oo = $('#nuopC').val();
		var l = 97;

		$('.dvop').remove();
		$('#opcion').append('<div id="Col1"></div>');
		for (i = 0; i < oo; i++) {
			let = String.fromCharCode(l);
			$('#Col1').append('<div class="form-group dvop"><label> Opcion ' +
				let +' : </label>' +
				'<input type="text" class="form-control"></div>');
			l++;
		}

		$('#opcion').append('<div id="Col2"></div>');
		$('#Col2').hide();
		for (i = 0; i < oo; i++) {
			$('#Col2').append('<div class="form-group dvop"><label> Definicion ' + (i + 1) + ' : </label>' +
				'<input type="text" class="form-control"></div>');
			l++;
		}
		$('#opcion').append('<div class="form-group-sm "> <button class="btn btn-success btn-sm" id="btnNex"> Continuar <span class=" glyphicon glyphicon-chevron-right"></span></button></div>');

	});

	$('#opcion').on('click', '#btnNex', function () {
		$('#btnNex').hide();
		$('#botonG').show();
		$('#Col2').show();
		$('#Col1').hide();
	});


	$('#exm').on('click', '.btn', function () { //eliminar pregunta
		$('#dvP' + $(this).attr('title')).remove();
	});

	$('#botonG').click(function () { //agregar Pregunta

		Multiple();
		$('#guardar').show(1500);
		$('.dvop').remove();
		$('#Col1').remove();
		$('#Col2').remove();
		$('#btnNex').remove();
		preg++;

	});

	$('#guardar').click(function () {
		var ant = 0;
		var NoPregunta = 1;
		var div2 = '<input type="hidden" id="Total" value="'+(preg-1)+'">';
		$('#exm').append(div2);

		$('#exm').find('.inp').each(function () {
			var title = $(this).attr('title');

			if (title != ant && ant > 0) {
				NoPregunta++;
			}
			if (title == ant && $(this).attr('type') == 'text') {
				NoPregunta++;
			}
			$(this).attr('name', NoPregunta);
			ant = title;
		});

		$.ajax({
				url: 'guardarActividad.php',
				type: "post",
				dataType: 'json',
				data: {
					idCurso: $('#IDTema').val(),
					examen: $('#exm').html()
				}
			}).done(function (request) {
				//console.log(request);//puuum!! sql
				swal({
						title: "La Actividad ha sido creada",
						text: "de clic en el boton para continuar",
						type: "success",
						showCancelButton: false,
						confirmButtonColor: "#00FF00",
						confirmButtonText: "Continuar",
						cancelButtonText: "No, cancel plx!",
						closeOnConfirm: false,
						closeOnCancel: false },

						function(isConfirm){
						if (isConfirm)
						{
							location.href="ActDADinstructor.php"
						}
					});

			}).fail(function (request) {
				console.log(request);//por que trono
			});

	});


	function Multiple() {
		var pregunta = $('#pregunta').val();
		var vop = [];
		$('#opcion').children().children('input:text').each(function () {
			vop.push($(this).val());
		});

		var div = '<div id="dvP' + preg + '"><h3> ' + pregunta + ' </h3><br><div id="daddy" class="dad'+preg+'">';
		$.each(vop, function (key, val) {
			div += '<div> <div id="'+val.toUpperCase()+'">' + val + '</div></div>'
		});
		div += '</div><div class="dropzone'+preg+'" id="dropzone"><center><h2 class="whiteClass2">Coloque aquí la respuesta correcta</h2></center></div><div class="whiteClassThin" id="Respuesta'+ preg +'">Respuesta:&nbsp;<input type="text" class="form-control inp" title="' + preg + '" style="resize:none;" name="'+preg+'"></div></div>';
		$('#exm').append(div);
	}
});
