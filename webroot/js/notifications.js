function notify_prepForm(){ 
	$("#update-signup").validate({
		submitHandler: function(form) {
			$(form).ajaxSubmit({success: 
				function(html){ 
					$.fn.colorbox({
						html: html,
						open: true,
						scrolling: false
					});
					$.fn.colorbox.resize({width: 400, height: 150});
				}
			});
		},
		errorClass: 'form-error',
		messages: {
			'data[UpdateSignup][email]': {
				email: 'Invalid Email',
				required: 'Required'
			}
		}
	});
}