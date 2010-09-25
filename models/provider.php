<?php
class Provider extends AppModel {
	var $name = 'Provider';

	var $belongsTo = array(
		'Protocol'
	);

	var $hasMany = array(
		'Subscriber'
	);

}
?>