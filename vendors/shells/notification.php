<?php
class NotificationShell extends Shell {

	var $uses = array('Subscriber', 'Zone');
	
	function main() {
		/**
		 * How far ahead of time we should send the notification
		 * This value is in seconds.
		 * 
		 * Since we're using all day events in gCal, 12am - 5h = 7pm the night before
		 */
		$notificationOffset = 60 * 60 * 5;
		
		/**
		 * How far ahead and behind of notification time we should allow
		 * In other words, if we're +/- this amount, go ahead and send the notification
		 * This value is in seconds.
		 */
		$gracePeriod = 60 * 60 * 1;
		
		// Just for testing purposes. Use time() instead.
		$currentTime = 1287617400;
		
		// grab all our zone data
		$zones = $this->Zone->find('all');
		
		foreach ($zones as $zone) {			
			// get the next scheduled regular pickup for this zone
			$pickup = $this->Zone->get_next_pickup($zone['Zone']['title'], array('type' => 'pickup'));
			
			// when to notify
			$notification_time = $pickup['start_date'] - $notificationOffset;

			// for each subscriber in the zone
			$subscribers = $this->Subscriber->find('all', array('conditions' => array('Subscriber.zone_id' => $zone['Zone']['id'])));
	
			foreach ($subscribers as $subscriber) {
				foreach ($subscriber['Notification'] as $notification) {
					// check to see if we've already sent a notification to this user
					if ($notification['last_sent'] == null || $notification['last_sent'] < $notification_time) {
						
						// Check for a date match
						echo "Current time: " . date('r', $currentTime) . "\n";
						echo "Not - Grace: " . date('r', $notification_time - $gracePeriod) . "\n";
						echo "Not + Grace: " . date('r', $notification_time + $gracePeriod) . "\n";
							
						// we haven't yet reached the notification time
						if ($currentTime <= $notification_time) {
							$timeDifference = $notification_time - $currentTime;
						} else { // we're not at the notification time yet
							$timeDifference = $currentTime - $notification_time;
						}
						
						if ($gracePeriod >= $timeDifference) {
							$this->out($subscriber["Subscriber"]["contact"] . " in Zone " . $zone['Zone']['title'] .
							" about a pickup on " . date('F j Y', $pickup['start_date']) . "\n");
							
							$subscriberData = array(
								'Subscriber' => $subscriber['Subscriber'],
								'Notification' => $notification,
								'Zone' => $zone['Zone']
							);
								
							if ($this->sendMail($subscriberData)) {
								$this->out("Sent!\n");
								$this->Subscriber->Notification->id = $notification['id'];
								$this->Subscriber->Notification->saveField('last_sent', time());	
							} else {
								$this->out("Unable to send.\n");
								$this->out($this->Email->smtpError);
							}
						}
							
					}
				
				}
			}
		}
	}
	
	function sendMail($subscriberData) {
		App::import('Core', 'Controller'); 
		App::import('Component', 'Email'); 
		$this->Controller =& new Controller(); 
		$this->Email =& new EmailComponent(null); 
		$this->Email->initialize($this->Controller);
		
		// SMTP configuration
		if (file_exists(CONFIGS . 'smtp.php')) {
			$this->Email->delivery = 'smtp';
			include(CONFIGS . 'smtp.php');
			$this->Email->smtpOptions = Configure::read('smtp.config');
		}
		
		// plaintext for now, point to our template
		$this->Email->sendAs = 'text';
		$this->Email->template = 'pickup';
		
		// pass data to email template
		$this->Controller->set('subscriberData', $subscriberData);

		// headers
		$this->Email->from = 'noreply@londontrash.ca'; 
		$this->Email->to = $subscriberData['Subscriber']['contact']; //logic for email/SMS not in place yet
		$this->Email->subject = 'Take out the trash!';
		
		if ($this->Email->send()) {
			// debug the email message
			$this->out($this->Email->textMessage);
			return true;
		}
		return false;
	}

}	 
?>