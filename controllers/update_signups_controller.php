<?php
class UpdateSignupsController extends AppController {
	var $name = 'UpdateSignups';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Notifications');
	}
	
	
	function add() {
		if (!empty($this->data)) {
			if ($this->UpdateSignup->save($this->data)) {
				$this->Session->setFlash("You're signed up!", 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'success'));
			} else {
				$this->Session->setFlash('Sorry, there was an error with your signup. Please try again.');	
			}
		}
	}
	
	function success() {
		// nothing to do here, just render the view
	}
}
?>