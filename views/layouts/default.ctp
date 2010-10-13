<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php echo $this->Html->css('style', null, array('media' => 'screen, projection')); ?>
<?php echo $this->Html->css('lib/mobile', null, array('media' => 'handheld, only screen and (max-device-width: 480px)')); ?>
<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone')): ?>
	<meta name="viewport" content="initial-scale=2.3, user-scalable=no" />
	<meta name="viewport" content="width=320; initial-scale=2; maximum-scale=1.0; user-scalable=0;" />
<?php endif; ?>
<!--[if IE]>
<?php echo $this->Html->css('lib/ie', null, array('media' => 'screen, projection')); ?>
<![endif]-->
<title><?php echo (!empty($title_for_layout) ? $title_for_layout . ' - ' :''); ?>LondonTrash.ca</title>
<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');?>
<?php	echo $this->Html->script('global'); ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18764236-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php echo $scripts_for_layout; ?>
</head>
<?php
// set class and id of body dynamically.
// class = controller-action
// id = param passed to action if there is one, else none
$bodyClass = $this->params['controller'] . '-' . $this->action;
$bodyId = null;
if (!empty($this->params['pass'][0])) {
	$bodyId = ' id="' . $this->params['pass'][0] . '"';
}
?>
<body class="<?php echo $bodyClass; ?>"<?php echo $bodyId; ?>>
	<div class="container_16">
		<div class="grid_5">
			<?php if ($this->Session->read('Auth.Admin')): ?>
			<div id="admin-info">
			Logged in as <?php echo $this->Session->read('Auth.Admin.email'); ?>
			<?php echo $this->Html->link("Admin Area", array('controller' => 'admins', 'admin' => true), array('id' => 'admin-area')); ?>
			<?php echo $this->Html->link("Logout", array('controller' => 'admins', 'action' => 'logout', 'admin' => true), array('id' => 'admin-logout')); ?>
			</div>
			<?php endif; ?>
			
			<h1 id="site-title"><?php echo $this->Html->link("London Trash", array('controller' => 'searches', 'action' => 'index', 'admin' => false)); ?></h1>
			
			<?php if ($this->params['controller'] != 'searches'): ?>
				<div class="clear"></div>
				<div class="dyk"><h3>Did You Know?</h3>
					<p><?php echo $tip; ?></p>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="grid_11">
								
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->element('address_choices'); ?>
			
			<div class="glass">
				<?php echo $content_for_layout; ?>
				<div class="clear"></div>
			</div>
			
			<ul id="lh-nav">
				<li><?php echo $this->Html->link('About', array('controller' => 'contents', 'action' => 'view', 'about', 'admin' => false)); ?>
				</li>
				<li><?php echo $this->Html->link('Privacy Policy', array('controller' => 'contents', 'action' => 'view', 'privacy-policy', 'admin' => false)); ?>
				</li>
				<li><?php echo $this->Html->link('Open Data London', 'http://www.opendatalondon.ca/', array('id' => 'odl')); ?></li>
			</ul>
			
		</div>

	</div>
</body>
<script type="text/javascript">
  var uservoiceOptions = {
    key: 'londontrash',
    host: 'londontrash.uservoice.com', 
    forum: '80369',
    alignment: 'right',
    background_color:'#18abf0', 
    text_color: 'white',
    hover_color: '#3dc2ff',
    lang: 'en',
    showTab: true
  };
  function _loadUserVoice() {
    var s = document.createElement('script');
    s.src = ("https:" == document.location.protocol ? "https://" : "http://") + "uservoice.com/javascripts/widgets/tab.js";
    document.getElementsByTagName('head')[0].appendChild(s);
  }
  _loadSuper = window.onload;
  window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
</script>
<?php echo $this->Js->writeBuffer(); ?>
</html>
