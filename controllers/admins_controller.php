<?php
class AdminsController extends AppController {
	var $name = 'Admins';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('admin_login', 'admin_logout'));
	}
	
	function admin_index() {
		$this->loadModel('AddressCache');
		$cachedLookups = $this->AddressCache->find('count');
		$this->set('cachedLookups', $cachedLookups);
		
		$this->loadModel('ProblemReport');
		$problemReports = $this->ProblemReport->find('count');
		$this->set('problemReports', $problemReports);
		
		$this->loadModel('UpdateSignup');
		$updateSignups = $this->UpdateSignup->find('count');
		$this->set('updateSignups', $updateSignups);
	}
	
	function admin_login() {
		
	}
	
	function admin_logout() {
		$this->Session->setFlash('You have been logged out.');
		$this->redirect($this->Auth->logout());
	}
	
	function admin_add_account() {
		// disable this action (for now, at least)
		$this->Session->setFlash("This functionality has been disabled.");
		$this->redirect(array('action' => 'index'));
		
		if($this->data) {			
			if($this->Admin->save($this->data)) {
				$this->Session->setFlash("New administrator added.");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("Unable to add administrator.");
			}
		}
	}
	
	function admin_change_password() {
		
	}
}
?>
