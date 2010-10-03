$(document).ready(function(){
	$("#notify").click(function(){
		$("#notifications").dialog({
			modal: true,
			title: "Email Notifications"
		});
	});
	
  $("form#update-signup").validate({
	  errorClass: 'formerror'
  });
});

function notificationSuccess() {
	$("#notifications").dialog("close");
	$('.pop-notice').text("Don't call us, we'll call you.");
	$('.pop-notice').effect('highlight', 2000);
}