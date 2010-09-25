<?php
class Protocol extends AppModel {
	var $name = 'Protocol';

	var $hasMany = array(
		'Provider'
	);

}
?>