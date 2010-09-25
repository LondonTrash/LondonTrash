<?php
class AppController extends Controller {

	var $components = array('DebugKit.Toolbar', 'Auth', 'Session', 'RequestHandler');
	var $scaffold = 'admin';
	
	function beforeFilter() {
	
		$this->Auth->userModel = 'Admin';
		
        $this->Auth->fields = array(
            'username' => 'email', 
            'password' => 'password'
        );
        

		$this->Auth->loginAction = array('controller' => 'admins',
			'action' => 'login', 'admin' => true);
		$this->Auth->logoutRedirect = array('controller' => 'admins',
			'action' => 'login', 'admin' => true);
			
		$this->Auth->loginRedirect = array('controller' => 'admins',
			'action' => 'index', 'admin' => true);
			
		$this->Auth->authorize = 'controller';
		$this->Auth->allow(array('display'));
	}
	
	function isAuthorized() {
	 	if (isset($this->params['admin'])) {
			if ($this->Auth->user()) {
		  		return true;
		  	}
		  	else
		  		return false;
	  	}
	  	return true;	  	
	}
}
