<?php
class AppController extends Controller {

	var $components = array('DebugKit.Toolbar', 'Auth', 'Session', 'RequestHandler');
	var $scaffold = 'admin';
	
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
