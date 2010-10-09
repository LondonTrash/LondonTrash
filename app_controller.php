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
		'RequestHandler'
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
	
	/**
	 * Update session and long-term cookie
	 *
	 * @param string $address 
	 * @param string $zone 
	 * @return void
	 * @author Scott Reeves
	 */
	public function updateUserData($address, $zone) {
		$this->Session->write('address', $address);
		$this->Session->write('zone', $zone);
		$this->Cookie->write('address', $address, null, '10 years');
		$this->Cookie->write('zone', $zone, null, '10 years');
	}
	
	/**
	 * Grab data from long-term cookie, use it to update session and cookie,
	 * and optionally redirect.
	 *
	 * @param bool $redirect 
	 * @return void
	 * @author Scott Reeves
	 */
	public function getCookieData($redirect = false) {
		$address = null;
		if ($zone = $this->Cookie->read('zone')) {
			$address = $this->Cookie->read('address');
			$this->updateUserData($address, $zone);
			if ($redirect === true) {
				$this->redirect(array('controller' => 'zones', 'action' => 'view', $zone));
			}
		}
	}
	
}
