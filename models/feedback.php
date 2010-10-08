<?php
class Feedback extends AppModel {

	var $name = 'Feedback';
	var $validate = array(
		'email' => array(
	 		'email' => array(
	  		'rule' => 'email',
				'message' => 'Please enter a valid email address'
	  	),
	  	'notEmpty' => array(
	    	'rule' => 'notEmpty',
	    	'message' => 'This field cannot be left blank'
	    )
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank'
			)
		)
	);

}
?>