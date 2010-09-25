<?php
echo $this->Form->create('Admin', array('action' => 'login', 'admin' => true));
echo $this->Form->inputs(array(
	'legend' => __('Login', true),
	'email',
	'password'
));
echo $this->Form->end('Login');
?>
