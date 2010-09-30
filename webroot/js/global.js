//~ The global file for printing and removing text on input boxes depending on focus

$(document).ready(function() {
	$("input[type=text]").each(function() {
		if ($(this).attr("title").length > 0) {
			if ($(this).val().length == 0) {
				$(this).css('color', '#999999');
				$(this).val($(this).attr("title"));
			}
			$(this).focus(function() {
				$(this).css('color', '#000000'); 
				var text = $(this).val(); 
				if(text == $(this).attr("title")) { 
					$(this).val(""); 
				}
			});
			$(this).blur(function() {
				var address = $("#SearchAddress").val(); 
				if ($(this).val() == "") { 
					$(this).css('color', '#999999');
					$(this).val($(this).attr("title")); 
				}
			});
		}
	}); 	
});
