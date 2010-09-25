<?php
class Zone extends AppModel {
	var $name = 'Zone';

	var $hasMany = array(
		'Subscriber'
	);

}
?>