<?php echo $this->Html->script('jquery-ui-1.8.5.custom.min', array('inline' => false)); ?>
<?php echo $this->Html->css('/js/colorbox/colorbox', null, array('inline' => false)); ?>
<?php echo $this->Html->script('colorbox/jquery.colorbox-min', array('inline' => false)); ?>
<?php echo $this->Html->script('validate/jquery.validate.pack', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.form', array('inline' => false)); ?>

<?php echo $this->Html->script('notifications', array('inline' => false)); ?>
<?php echo $this->Html->script('report_problem', array('inline' => false)); ?>
<?php echo $this->Html->script('calendar', array('inline' => false)); ?>
<?php
$notifyUrl = $this->Html->url(array(
	'controller' => 'subscribers',
	'action' => 'add',
	$this->params['pass'][0]
));
$reportUrl = $this->Html->url(array(
	'controller' => 'problem_reports',
	'action' => 'add'
));
?>
<?php
echo $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
	$("#notify").colorbox({
		width: "525px",
		href: "{$notifyUrl}",
		overlayClose: false,
		scrolling: false
	},
	notify_prepForm);
	$("#report").colorbox({
		width: "525px",
		href: "{$reportUrl}",
		overlayClose: false,
		scrolling: false
	},
	report_prepForm);
});
JAVASCRIPT
, array('inline' => false));
?>

<div class="results mod">
	<div class="address">
		<?php echo $this->Session->read('address'); ?> (<?php echo $formattedZone; ?>)
		<?php echo $this->Html->link("Change", array('controller' => 'searches', 'action' => 'clear', $this->Session->read('address'))); ?>
	</div>
	<?php
		//next regular pickup in the schedule
		
		$dateFormat = 'F j<\s\u\p\>S\<\/\s\u\p\>, Y';
		$dowDateFormat = 'l, ' . $dateFormat;
		$longDate = date($dateFormat, $pickup);
		$longerDate = date($dowDateFormat, $pickup);
		
		// today
		if ($this->Time->isToday($pickup)) {
			$next_pickup = "7:00am Today!"; 
			$next_pickup_details = $longerDate;
		// tomorrow
		} else if ($this->Time->isTomorrow($pickup)) {
			$next_pickup = "Tomorrow!";
			$next_pickup_details = $longerDate;
		// this week, i.e. "This Friday"
		} else if (date('W', $pickup) == date('W')) {
			$next_pickup = "This " . date('l', $pickup);
			$next_pickup_details = $longDate;
		// next week, i.e. "Next Tuesday"
		} else if (date('W', $pickup) - date('W') == 1) {
			$next_pickup = "Next " . date('l', $pickup);
			$next_pickup_details = $longDate;
		// two weeks or more away
		} else {
			$next_pickup = $longerDate;
			$next_pickup_details = "";
		}
	?>
	<small>Your Next Regular Pickup is:</small>
	<div class="clear"></div>
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
	<?php echo $this->Html->link('Notify Me!', $notifyUrl, array('id' => 'notify')); ?>
	
	<?php echo $this->Html->link('iCal Feed (' . $formattedZone . ')', $webcal_url, array('class' => 'ical')); ?>
	<?php echo $this->Html->link('Add to gCal (' . $formattedZone . ')', $gcal_url, array('class' => 'ical')); ?>

<div class="clear"></div>
<hr />

<?php echo $this->Html->link('Report an Error', $reportUrl, array('id' => 'report')); ?>
</div>