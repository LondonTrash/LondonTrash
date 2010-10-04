$(document).ready(function(){
	$("#notify").click(function(){
		$("#notifications").dialog({
			modal: true,
			title: "Email and SMS Notification Setup"
		});
	});
});

function notificationSuccess() {
	$("#notifications").dialog("close");
	$('.pop-notice').text("Don't call us, we'll call you.");
	$('.pop-notice').effect('highlight', 2000);
}
function notificationValidation() {
	return($("#subscribe-notifications").validate().form());
}