<?php
class Admin extends AppModel {
	var $name = 'Admin';
	
	var $validate = array(
		'email' => array(
			'emailVal' => array(
				'rule' => 'email'
			),
			'uniqueVal' => array(
				'rule' => 'isUnique',
				'message' => 'Email must be unique'
			)
		),
		'password' => array(
			'rule' => array('minLength', '8'),
			'message' => 'Password must be at least 8 characters long.'
		)
	);
	
	//TODO: Password confirm validator
}
?>
