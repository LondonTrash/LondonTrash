<?php
class Admin extends AppModel {
	var $name = 'Admin';
	
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Please enter a valid email address'
			),
			'uniqueVal' => array(
				'rule' => 'isUnique',
				'message' => 'Email must be unique'
			)
		),
		'password' => array(
			'password' => array(
				'rule' => array('minLength', '8'),
				'message' => 'Password must be at least 8 characters long.'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field cannot be left blank.'
			)
		)
	);
	
	//TODO: Password confirm validator
}
?>