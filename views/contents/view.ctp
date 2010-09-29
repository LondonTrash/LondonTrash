<div class="contents view">
	<?php if(!empty($content)) { ?>
		<h2><?php echo $content['Content']['title']; ?></h2>
		<?php echo $content['Content']['body']; ?>
	<?php } else { ?>
		<h2>Your URL is Garbage.</h2>
		<p>The requested page was not found. Sorry!</p>
	<?php } ?>
</div>