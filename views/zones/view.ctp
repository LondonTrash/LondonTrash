<?php echo $this->Html->script('jquery-ui-1.8.5.custom.min', array('inline' => false)); ?>
<?php echo $this->Html->css('/js/jquery-ui-1.8.5.custom', null, array('inline' => false)); ?>
<?php echo $this->Html->script('notifications'); ?>
<?php echo $this->Html->script('calendar'); ?>

<div class="results mod">
	<div class="address">
		<?php echo $this->Session->read('address'); ?> (<?php echo $formattedZone; ?>)
		<?php echo $this->Html->link("Change", array('controller' => 'searches', '?' => array('a' => $this->Session->read('address')))); ?>
	</div>
	<br class="clear" />
	<?php
		//next event in the schedule
		$timestamp = $schedule[0]['start_date'];
		
		if ($this->Time->isToday($timestamp)){
			$next_pickup = "7:00am Today!"; 
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp);
		}else if ($this->Time->isTomorrow($timestamp)){
			$next_pickup = "Tomorrow!";
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp);
		}else if(date('z', $timestamp) - date('z') < 7){
			$next_pickup = "Next ".date('l',$timestamp);
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp);
		}else {
			$next_pickup = date('F j<\s\u\p\>S\<\/\s\u\p\>', $timestamp);
			$next_pickup_details = "";
		}
	?>
	<small>Your Next Pickup is:</small>
	<h2><?php echo $next_pickup; ?></h2>
	<span id='r-date'><?php echo $next_pickup_details; ?></span>
</div>
<div id="calendar"> 
</div>
<div class="grid_6">  
	<span id="holiday" class="pop-notice">Email and SMS notifications are coming soon.</span>
	<a id="notify">Email Notifications</a> 
	<a href="#" class="ical">iCal Feed (Downtown W)</a>
	<a href="#" class="ical">Add to gCal (Downtown W)</a>

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
	<p>Enter your email address
	<input name="name" id="name" title="Name" /><br />
	<input name="email" type="email" id="email" title="your@email.com" /><br />
	<input type="button" id="submit" name="submit" value="Let me know!" />
</div>