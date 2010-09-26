<?php
?><h1>Your pickup day  <?php 

	$timestamp = $schedule[0]['start_date'];

	if ($this->Time->isToday($timestamp)){
		echo "is TODAY, if you missed it, try again on ".date('l, F jS',$schedule[1]['start_date']); 
	}else{
	 	echo "is ";
		if ($this->Time->isTomorrow($timestamp)){
			echo "TOMORROW!";
		}else if(date('z', $timestamp) - date('z') < 7){
			echo date('next l',$timestamp);
		}else {
			echo date('l, F jS',$timestamp);	
		}
	}
	
	?>
  </h1>

<?php debug($schedule); ?>