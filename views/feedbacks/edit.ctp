<div class="feedbacks form">
<?php echo $form->create('Feedback');?>
	<fieldset>
 		<legend><?php __('Edit Feedback');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('email');
		echo $form->input('name');
		echo $form->input('message');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Feedback.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Feedback.id'))); ?></li>
		<li><?php echo $html->link(__('List Feedbacks', true), array('action' => 'index'));?></li>
	</ul>
</div>
