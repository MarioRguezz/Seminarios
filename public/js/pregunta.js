$(document).ready(function () {
	var preg = 1;
	$('#Nop').hide();
	$('#NopC').hide();
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


	$('input[name=tipoPregunta]').click(function () { //tipo pregunta mostrar opciones

		if ($(this).val() == 'A') {
			$('#Nop').hide();
			$('#botonG').show();
			$('.dvop').remove();
			$('#NopC').hide();
			$('#Col1').remove();
			$('#Col2').remove();
			$('#btnNex').remove();
		} else if ($(this).val() == 'M') {
			$('#Nop').show();
			$('#botonG').hide();
			$('#NopC').hide();
			$('#Col1').remove();
			$('#Col2').remove();
			$('#btnNex').remove();
		} else {
			$('#NopC').show();
			$('#Nop').hide();
			$('#botonG').hide();
			$('.dvop').remove();
		}
	});


	$('#okop').click(function () { //multiple
		var oo = $('#nuop').val();
		var l = 97;

		$('.dvop').remove();
		for (i = 0; i < oo; i++) {
			let = String.fromCharCode(l);
			$('#opcion').append('<div class="form-group dvop"><label> Opcion ' +
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

		var tip = $('input[name=tipoPregunta]:checked').val();
		if (tip == 'A') {
			Abierta();
		} else if (tip == 'M') {
			Multiple();
			$('#botonG').hide();
		} else {
			Columnas();
			$('#botonG').hide();
		}
		$('.dvop').remove();
		$('#Col1').remove();
		$('#Col2').remove();
		$('#btnNex').remove();
		preg++;
		$('#guardar').show(1000);

	});

	//*
	$('#guardar').click(function () {
		var ant = 0;
		var NoPregunta = 1;
		$('#exm').children().children('.btn').remove();
		
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
				url: 'guardarExamen.php',
				type: "post",
				dataType: 'json',
				data: {
					//idCurso: 1,
					idCurso: $('#IDTema').val(),
					examen: $('#exm').html()
				}
			}).done(function (request) {
				console.log(request);//puuum!! sql
				//alert('El examen ha sido creado');					
				//location.href='ExamenInstructor.php'
				swal({   
					title: "El examen ha sido creado",   
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
						location.href="ExamenInstructor.php"	     
					} 
					});
			}).fail(function (request) {
				console.log(request);//por que trono 				
				//alert('No está pasando nada');
				alert('Hubo un problema, contacte con el administrador del sitio');
				window.close();
			});
		
	});
	//*/

	function Abierta() {
		var pregunta = $('#pregunta').val();
		$('#exm').append('<div class="form-group" id="dvP' + preg + '">' +
			'<button class="btn btn-danger btn-sm col-sm-offset-11 quitar" title="' + preg + '"><span class="glyphicon glyphicon-remove"></span></button> <div class="form-group"><label class="control-label lp"> ' + pregunta + ' </label>' + '<br><br><input type="text" class="form-control inp" title="' + preg + '" style="resize:none;" name="'+preg+'"></div></div>');
	}

	function Multiple() {
		var pregunta = $('#pregunta').val();
		var vop = [];
		$('#opcion').children().children('input:text').each(function () {
			vop.push($(this).val());
		});

		var div = '<div class="form-group" id="dvP' + preg + '"><button class="btn btn-danger btn-sm col-sm-offset-11 quitar" title="' + preg + '"><span class="glyphicon glyphicon-remove"></span></button> <div class="form-group"><label class="control-label lp"> ' + pregunta + ' </label> <div class="form-inline"><div class="form-group text-center">';
		$.each(vop, function (key, val) {
			div += '<label class="control-label"> <input type="radio" class="inp" title="' + preg + '" name="'+preg+'" value="'+val+'">' + val + '&nbsp&nbsp</label>'
		});
		div += '</div></div></div></div>';
		$('#exm').append(div);
	}


	function Columnas() {
		var pregunta = $('#pregunta').val();
		var l = 97;

		var col1 = [];
		$('#Col1').children().children('input:text').each(function () {
			col1.push($(this).val());
		});
		var col2 = [];
		$('#Col2').children().children('input:text').each(function () {
			col2.push($(this).val());
		});

		var div = '<div class="form-group" id="dvP' + preg + '"><button class="btn btn-danger btn-sm col-sm-offset-11" title="' + preg + '"><span class="glyphicon glyphicon-remove"></span></button><div class="form-group"><label class="control-label lp"> ' + pregunta + ' </label></div><div class="col-sm-5 col-sm-offset-1">';

		$.each(col1, function (key, val) {
			let = String.fromCharCode(l);
			div += '<div class="form-group text-left"><label class="control-label" >' +
				let +') ' + val + ' &nbsp</label></div>';
			l++;
		});

		div += '</div><div class="col-sm-6">';

		$.each(col2, function (key, val) {
			div += '<div class="form-group text-left"><div class="col-sm-3"><input type="text" title="' + preg + '" class="form-control inp"></div><div class="col-sm-9"><label class="control-label">' + val + ' &nbsp </label></div></div>';
		});

		div += '</div></div></div>';
		$('#exm').append(div);
	}



});