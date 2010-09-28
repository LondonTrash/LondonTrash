<?php
echo $this->Html->script('calendar');
$address = $this->Session->read('address');
?>

<div class="results mod">
	<div class="address"><?php echo $address; ?> (Zone <?php echo $zone;?>)<?php echo $this->Html->link("Change", "/?a=".$address); ?></div>
	<div class="clear"></div>
	<small>Your Next Pickup is:</small>
<h2>
<?php 
	//$timestamp is what we're looking at
	//by default it's today
	
	 //real date
	$timestamp = $schedule[0]['start_date'];
	
	//today
	// $timestamp = mktime();
	
	//tomorrow:
	//$timestamp = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
	
	$timestamp = $schedule[0]['start_date'];
	if ($this->Time->isToday($timestamp)){
		echo "7:00am Today!</h2>";// if you missed it, try again on ".date('l, F jS',$schedule[1]['start_date']); 
		echo "<span id='r-date'>".date('F j\<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if ($this->Time->isTomorrow($timestamp)){
			echo "Tomorrow!</h2>";
			echo "<span id='r-date'>".date('F j\<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else if(date('z', $timestamp) - date('z') < 7){
		echo "Next " . date('l',$timestamp) . '</h2>';
		echo "<span id='r-date'>".date('F j<\s\u\p\>S\<\/\s\u\p\>, Y', $timestamp)."</span>";
	}else {
		echo "<h2>".date('F j\<\s\u\p\>S\<\/\s\u\p\>', $timestamp)."</h2>";	
	}
	
?>
	</h2>
	</div>

<ol id="callist">
	<?php $iter = 0; ?>
	<?php foreach( $calendar as $timestamp => &$day ) :
	if( time() > $timestamp || !isset($day['event']) ) : continue; endif;
	if( isset($day['event']) ) :
	if( 15 == $iter ) : break; endif;
	++$iter;
	
	$classes = array();
	if( $day['event']['type'] == 'yard waste' )
		$classes[] = 'special';
	else
		$classes[] = 'pickup';
	
	?>
	<li class="calday <?php print implode(' ', $classes); ?>"><strong><?php print date('M', $timestamp); ?></strong> <span><?php print date('j', $timestamp); ?></span></li>
	<?php endif; endforeach; ?>
<li>
<div class="clear"></div>
<div id="legend">
 <small><span class="pickup"></span>Regular Pickup</small>
 <small><span class="special"></span>Special Pickup</small>
</div></li>
</ol>

<div class="grid_6">  
<?php /* Markup that is not being used right now ...
<span id="holiday" class="pop-notice"> Holiday Schedule in Effect till 12/12/12</span>
<a href="" id="notify">Set up Notifications</a> 
<a href="" id="ical">iCal Feed (Zone D)</a>
<a href="" id="ical">Add to gCal (Zone D)</a>

<div class="clear"></div>
<hr>
<h4>Recycling</h4>
<select>
<option value="">Item</option>
</select>
<h4>Other Reuse and Recycling Options</h4>
<select>
<option value="">Item</option>
</select> */ ?>
&nbsp;
</div>

<div class="clear"></div>
		</div>
</div>


<?php
/* <!--
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
			<br style="clear:both" /></div>
<!-- #cal_inner --> */
/** What the hell is all of this?
	$i = 0;
	foreach($calendar as $day=>$date){
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
		
		if(isset($date['event']) && is_array($date['event'])){
			if ($date['event']['type'] == 'pickup'){
				echo "pickup {$date['event']['type']} ";
			}
			
			
			if ($date['event']['type'] != 'oldpickup' && $date['event']['type'] != 'pickup'){
				echo "special ";
				if ($date['event']['end_date'] != $date['event']['end_date'] && $date['event']['start_date'] == $timestamp){
					for ($i=$timestamp; $i<=$date['event']['end_date']; $i=strtotime ('+1 day',$i )){
						$calendar[$i]['event'] = $date['event'];
					}
				}
			}
		}
		
		echo '">';
		//'.$date['class'].'">';
		echo date('j',$day); 
		if (isset($date['event'])){
		//	echo ': '.$date['event']['type'];	
		}	
		print "</span>\n\t\t\t";
		$i++;

	}
*/ ?>