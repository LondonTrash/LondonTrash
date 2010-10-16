<?php

echo $this->Form->create('Admin', array('action' => 'add_account', 'admin' => true));

echo $this->Form->inputs(array(
	'legend' => __('Create Administrator', true),
	'email',
	'password' => array('value' => ''),
	'confirm_password' => array('type' => 'password', 'value' => '')
	));
	
echo $this->Form->end("Add Administrator");

?>