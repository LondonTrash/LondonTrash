function notify_prepForm(){
	$.validator.addMethod("phone", function(value, element) {
		// validate true if field is left empty
		if (value.length == 0) { return true; }

		// remove all non-numeric characters
		var phone = value.replace(/[^0-9]+/g, '');
		
		// if first digit is 1, remove it when validating
		if (phone.indexOf('1') == 0) {
			phone = phone.substr(1);
		}
		
		// if cleaned-up phone number is 10 digits, validate true
		return (phone.length == 10);
	}, 'Please enter a 10-digit phone number or leave the field blank.');
	
	$.validator.addMethod('required_group', function(value, element) {
		var $module = $(element).closest('form');
		return $module.find('.required_group:filled').length;
	}, 'Please enter either your email address or cell phone number to continue.');
		
	// overwrite default messages
	$.extend($.validator.messages, {
		email: "Please enter a valid email address or leave the field blank."
	});
	
	$("#colorbox #subscriber").validate({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				beforeSubmit:
					function(){
						var opts = {
							position: 'center',
							hide: true,
							img: '../img/spinner.gif',
							height: 16,
							width: 16,
							zIndex: 9001
						};
						$("#SubscriberSubmit").spinner(opts);
					},
				success: 
					function(html){ 
						$("#SubscriberSubmit").spinner('remove');
						$.fn.colorbox({
							html: html,
							open: true,
							scrolling: false
						});
						$.fn.colorbox.resize({width: 400, height: 150});
					}
			});
		},
		groups: {
			contactInfo: 'data[Subscriber][email] data[Subscriber][phone]'
		},
		rules: {
			'data[Subscriber][provider_id]': {
				// only try to check provider when phone is filled in
				required: "#SubscriberPhone:filled"
			}
		},
		messages: {
			'data[Subscriber][provider_id]': {
				required: 'Please choose your provider from the dropdown.'
			}
		},
		errorClass: 'form-error',
		errorLabelContainer: $("#subscriber div.label-container")
	});
}