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
	
}
