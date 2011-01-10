<h2>Admin</h2>
<hr />
<h3>Usage Stats:</h3>
<ul>
<li>There are currently <strong><?php echo $cachedLookups; ?></strong> cached lookups stored.</li>
<li><strong><?php echo $subscribers; ?></strong> people have signed up for reminders.</li>
<li><s><strong><?php echo $updateSignups; ?></strong> people have signed up to be notified when we have notifications ready.</s></li>
<li><strong><?php echo $problemReports; ?></strong> people have reported <?php echo $this->Html->link("problems", array('controller' => 'problem_reports', 'admin' => true)); ?>.</li>
</ul>
<hr />
<ul>
	<li>
		<?php echo $this->Html->link("Manage Content", array('controller' => 'contents', 'admin' => true)); ?>
	</li>
	<li>
		<?php echo $this->Html->link("View Feedback (Uservoice)", 'http://londontrash.uservoice.com'); ?>
	</li>
	<li>
		<?php echo $this->Html->link("Manage Problem Reports", array('controller' => 'problem_reports', 'admin' => true)); ?>
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
