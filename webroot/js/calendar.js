$(document).ready(function(){
	var month = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
	var current = 9;
	
	/*$('#cal_inner').css('height','220px').css('overflow','hidden');*/
	
	$('#right').click(function(){
		$('.'+month[current]).addClass('precal');
		current = current+1;
		if(current > 11){
			current = 0;
		}
		$('.'+month[current]).removeClass('precal');
		
		$('h4').replaceWith('<h4>'+month[current]+'</h4>');
		
		return false;
	});
	
	$('#left').click(function(){
		
		$('.'+month[current]).addClass('precal');
		$('.'+month[current-1]).removeClass('precal');
		current = current-1;
		if(current < 0){
			current = 11;
		}
		return false;
	});
});