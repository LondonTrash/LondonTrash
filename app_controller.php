<?php
class AppController extends Controller {
	var $components = array('DebugKit.Toolbar', 'Auth', 'Session', 'RequestHandler');
	
	function beforeFilter() {
	
		$this->Auth->userModel = 'Admin';
		
        $this->Auth->fields = array(
            'username' => 'email', 
            'password' => 'password'
        );
        
		$this->Auth->loginAction = array('controller' => 'admins',
			'action' => 'login');
		$this->Auth->logoutRedirect = array('controller' => 'admins',
			'action' => 'login');
			
		$this->Auth->loginRedirect = array('controller' => 'whatever', 'action' => 'index');
			
		$this->Auth->allowedActions = array("*");
	}
}
