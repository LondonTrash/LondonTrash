<?php
class Feedback extends AppModel {

	var $name = 'Feedback';
	var $validate = array(
		'email' => array('email'),
		'name' => array('notempty')
	);

}
?>