$(document).ready(function(){
	$("#notify").click(function(){
		$("#notifications").dialog({
			modal: true,
			title: "Email Notifications"
		});
	});
});

function notificationSuccess() {
	$("#notifications").dialog("close");
	$('.pop-notice').text("Don't call us, we'll call you.");
	$('.pop-notice').effect('highlight', 2000);
}