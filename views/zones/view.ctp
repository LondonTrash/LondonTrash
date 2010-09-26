<?php
		//print_r($this->Session);
?>

<div class="mod results">
	<div class="address">
	<?php
		if ($this->Session->read('zone') != '')
		{
			echo $this->Session->read('address');
			echo ' (Zone ' . $this->Session->read('zone') . ')';
		}
	?>
	<a href="/">Change</a></div>
	<div class="clear"></div>
	<small>Your Next Pickup is:</small>
	<?php 

		$timestamp = $schedule[0]['start_date'];

		if ($this->Time->isToday($timestamp)){
			echo "<h2>TODAY</h2>"; 
			echo '<span id="r-date">' . date('l, F jS',$schedule[1]['start_date']) . '</span>';
		}else if ($this->Time->isTomorrow($timestamp)){
				echo "<h2>TOMORROW!</h2>";
				echo '<span id="r-date">' . date('l, F jS',$schedule[1]['start_date']) . '</span>';
		}else if(date('z', $timestamp) - date('z') < 7){
			echo "<h2>" . date('next l',$timestamp) . "</h2>";
		}else {
			echo "<h2>" . date('l, F jS',$timestamp) . "</h2>";	
		}
		?>

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
		<div id="subscribe">
	<?php
		echo $form->create('Zone', array('type' => 'post'));
		echo $form->input('Email');
		echo $form->input('Phone');
		echo $form->hidden('zone', array('value' => $zone));
		echo $form->end('Send me the info!');
	?>
	</div>
	<?php debug($schedule); ?>
</div>
