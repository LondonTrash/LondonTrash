<?php
class AnnounceShell extends Shell {

	var $uses = array('UpdateSignup', 'Zone');
	
	var $tasks = array('SwiftMailer');
	
	var $swiftTransport = null;
	
	function main() {
		// grab all our zone data
		$zones = $this->Zone->find('all');
		
		foreach ($zones as $zone) {
			// for each update signup in the zone
			$notifications = $this->UpdateSignup->find('all', array('conditions' => array('UpdateSignup.zone_id' => $zone['Zone']['id'])));
				
				$this->initializeMailer();
				
				foreach ($notifications as $notification) {
					$this->out($notification['UpdateSignup']['email'] . " in " . $zone['Zone']['formatted_title']);
			
					$subscriberData = array(
						'UpdateSignup' => $notification['UpdateSignup'],
						'Zone' => $zone['Zone']
					);
			
					if ($this->sendMail($subscriberData)) {
						$this->out("Sent!");
					} else {
						$this->out("Unable to send.");
					}
							
				}
		}
	}
	
	function initializeMailer() {
		// SMTP configuration
		if (file_exists(CONFIGS . 'smtp.php')) {
			$this->Email->delivery = 'smtp';
			include(CONFIGS . 'smtp.php');

			// pass SMTP configuration to SwiftMailer component
			foreach (Configure::read('smtp.config') as $key => $value) {
				$this->SwiftMailer->instance->{'smtp' . ucfirst($key)} = $value;
			}
		} else {
			$this->out("Please configure SMTP settings. See config/smtp.default.php.");
		}
		
		// Set transport for later usage
		$this->swiftTransport =& $this->SwiftMailer->instance->init_swiftmail();
	}
	
	function sendMail($subscriberData) {
		$this->SwiftMailer->instance->sendAs = 'text';
		$this->SwiftMailer->instance->from = 'notifications@londontrash.ca';
		$this->SwiftMailer->instance->fromName = 'LondonTrash.ca';
		$this->SwiftMailer->instance->to = $subscriberData['UpdateSignup']['email'];
		
		// Setting email subject and template
		$this->SwiftMailer->instance->subject = 'LondonTrash.ca notifications now available';
		$this->SwiftMailer->instance->template = 'announce';

		// pass data to email template
		$this->SwiftMailer->set('subscriberData', $subscriberData);
		
		// logging
		// $this->SwiftMailer->instance->registerPlugin('LoggerPlugin', new Swift_Plugins_Loggers_EchoLogger());

		try { 
			if(!$this->SwiftMailer->instance->fastsend($this->SwiftMailer->instance->template, $this->SwiftMailer->instance->subject, $this->swiftTransport)) {
				foreach($this->SwiftMailer->instance->postErrors as $failed_send_to) {
					$this->log("Failed to send email to: " . $failed_send_to);
					return false;
				} 
			} 
		} 
		catch(Exception $e) { 
			$this->log("Failed to send email: " . $e->getMessage());
			return false;
		}
		return true;
	}

}	 
?>