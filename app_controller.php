<?php
class AppController extends Controller {

	var $components = array(
		'DebugKit.Toolbar',

		// Auth properties
		'Auth' => array(
			'userModel' => 'Admin',
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			),
			'loginAction' => array(
				'controller' => 'admins',
				'action' => 'login',
				'admin' => true
			),
			'logoutRedirect' => array(
				'controller' => 'admins',
				'action' => 'login',
				'admin' => true
			),
			'loginRedirect' => array(
				'controller' => 'admins',
				'action' => 'index',
				'admin' => true
			),
			'authorize' => 'controller'
		), 

		'Session',
		'Cookie',
		'RequestHandler',
		'UserData'
	);
	var $scaffold = 'admin';
	var $helpers = array(
		'Session',
		'Js' // defaults to jQuery engine
	);
	
	function beforeRender() {
		$this->setTip();
				
		// disable debug for ajax requests
    if ($this->RequestHandler->isAjax()) {  
			Configure::write('debug', 0);
    }
	}
	
	function beforeFilter() {
		// set name for cookie
		$this->Cookie->name = 'londontrash';

		// allow all actions by default
		$this->Auth->allow(array('*'));
	}
	
	/**
	 * This function hooks into the auth component and 
	 * determines whether a user is allowed access.
	 *
	 * We are allowing access to everything by default,
	 * so this checks if the user is trying to access an 
	 * admin action, then checks if they are logged in.
	 *
	 * @return void
	 */
	function isAuthorized() {
	 	if (isset($this->params['admin'])) {
			if ($this->Auth->user()) {
	  		return true;
		  } else {
	  		$this->Auth->deny(array('*'));
	  		return false;
	  	}
		}
	}
	
	/**
	 * Grab a random tip from the database and pass to the view
	 *
	 * @return void
	 * @author Gavin Blair
	 */
	private function setTip() {
		$this->loadModel('Content');
		$tips = $this->Content->find('first', array(
			'conditions' => array(
				'category' => 'tips'
			),
			'order' => 'RAND()'
		));
		$tip = $tips['Content']['body'];
		$this->set('tip', $tip);
	}
	
}
