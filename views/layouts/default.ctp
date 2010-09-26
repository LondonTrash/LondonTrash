<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php echo $this->Html->css('style', null, array('media' => 'screen, projection')); ?>
<!--[if IE]>
<?php echo $this->Html->css('lib/ie', null, array('media' => 'screen, projection')); ?>
<![endif]-->
<title><?php echo $title_for_layout; ?> - LondonTrash.ca</title>
<?php echo $scripts_for_layout; ?>
</head>

<body class="result">
	<div class="container_16">
		<div class="grid_5 ">
			<h1 id="site-title">London Trash</h1>
			
			<?php if ($page != 'home'): /*
				TODO: Add actual condition here.
				* Below is an element
			*/ ?>
			<div class="clear"></div>
			<div class="dyk "><h3>Did You Know?</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam gravida turpis sed nisi rutrum suscipit. Maecenas id quam sit amet augue sollicitudin porta. Nulla ac volutpat libero. Mauris lacus metus, tincidunt vitae semper ac, consectetur et eros. Donec et laoreet lacus. Nulla urna velit, tristique at sodales varius, rhoncus ut augue. </p>
			</div>
			<a href="" class="report"> Report an Error</a>
		</div>
		<?php endif; ?>

		<?php if ($page == 'schedule'): ?>
			<a href="" class="report"> Report an Error</a>
		<?php endif; ?>
		
		</div>
			<div class="grid_11 ">
				<div class="glass ">
				
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth'); ?>

					<?php echo $content_for_layout; ?>
				</div>
				
				<ul id="lh-nav">
					<li><a href="/contents/view/terms-of-service">TOS</a></li>
					<li><a href="/contents/view/privacy-policy">Privacy Policy</a></li>
					<li><a href="/contents/view/about">About</a></li>
					<li><a href="" id="odl">Open Data London</a></li>
				</ul>
			</div>

			</div>
		</div>
	</div>

	</body>
	</html>
