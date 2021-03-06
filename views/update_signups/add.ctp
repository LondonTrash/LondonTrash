<?php echo $this->Html->script('validate/jquery.validate.pack', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.form', array('inline' => false)); ?>
<?php echo $this->Html->script('notifications', array('inline' => false)); ?>
<?php
echo $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
	notify_prepForm();
});
JAVASCRIPT
, array('inline' => false));
?>


<?php echo $this->Form->create('UpdateSignup', array('id' => 'update-signup')); ?>
	<h3>Sign up below and we'll let you know as soon as we have email and SMS notifications up and running.</h3>
	<?php echo $this->Form->input('name', array('label' => 'First Name')); ?>
	<?php echo $this->Form->input('email', array('class' => 'email required')); ?>
	<?php echo $this->Form->hidden('zone_id', array('value' => $this->Session->read('zone_id'))); ?>
<div class="clear"></div>
<?php echo $this->Form->end('Let me know!'); ?>