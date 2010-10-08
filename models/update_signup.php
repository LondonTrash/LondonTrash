<?php
class UpdateSignup extends AppModel {
	var $name = 'UpdateSignup';
	
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
  	)
	);
	
}
?>