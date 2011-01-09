function notify_prepForm(){
	$.validator.addMethod("phone", function(value, element) {
		// remove all non-numeric characters
		var phone = value.replace(/[^0-9]+/g, '');
		
		// if first digit is 1, remove it when validating
		if (phone.indexOf('1') == 0) {
			phone = phone.substr(1);
		}
		
		// if element is optional and left blank, OR
		// if cleaned-up phone number is 10 digits, validate true
		return (this.optional(element) || phone.length == 10);
	}, 'Please enter a 10-digit phone number or leave the field blank.');
	
	$.validator.addMethod("contactInfo", function() {
		return ($("#SubscriberEmail").val() || $("#SubscriberPhone").val());
	}, 'Please enter either your email address or cell phone number to continue.');
	
	// Associate validation rules with CSS classes
	$.validator.addClassRules({
		email: {
			email: true,
			contactInfo: true
		},
		phone: {
			phone: true,
			contactInfo: true
		}
	});
	
	// overwrite default messages
	$.extend($.validator.messages, {
		email: "Please enter a valid email address or leave the field blank."
	});
	
	$("#colorbox #subscriber").validate({
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
		groups: {
			contactInfo: 'data[Subscriber][email] data[Subscriber][phone]'
		},
		rules: {
			'data[Subscriber][provider_id]': {
				required: function(element) {
					return $(element.form).validate().element("#SubscriberPhone");
				}
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