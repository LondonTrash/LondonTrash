<?php
class SubscribersController extends AppController {
	var $name = "Subscribers";
	
	var $components = array('SwiftMailer');

	function beforeFilter() {
		parent::beforeFilter();
		$this->set('title_for_layout', 'Notifications');
	}	
	
	function add($zone = null) {
		$this->Subscriber->Zone->contain();
		if (!$zoneData = $this->Subscriber->Zone->findByTitle($zone)) {
			$this->Session->setFlash('No zone found, please try again.');
			$this->redirect('/');
		}
		if (!empty($this->data)) {
			// initialize SwiftMailer transport
			$this->initializeMailer();

			$this->Subscriber->set($this->data);
			if ($this->Subscriber->validates(array('fieldList' => array('email', 'phone', 'provider_id')))) {
				if ($this->Subscriber->saveSubscriber($this->data)) {
					$this->Session->setFlash("You're signed up!", 'default', array('class' => 'success'));
					$this->sendConfirmationEmail($this->Subscriber->findById($this->Subscriber->id));
					$this->redirect(array('action' => 'success'));
				}
			}
			$this->Session->setFlash('Sorry, there was an error with your signup. Please try again.');
			$this->set('validationErrorList', $this->Subscriber->invalidFields());
		}
		$this->setProviders();
		$this->set('zone', $zoneData);
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
	
	private function initializeMailer() {
		// SMTP configuration
		if (file_exists(CONFIGS . 'smtp.php')) {
			include(CONFIGS . 'smtp.php');

			// pass SMTP configuration to SwiftMailer component
			foreach (Configure::read('smtp.config') as $key => $value) {
				$this->SwiftMailer->{'smtp' . ucfirst($key)} = $value;
			}
		} elseif (Configure::read('debug') > 0) {
			$this->Session->setFlash("Please configure SMTP settings. See config/smtp.default.php.");
		}
		
		// Set transport for later usage
		$this->swiftTransport =& $this->SwiftMailer->init_swiftmail();
	}
	
	private function sendConfirmationEmail($subscriber = null) {
		if (empty($subscriber)) {
			return false;
		}

		// Setting email subject and template for email/SMS
		if ($subscriber['Provider']['protocol_id'] == 1) {
			// Email
			$this->SwiftMailer->subject = 'LondonTrash.ca reminder created';
			$this->SwiftMailer->template = 'confirm';
		} else {
			// SMS
			$this->SwiftMailer->subject = null;
			$this->SwiftMailer->template = 'confirm_sms';
		}
		
		$this->set('subscriber', $subscriber);
		
		$this->SwiftMailer->sendAs = 'text'; 
		$this->SwiftMailer->from = 'notifications@londontrash.ca'; 
		$this->SwiftMailer->fromName = 'LondonTrash.ca'; 
		$this->SwiftMailer->to = $subscriber['Subscriber']['contact_email']; 
	 
		try { 
			if(!$this->SwiftMailer->fastsend($this->SwiftMailer->template, $this->SwiftMailer->subject, $this->swiftTransport)) { 
				$this->log("Error sending email"); 
			} 
		} 
		catch(Exception $e) { 
				$this->log("Failed to send email: " . $e->getMessage()); 
		} 
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