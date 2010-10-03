$(document).ready(function(){
	if($("#calendar").length > 0) {
		$("#callist").hide(); //Hide the Non-JS calendar
		$("#calendar").show(); //Show the JS calendar
		$("#calendar").datepicker({
			minDate: -0,
			maxDate: "+"+$("#callist").attr("rel"),
			dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
			onChangeMonthYear: function(year, month, inst) {
				updatecal();
			}
		});
		$("#calendar").click(function(){
			updatecal();
		}).click();
		$("#calendar").append('<div id="legend"><small><span class="pickup"></span>Regular Pickup</small><small><span class="special"></span>Special Pickup</small></div>');
	}
});
function updatecal(){
	$("."+$(".ui-datepicker-month").text()+$(".ui-datepicker-year").text()).each(function(){
		var pickuptype;
		var pickuptooltip = $(this).attr("title");
		if($(this).hasClass("pickup")) {
			pickuptype = "pickup";
		} else {
			pickuptype = "special";
		}
		var day = $(this).children(".day").text();
		$(".ui-state-default").each(function(){
			if($(this).text() == day) {
				$(this).addClass(pickuptype);
				$(this).attr("title", pickuptooltip);
			}
		});
	});
}
