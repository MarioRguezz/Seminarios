(function($){
	$.fn.tzCheckbox = function(options){
		
		// Default On / Off labels:
		options = $.extend({
			labels : ['ON','OFF']
		},options);
		
		return this.each(function(){
			var originalCheckBox = $(this),
				labels = [];

			// Checking for the data-on / data-off HTML5 data attributes:
			if(originalCheckBox.data('on')){
				labels[0] = originalCheckBox.data('on');
				labels[1] = originalCheckBox.data('off');
			}
			else labels = options.labels;

			// Creating the new checkbox markup:
			var checkBox = $('<span>',{
				className	: 'tzCheckBox '+(this.checked?'checked':''),
				html:	'<span class="tzCBContent">'+labels[this.checked?0:1]+
						'</span><span class="tzCBPart"></span>'
			});

			// Inserting the new checkbox, and hiding the original:
			checkBox.insertAfter(originalCheckBox.hide());

			checkBox.click(function(){
				checkBox.toggleClass('checked');
				
				var Mat_Alu = $(originalCheckBox).attr("name");
				var ID_Tema = $(originalCheckBox).attr("title");
				console.log(ID_Tema);
				console.log(Mat_Alu);
				//*
				$.ajax({
					url: "habilita.php",
					type: "post",
					data:{	Alu:Mat_Alu,
							Tema:ID_Tema}
					}).done(function(msg)
					{
						console.log(msg);
						//alert('Según que si funcionó');
					}).fail(function (request) {
				console.log(request);//por que trono 				
				//alert('No está pasando nada');
				alert('Hubo un problema, contacte con el administrador del sitio');
			});
				//*/
	
				var isChecked = checkBox.hasClass('checked');
				
				// Synchronizing the original checkbox:
				originalCheckBox.attr('checked',isChecked);
				checkBox.find('.tzCBContent').html(labels[isChecked?0:1]);
			});
			
			// Listening for changes on the original and affecting the new one:
			originalCheckBox.bind('change',function(){
				
				checkBox.click();
				
			});
		});
	};
})(jQuery);