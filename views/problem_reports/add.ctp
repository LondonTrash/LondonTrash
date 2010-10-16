<?php echo $this->Html->script('jquery.form', array('inline' => false)); ?>
<?php echo $this->Html->script('report_problem', array('inline' => false)); ?>
<?php
echo $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
	report_prepForm();
});
JAVASCRIPT
, array('inline' => false));
?>
<?php echo $this->Form->create('ProblemReport', array('id' => 'report-problem')); ?>
	<h3>Click <strong>Send</strong> to submit your data (and optional comments) for review. Thanks for making LondonTrash.ca better!</h3> 
	<?php echo $this->Form->input('comments', array('label' => 'Comments (optional)')); ?>
	<?php echo $this->Form->hidden('zone_id', array('value' => $this->Session->read('zone_id'))); ?>
	<?php echo $this->Form->hidden('address', array('value' => $this->Session->read('address'))); ?>
<div class="clear"></div>
<?php echo $this->Form->end('Send'); ?>