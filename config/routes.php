<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'searches', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'contents', 'action' => 'view'));
	
	// Notifications
	Router::connect('/notify/thanks', array('controller' => 'subscribers', 'action' => 'success'));
	Router::connect('/notify/*', array('controller' => 'subscribers', 'action' => 'add'));
	
	// Unsubscribe
	Router::connect('/unsubscribe', array('controller' => 'subscribers', 'action' => 'manual_delete'));
	Router::connect('/u/*', array('controller' => 'subscribers', 'action' => 'delete'));
	Router::connect('/unsubscribed', array('controller' => 'subscribers', 'action' => 'delete_success'));
	
	// Report a problem
	Router::connect('/report', array('controller' => 'problem_reports', 'action' => 'add'));
	Router::connect('/report/thanks', array('controller' => 'problem_reports', 'action' => 'success'));
	
	// User Routes
	Router::connect('/search/*', array(
		'controller' => 'searches',
		'action' => 'index'
	));
	
	Router::connect('/schedule/*', array(
		'controller' => 'zones',
		'action' => 'view'
	));
	
	// Admin Routes
	
	Router::connect('/admin/login', array(
		'controller' => 'admins',
		'action' => 'login',
		'admin' => true
	));
		
	Router::connect('/admin/logout', array(
		'controller' => 'admins',
		'action' => 'logout',
		'admin' => true
	));
		
	Router::connect('/admin', array(
		'controller' => 'admins',
		'action' => 'index',
		'admin' => true
	));
		
	Router::connect('/admin/content/add', array(
		'controller' => 'contents',
		'action' => 'add',
		'admin' => true
	));
		
	Router::connect('/admin/content/edit', array(
		'controller' => 'contents',
		'action' => 'edit',
		'admin' => true
	));

Router::parseExtensions();
