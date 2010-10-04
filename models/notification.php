<?php
class Notification extends AppModel {
	var $name = 'Notification';	
	
	var $belongsTo = array(
		'Subscriber'
	);
}
?>