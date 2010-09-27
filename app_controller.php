<?php
class AppController extends Controller {

	var $components = array('DebugKit.Toolbar', 'Auth', 'Session', 'RequestHandler');
	var $scaffold = 'admin';
	
	function beforeFilter() {
	
		$this->Auth->userModel = 'Admin';
		$this->loadModel('Content');
		$tips = $this->Content->find('all', array(
			'conditions' => array(
				'category' => 'tips'
			)
		));
		$this->set('tips', $tips);
		
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
