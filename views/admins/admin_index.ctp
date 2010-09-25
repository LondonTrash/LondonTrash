<h1>Adminstrative Actions</h1>
<?php echo $this->Html->link("Logout", array('action' => 'logout', 'admin' => true)); ?>
<ul>
	<li>
		<?php echo $this->Html->link("Add Admin", array('action' => 'add_account', 'admin' => true)); ?>
	</li>
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
		<?php echo $this->Html->link("Manage Zones", array('controller' => 'zones', 'admin' => true)); ?>
	</li>
</ul>
