<?php echo $this->Html->script('jquery-ui-1.8.5.custom.min', array('inline' => false)); ?>
<?php echo $this->Html->css('/js/colorbox/colorbox', null, array('inline' => false)); ?>
<?php echo $this->Html->script('colorbox/jquery.colorbox-min', array('inline' => false)); ?>
<?php echo $this->Html->script('validate/jquery.validate.pack', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.form'); ?>

<?php echo $this->Html->script('notifications'); ?>
<?php echo $this->Html->script('calendar'); ?>
<?php $signupUrl = $this->Html->url(array(
	'controller' => 'update_signups',
	'action' => 'add',
	$zone_id)); ?>
<?php
echo $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
	$("#notify").colorbox({
		width: "525px",
		href: "{$signupUrl}",
		overlayClose: false,
		scrolling: false
	},
	prepform);
});
JAVASCRIPT
, array('inline' => false));
?>

<div class="results mod">
	<div class="address">
		<?php echo $this->Session->read('address'); ?> (<?php echo $formattedZone; ?>)
		<?php echo $this->Html->link("Change", array('controller' => 'searches', 'action' => 'clear', $this->Session->read('address'))); ?>
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
<ol id="callist" rel="<?php echo intval(($schedule[count($schedule)-1]['end_date'] - strtotime(date('Y-m-d H:i:s')))/86400); ?>d">
	<?php foreach($schedule as $date) { ?>
		<li class="calday <?php echo $date['type'] == "pickup" ? "pickup" : "special"; ?> <?php echo date('FY',$date['start_date']); ?>" title="<?php echo ucwords($date['type']." ".$date['description']); ?>">
			<strong class="<?php echo date('F', $date['start_date']); ?>"><?php echo date('M', $date['start_date']); ?></strong>
			<span class="day"><?php echo date('j', $date['start_date']); ?></span>
		</li>
		<?php if (date('Y-m-d',$date['start_date']) != date('Y-m-d',strtotime(date('Y-m-d H:i:s',$date['end_date'])." -1 seconds"))) { ?>
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