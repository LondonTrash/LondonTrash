<?php echo $this->Html->script('jquery-ui-1.8.5.custom.min', array('inline' => false)); ?>
<?php echo $this->Html->css('/js/jquery-ui-1.8.5.custom', null, array('inline' => false)); ?>
<?php echo $this->Html->script('notifications', array('inline' => false)); ?>
<?php echo $this->Html->script('validate/jquery.validate.pack', array('inline' => false)); ?>
<?php echo $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
  $("#subscribe-notifications").validate({
	  errorClass: 'formerror'
  });
});
JAVASCRIPT
, array('inline' => false)); ?>


<?php

/**
 * Ajax call for loading another month
 *
 */
 
if (isset($_POST['calendar']) && isset($_POST['timestamp'])){
	show_Calendar($_POST['timestamp'], $calendar);
	exit;
}

/**
 * Prints out the full month of dates
 * including appropriate classes
 * for the month that contains the date (timestamp) passed
 * 
 */
 

function show_Calendar($timestamp, $calendar){
	//echo strtotime('1 november 2010');
	//echo ' '.date('d-m-Y',$timestamp);
	//what is the first day of the month
	$daysin = date('d',$timestamp);
	$daysin--;
	$daysin = '-'.$daysin.' days';
	$firstday = strtotime($daysin, $timestamp);
	
	//what is the first sunday of that week?
	$sunday = date('w',$firstday);
	$sunday = '-'.$sunday.' days';
	$sunday = strtotime($sunday,$firstday);
	
	//what is the last day of the month?
	$lastday = strtotime('+1 month',$firstday);
	$lastday = strtotime('-1 day',$lastday);
	
	//and the saturday of that week
	$saturday = 6 - date('w',$lastday);
	$saturday = '+'.$saturday.' days';
	$saturday = strtotime($saturday,$lastday);
	
	$i = 0;
	$return = '';
	foreach($calendar as $day=>$date){		
		if ($day > $saturday){
			return $calendar;
		//}else if ($sunday <= $day){ TODO: why doesn't this work!?
		}else if (($sunday-$day) < 100000){
			/*if (1==true){
			echo date('d-m-Y',$day);
			echo '<br />';
			}else{*/
			echo '<span class="';
		
			switch($i%7) {
				case 0:
					echo "sun ";
					break;
				case 1:
					echo "mon ";
					break;
				case 2:
					echo "tue ";
					break;
				case 3:
					echo "wed ";
					break;
				case 4:
					echo "thu ";
					break;
				case 5:
					echo "fri ";
					break;
				case 6:
					echo "sat ";
			}
		
			if(date('m',$timestamp) != date('m',$day)){
				echo "precal ";
			}	
		
			echo  date('F',$day)." ";	
		
			//style todays date
			if(date('dmY') == date('dmY', $day)){
				echo "today ";	
			}
		
			/**
			 * Now classes for events
			 */
			if(isset($date['event']) && is_array($date['event'])){
				if ($date['event']['type'] == 'pickup'){
					echo "pickup {$date['event']['type']} ";
				}
				
				/*
				if ($date['event']['type'] != 'pickup'){
					echo "special ";
					if ($date['event']['end_date'] != $date['event']['end_date'] && $date['event']['start_date'] == $timestamp){
						for ($i=$timestamp; $i<=$date['event']['end_date']; $i=strtotime ('+1 day',$i )){
							$calendar[$i]['event'] = $date['event'];
						}				}
				}*/
			}
			
			echo '">';
			echo date('j',$day); 	
			print "</span>\n\t\t\t";
			//}
		}
		$i++;

	}
?>
<br style="clear:both" />
<?php
	
}

echo $this->Html->script('calendar');

$address = $this->Session->read('address');

?>

<div class="results mod">
	<div class="address"><?php echo $address; ?> (<?php echo $formattedZone; ?>)<?php echo $this->Html->link("Change", array('controller' => 'searches', '?' => array('a' => $address))); ?></div>
	<div class="clear"></div>
	<small>Your Next Pickup is:</small>
<?php
	
	 //next event in the schedule
	$timestamp = $schedule[0]['start_date'];

	if ($this->Time->isToday($timestamp)){
		echo "<h2>7:00am Today!</h2>"; 
		echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if ($this->Time->isTomorrow($timestamp)){
			echo "<h2>Tomorrow!</h2>";
			echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if(date('z', $timestamp) - date('z') < 7){
		echo '<h2>Next '.date('l',$timestamp).'</h2>';
		echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else {
		echo '<h2>'.date('F j<\s\u\p\>S\<\/\s\u\p\>', $timestamp).'</h2>';	
	}
?>
	
</div>
<div id="calendar"> 
	<div id="head" > 
		<div class="arrow"><a href="" id="left">&lt;</a></div>  <h4><?php echo date('F Y', $timestamp); ?> </h4> <div class="arrow"><a href="" id="right">&gt;</a></div>
	</div>
	<span class="dotw">S</span>
	<span class="dotw">M</span> 
	<span class="dotw">T</span> 
	<span class="dotw">W</span> 
	<span class="dotw">T</span> 
	<span class="dotw">F</span> 
	<span class="dotw">S</span>
	<div id="cal_inner">
		<?php show_Calendar($timestamp, $calendar) ?>
	</div><!-- #cal_inner -->
</div>
<div class="grid_6">  
	<span id="holiday" class="pop-notice">Email and SMS notifications are coming soon.</span>
	<a id="notify">Notify Me!</a> 
	<?php echo $this->Html->link('iCal Feed (' . $formattedZone . ')', $webcal_url, array('class' => 'ical')); ?>
	<?php echo $this->Html->link('Add to gCal (' . $formattedZone . ')', $gcal_url, array('class' => 'ical')); ?>
	
<div class="clear"></div>
<hr />
<!--h4>Recycling</h4>
<select>
<option value="">Item</option>
</select>
<h4>Other Reuse and Recycling Options</h4>
<select>
<option value="">Item</option>
</select-->

<br class="clear" />
<a href="" class="report"> Report an Error</a>
<br class="clear" />
&nbsp;<br class="clear" />
</div>
<div class="hidden" id="notifications">
	<?php
	    echo $this->Form->create('Subscriber', array('id' => 'subscribe-notifications', 'url' => '#'));
			echo $this->Form->radio('Provider.protocol_id', array('1' => 'Email'), array('hiddenField' => false, 'default' => 1));
	    echo $this->Form->input('Subscriber.contact_email', array('label' => 'Email', 'class' => 'required email'));
			echo $this->Form->radio('Provider.protocol_id', array('2' => 'SMS'), array('hiddenField' => false));
	    echo $this->Form->input('Subscriber.contact_phone', array('label' => 'Phone', 'class' => 'required email'));
			echo $this->Form->input('Subscriber.provider_id');
	    echo $this->Form->hidden('Subscriber.zone_id', array('value' => $zone_id));
			
			// For multiple notifications, custom notifications, etc.
			// echo $this->Form->input('Notification.0.delay_time', array('maxlength' => 2));
			// echo $this->Form->input('Notification.0.delay_unit', array('type' => 'select', 'options' => $delay_unit)); // hours, days
			// echo $this->Form->input('Notification.0.notification_type', array('type' => 'select', 'options' => $notification_type)); // regular, special, both
			
	    echo $this->Js->submit('Let me know!', array(
	    	'url' => $this->Html->url(array('controller' => 'notifications', 'action' => 'add')),
				'success' => 'notificationSuccess()'
	    ));
			echo $this->Form->end();
	?>
</div>