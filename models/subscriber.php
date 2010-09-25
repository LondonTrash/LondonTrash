<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
	);
}
?>