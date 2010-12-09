<?php
class SubscribersController extends AppController {
	var $name = "Subscribers";

	function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Notifications');
	}	
	
	function add() {
		if (!empty($this->data)) {
			$this->Subscriber->set($this->data);
			if ($this->Subscriber->validates(array('fieldList' => array('email', 'phone', 'provider_id')))) {
				if ($this->Subscriber->saveSubscriber($this->data)) {
					$this->Session->setFlash("You're signed up!", 'default', array('class' => 'success'));
					$this->redirect(array('action' => 'success'));
				}
			}
			$this->Session->setFlash('Sorry, there was an error with your signup. Please try again.');	
		}
		$this->setProviders();
	}
	
	function success() {
		// nothing to do here, just render the view
	}
	
	private function setProviders() {
		$this->loadModel('Provider');
		$providers = $this->Provider->find('list', array(
			'conditions' => array('protocol_id' => 2),
			'order' => 'title ASC'
		));
		$this->set('providers', $providers);
	}
}
?>