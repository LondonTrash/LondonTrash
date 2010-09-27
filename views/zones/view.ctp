<?php 
$address = $this->Session->read('address');
?>

<div class="results mod">
	<div class="address"><?php echo $address; ?> (Zone <?php echo $zone;?>)<a href="">Change</a></div>
	<div class="clear"></div>
	<small>Your Next Pickup is:</small>
<h2>
<?php 
	 //real date
	//$timestamp = $schedule[0]['start_date'];
	
	//today
	$timestamp = mktime();
	
	//tomorrow:
	//$timestamp = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
	
	if ($this->Time->isToday($timestamp)){
		echo "7:00am Today!</h2>";// if you missed it, try again on ".date('l, F jS',$schedule[1]['start_date']); 
		echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if ($this->Time->isTomorrow($timestamp)){
			echo "Tomorrow!</h2>";
			echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if(date('z', $timestamp) - date('z') < 7){
		echo date('next l',$timestamp);
		echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else {
		echo "<h2'>".date('F j<\s\u\p\>S\<\/\s\u\p\>', $timestamp)."</h2>";	
	}
	
?>
	</h2>
	
</div>

	<div id="calendar">
	<table>
		<tr>
			<th>S</th>
			<th>M</th>
			<th>T</th>
			<th>W</th>
			<th>T</th>
			<th>F</th>
			<th>S</th>
		<tr>
		<tr>
			<?php 
				$i = 0;
				foreach($calendar as $day=>$date){
					echo '<td class="'.$date['class'].'">';
					echo date('j',$day); 
					if (isset($date['event'])){
						echo ': '.$date['event']['type'];	
					}	
					print "</td>\n\t\t\t";
					$i++;
					if(is_int($i/7)){
						print "</tr>\n\t\t<tr>\n\t\t\t";
					}
				}
			?>	
			</tr>
	</table>
	</div>
<?
    echo $form->create('Zone', array('type' => 'post'));
    echo $form->input('Email');
    echo $form->input('Phone');
    echo $form->hidden('zone', array('value' => $zone));
    echo $form->end('Send me the info!');
?>
<?php debug($schedule); ?>