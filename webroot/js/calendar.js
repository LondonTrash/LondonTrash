$(document).ready(function(){
	var month = new Array('October 2010','November 2010','December 2010','January 2011','February 2011','March 2011','April 2011','May 2011','June 2011','July 2011','August 2011','September 2011');
	var monthstamp = new Array('1287100800','1289779200','1292371200','1295049600','1297728000','1300147200','1302825600','1305417600','1308096000','1310688000','1313366400','1316044800');
	var current = 0;
		
	$('#right').click(function(){
		current = current+1;
		if (month[current] == undefined){
			current = month.length-1;
		}
		$.ajax({
   			type: "POST",
   			url: "#",
   			data: "calendar=true&timestamp="+monthstamp[current],
   			success: function(msg){
     			$('#cal_inner').replaceWith('<div id="cal_inner">'+msg+'</div>');
				$('h4').replaceWith('<h4>'+month[current]+'</h4>');
		
   			}
 		});
 		return false;	
	});
	
	$('#left').click(function(){
		current = current-1;
		if (month[current] == undefined){
			current = 0;
		}
		$.ajax({
   			type: "POST",
   			url: "#",
   			data: "calendar=true&timestamp="+monthstamp[current],
   			success: function(msg){
     			$('#cal_inner').replaceWith('<div id="cal_inner">'+msg+'</div>');
				$('h4').replaceWith('<h4>'+month[current]+'</h4>');
   			}
 		});	
   		return false;
	});
});