$(document).ready(function(){ 
	
	$('input[type=checkbox]').tzCheckbox({labels:['Enable','Disable']});
	
	$('.selecctall').click(function(){
				
		if($(this).val()=="Si"){ 	
		
			$('.tzCheckBox').addClass('checked'); 
			$('.tzCheckBox').find('.tzCBContent').html('Si'); 
			$("#checkbox1").attr('checked', true);
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');      
			$(this).val('No'); 
		} 
		else { 
			$('.tzCheckBox').removeClass('checked'); 
			$('.tzCheckBox').find('.tzCBContent').html('No'); 
			$("#checkbox1").attr('checked', false);
			$(this).addClass('btn-success');
			$(this).removeClass('btn-danger'); 
			$(this).val('Si'); 
		} 
		
	}); 
	

});