$(document).ready(function(){
	if($("#calendar").length > 0) {
		$("#callist").hide(); //Hide the Non-JS calendar
		$("#calendar").show(); //Show the JS calendar
		$("#calendar").datepicker({
			onChangeMonthYear: function(year, month, inst) {
				updatecal();
			}
		});
		$("#calendar").click(function(){
			updatecal();
		}).click();
	}
});
function updatecal(){
	$(".pickup."+$(".ui-datepicker-month").text()+$(".ui-datepicker-year").text()).each(function(){
		var day = $(this).children(".day").text();
		console.log(day);
		$(".ui-state-default").each(function(){
			if($(this).text() == day) {
				$(this).css("border", "1px dashed red"); //addClass(;
			}
		});
	});
}
