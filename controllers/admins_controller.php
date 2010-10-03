<?php
class AdminsController extends AppController {
	var $name = 'Admins';
	var $helpers = array('Session');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('admin_login', 'admin_logout'));
	}
	
	function admin_index() {

	}
	
	function admin_login() {
		
	}
	
	function admin_logout() {
		$this->Session->setFlash('You have been logged out.');
		$this->redirect($this->Auth->logout());
	}
	
	function admin_add_account() {
		if($this->data) {
			$this->Admin->create();
			
			if($this->Admin->save($this->data))
				$this->Session->setFlash("New administrator added.");
			else
				$this->Session->setFlash("Unable to add administrator.");
		}
	}
	
	function admin_change_password() {
		
	}
}
?>