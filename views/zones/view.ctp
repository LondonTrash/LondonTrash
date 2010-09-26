<?php
?>

<h1>Your pickup day is <?php 

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
				foreach($calendar as $day=>$class){
					echo '<td class="'.$class['class'].'">';
					echo date('j',$day); 
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