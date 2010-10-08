<h2>Administrative Actions</h2>
<ul>
	<li>
		<?php echo $this->Html->link("Add Admin", array('action' => 'add_account', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Content", array('controller' => 'contents', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Problem Reports", array('controller' => 'problem_reports', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Feedback", array('controller' => 'feedbacks', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Update Signups", array('controller' => 'update_signups', 'admin' => true)); ?>
	</li>
</ul>
<hr />
<ul>
	<li>
		<?php echo $this->Html->link("Manage Protocols", array('controller' => 'protocols', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Providers", array('controller' => 'providers', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Subscribers", array('controller' => 'subscribers', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Notifications", array('controller' => 'subscribers', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Zones", array('controller' => 'zones', 'admin' => true)); ?>
	</li>
</ul>
