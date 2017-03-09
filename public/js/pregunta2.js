$(document).ready(function () {
	var preg = 1;
	$('#Nop').hide();
	$('#NopC').hide();
	//$('#botonG').hide();
	$('#guardar').hide();
	$('#VP').hide();
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

		if ($(this).val() == 'M') {
			$('#Nop').show();
			$('#botonG').hide();
			$('#NopC').hide();
			$('#Col1').remove();
			$('#Col2').remove();
			$('#btnNex').remove();
			
		} 
		else {		
		//if ($(this).val() == 'M2') {
			$('#Nop').show();
			$('#botonG').hide();
			$('#NopC').hide();
			$('#Col1').remove();
			$('#Col2').remove();
			$('#btnNex').remove();
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
		if (tip == 'M') {
			Multiple();
		} else if (tip == 'A') {
			Abierta();
			$('#botonG').show();
		} 
		$('.dvop').remove();
		$('#Col1').remove();
		$('#Col2').remove();
		$('#btnNex').remove();
		preg++;

	});

	$('#guardar').click(function () {
		var ant = 0;
		var NoPregunta = 1;
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
		
		console.log($('#exm').html());

	});

	
	function Multiple() {
		var pregunta = $('#pregunta').val();
		var vop = [];
		$('#opcion').children().children('input:text').each(function () {
			vop.push($(this).val());
		});

		var div = '<div class="form-group" id="dvP' + preg + '"><button class="btn btn-danger btn-sm col-sm-offset-11" title="' + preg + '"><span class="glyphicon glyphicon-remove"></span></button> <div class="form-group"><label class="control-label lp"> ' + pregunta + ' </label> <div class="form-inline"><div class="form-group text-center">';
		$.each(vop, function (key, val) {
			div += '<label class="control-label"> <input type="hidden" name="preg'+ preg +'" value="'+ pregunta +'"> <input type="radio" class="inp form-control" title="' + preg + '" name= "Multix'+ preg +'" value="'+val+'">' + val +'&nbsp&nbsp</label>'
		});
		div += '</div></div></div></div>';
		$('#exm').append(div);
	}


	function Multiple2() {
		var pregunta = $('#pregunta').val();
		var vop = [];
		$('#opcion').children().children('input:text').each(function () {
			vop.push($(this).val());
		});

		var div = '<div class="form-group" id="dvP' + preg + '"><button class="btn btn-danger btn-sm col-sm-offset-11" title="' + preg + '"><span class="glyphicon glyphicon-remove"></span></button> <div class="form-group"><label class="control-label lp"> ' + pregunta + ' </label> <div class="form-inline"><div class="form-group text-center">';
		$.each(vop, function (key, val) {
			div += '<label class="control-label"> <input type="checkbox" class="inp form-control" title="' + preg + '" name= "Mult'+ preg +'[]" value="'+val+'">' + val + '&nbsp&nbsp</label>'
		});
		div += '</div></div></div></div>';
		$('#exm').append(div);
	}
	
	$('#guardar').click(function()
	{
		$.ajax({
			url: 'exa.php',//algun archivo php donde hagas lo que se te antoje
			type: "post",//es como mandar cun formulario por el metdo post
			data: $("#Formulario").serialize()			
		});
	});



});