<?php
$this->Session->flash('auth');
echo $this->Form->create('admins', array('action' => 'login'));
echo $this->Form->inputs(array(
	'legend' => __('Login', true),
	'email',
	'password'
));
echo $this->Form->end('Login');
?>
