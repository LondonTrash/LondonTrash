<?php
?><h1>Your pickup day is <?php 

	$timestamp = $schedule[0]['start_date'];

	if ($this->Time->isToday($timestamp)){
		echo "TODAY, if you missed it, try again on ".date('l, F jS',$schedule[1]['start_date']); 
	}else if ($this->Time->isTomorrow($timestamp)){
			echo "TOMORROW!";
	}else if(date('z', $timestamp) - date('z') < 7){
		echo date('next l',$timestamp);
	}else {
		echo date('l, F jS',$timestamp);	
	}
	
	?>
  </h1>

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

<?php debug($schedule); ?>