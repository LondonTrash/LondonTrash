<?php
class AppController extends Controller {

	var $components = array('DebugKit.Toolbar', 'Auth', 'Session', 'Cookie', 'RequestHandler');
	var $scaffold = 'admin';
	var $helpers = array(
		'Session',
		'Js' // defaults to jQuery engine
	);
	
	function beforeRender() {
		$this->loadModel('Content');

		$tips = $this->Content->find('first', array(
			'conditions' => array(
				'category' => 'tips'
			),
			'order' => 'RAND()'
		));
		$tip = $tips['Content']['body'];
		$this->set('tip', $tip);
		
		// disable debug for ajax requests
    if ($this->RequestHandler->isAjax()) {  
			Configure::write('debug', 0);
    }
	}
	
	function beforeFilter() {
		// set name for cookie
		$this->Cookie->name = 'londontrash';
				
		$this->Auth->userModel = 'Admin';
    
	    $this->Auth->fields = array(
	        'username' => 'email', 
	        'password' => 'password'
	    );    

		$this->Auth->loginAction = array(
			'controller' => 'admins',
			'action' => 'login',
			'admin' => true
		);
		$this->Auth->logoutRedirect = array(
			'controller' => 'admins',
			'action' => 'login',
			'admin' => true
		);
			
		$this->Auth->loginRedirect = array(
			'controller' => 'admins',
			'action' => 'index',
			'admin' => true
		);
			
		$this->Auth->authorize = 'controller';
		$this->Auth->allow(array('*'));
	}
	
	function isAuthorized() {
	 	if (isset($this->params['admin'])) {
			if ($this->Auth->user()) {
		  		return true;
		  	}
		  	else
		  		$this->Auth->deny(array('*'));
		  		return false;
	  	}
	  	return true;	  	
	}
	
	/**
	 * Keep it DRY
	 *
	 * @param string $address 
	 * @param string $zone 
	 * @return void
	 * @author Scott Reeves
	 */
	public function updateUserData($address, $zone) {
		$this->Session->write('address', $address);
		$this->Cookie->write('address', $address, null, '10 years');
		$this->Cookie->write('zone', $zone, null, '10 years');
	}
	
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
