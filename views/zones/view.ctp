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
		if ($this->Time->isToday($pickup)){
			$next_pickup = "7:00am Today!"; 
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $pickup);
		}else if ($this->Time->isTomorrow($pickup)){
			$next_pickup = "Tomorrow!";
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $pickup);
		}else if(date('z', $pickup) - date('z') < 7){
			$next_pickup = "Next ".date('l',$pickup);
			$next_pickup_details = date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $pickup);
		}else {
			$next_pickup = date('F j<\s\u\p\>S\<\/\s\u\p\>', $pickup);
			$next_pickup_details = "";
		}
	?>
	<small>Your Next Pickup is:</small>
	<h2><?php echo $next_pickup; ?></h2>
	<span id='r-date'><?php echo $next_pickup_details; ?></span>
</div>
<div id="calendar" class="hidden">

</div>
<ol id="callist">
	<?php foreach($schedule as $date) { ?>
		<li class="calday <?php echo $date['type'] == "pickup" ? "pickup" : "special"; ?> <?php echo date('FY',$date['start_date']); ?>">
			<strong class="<?php echo date('F', $date['start_date']); ?>"><?php echo date('M', $date['start_date']); ?></strong>
			<span class="day"><?php echo date('j', $date['start_date']); ?></span>
		</li>
		<?php if (date('Y-m-d',$date['start_date']) != date('Y-m-d',strtotime(date('Y-m-d H:i:s',$date['end_date'])." -1 seconds"))) { ?>
			<?php /**/ echo date('Y-m-d', $date['start_date']) . " => " . date('Y-m-d',strtotime(date('Y-m-d H:i:s',$date['end_date'])." -1 seconds")); ?>
			<?php $d = strtotime(date('Y-m-d', $date['start_date'])." +1 day"); while($d < strtotime(date('Y-m-d H:i:s',$date['end_date'])." -1 seconds")) { ?>
				<li class="calday <?php echo $date['type'] == "pickup" ? "pickup" : "special"; ?> <?php echo date('FY',$d); ?>">
					<strong class="<?php echo date('F', $d); ?>"><?php echo date('M', $d); ?></strong>
					<span class="day"><?php echo date('j', $d); ?></span>
				</li>
				<?php $d = strtotime(date('Y-m-d', $d)." +1 day"); ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<li>
		<div class="clear"></div>
		<div id="legend">
			<small><span class="pickup"></span>Regular Pickup</small>
			<small><span class="special"></span>Special Pickup</small>
		</div>
	</li>
</ol>
<div class="grid_6">  
	<span id="holiday" class="pop-notice">Email and SMS notifications are coming soon.</span>
	<a id="notify">Email Notifications</a> 
	<a href="#" class="ical">iCal Feed (<?php echo $formattedZone; ?>)</a>
	<a href="#" class="ical">Add to gCal (<?php echo $formattedZone; ?>)</a>

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
