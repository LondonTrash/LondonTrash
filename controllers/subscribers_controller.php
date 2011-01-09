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
			$this->set('validationErrorList', $this->Subscriber->invalidFields());
		}
		$this->setProviders();
	}
	
	function success() {
		// nothing to do here, just render the view
	}
	
	function delete($id = null) {
		if (!empty($this->data)) {
			// check that the provided email or phone number matches their record
			if ($this->Subscriber->matchRecord($id, $this->data)) {
				// delete the subscriber and notification records
				if ($this->Subscriber->delete($id)) {
					$this->Session->setFlash('You are now unsubscribed.', 'default', array('class' => 'success'));
					$this->redirect(array('action' => 'delete_success'));
				} else {
					$this->Session->setFlash('Sorry, there was an error removing your subscription. Please try again.');
				}
			}
			$this->Session->setFlash('We could not find a match. Please double-check your entry and your unsubscription link.');
		}
	}
	
	function delete_success() {
		// just render the view
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