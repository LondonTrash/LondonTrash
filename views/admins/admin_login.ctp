<h2>Login</h2>
<?php
echo $this->Form->create('Admin', array('action' => 'login', 'admin' => true));
echo $this->Form->inputs(array(
	'fieldset' => false,
	'email',
	'password'
));
echo $this->Form->end('Login');
?>
