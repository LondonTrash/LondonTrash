<div class="contents form">
<?php echo $this->Form->create('Content');?>
	<fieldset>
 		<legend><?php __('Admin Add Content'); ?></legend>
	<?php
		$category_options = array('page'=>'page', 'tips'=>'tips');
		echo $this->Form->select('category', $category_options, array('tips'), array(), false);
		echo $this->Form->input('title');
		echo $this->Form->input('body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contents', true), array('action' => 'index'));?></li>
	</ul>
</div>
