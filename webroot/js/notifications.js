$(document).ready(function(){
	$("#notify").click(function(){
		$("#notifications").dialog({
			modal: true,
			title: "Email Notifications"
		});
	});
	
	$("#submit").click(function(){

			$("#notifications").dialog("close");

	});
});