<div class="feedback form">
<h2>Feedback</h2>
<p>Have a question about our team, this project or anything else? Ask away!</p>
<?php echo $form->create('Feedback');?>
	<?php
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('message');
	?>
<?php echo $form->end('Submit');?>
</div>
