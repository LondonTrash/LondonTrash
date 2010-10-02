$(document).ready(function(){
	if($("#calendar").length > 0) {
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
		var day = $(this).text();
		$(".ui-state-default").each(function(){
			if($(this).text() == day) {
				$(this).css("border", "1px dashed red"); //addClass(;
			}
		});
	});
}
