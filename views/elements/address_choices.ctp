<?php
$addressChoices = $this->Session->read('addressChoices');
if (!empty($addressChoices) && $this->params['controller'] == 'searches'): ?>
<div id="flashMessage" class="notice">
	<p>There was more than one result found. Please click on the correct address below.</p>
	<ul>
	<?php foreach ($addressChoices as $address): ?>
		<li>
		<?php echo $this->Html->link($address->formatted_address, array('controller' => 'searches', 'action' => 'choose', $address->formatted_address, $address->zone_name)); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>