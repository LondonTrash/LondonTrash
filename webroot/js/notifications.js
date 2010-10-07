$(document).ready(function(){
	$("#notify").colorbox({
		width: "525px",
		inline: true,
		href: "#update-signup",
		overlayClose: false,
		scrolling: false
	});
	
  $("form#update-signup").validate({
	  errorClass: 'formerror'
  });
});

function notificationSuccess() {
	$("#notifications").colorbox.close();
	$('.pop-notice').text("Don't call us, we'll call you.");
	$('.pop-notice').effect('highlight', 2000);
}