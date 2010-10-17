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
		$currentTime = 1287613802;
		
		// grab all our zone data
		$zones = $this->Zone->find('all');
		
		foreach ($zones as $zone) {			
			// get the next scheduled regular pickup for this zone
			$pickup = $this->Zone->get_next_pickup($zone['Zone']['title'], array('type' => 'pickup'));
			
			// when to notify
			$notification_time = $pickup['start_date'] - $notificationOffset;
			
			// Figure out where we are in relation to the notification time
			if ($currentTime <= $notification_time) {
				// we haven't yet reached the notification time
				$timeDifference = $notification_time - $currentTime;
			} else {
				// we're past the notification time
				$timeDifference = $notification_time + $currentTime;
			}
			
			// only try to send while within the grace period
			if ($gracePeriod >= $timeDifference) {
				
				$graceStart = $notification_time - $gracePeriod;
				$graceEnd = $notification_time + $gracePeriod;
				
				$this->out("Current time: " . date('r', $currentTime));
				$this->out("Grace period starts: " . date('r', $graceStart));
				$this->out("Grace period ends: " . date('r', $graceEnd));
			
				// for each subscriber in the zone
				$subscribers = $this->Subscriber->find('all', array('conditions' => array('Subscriber.zone_id' => $zone['Zone']['id'])));
	
				foreach ($subscribers as $subscriber) {
					foreach ($subscriber['Notification'] as $notification) {
						if (!empty($notification['last_sent'])) {
							$this->out("Notification last sent: " . date('r', $notification['last_sent']));
						}

						// check to see if we've already sent a notification to this user within the grace period
						if ($notification['last_sent'] == null || ($notification['last_sent'] < $graceStart && $notification['last_sent'] > $graceEnd)) {
							$this->out($subscriber['Subscriber']['contact_email'] . " in Zone " . $zone['Zone']['title'] .
							" about a pickup on " . date('F j Y', $pickup['start_date']) . "\n");
							
							$subscriberData = array(
								'Subscriber' => $subscriber['Subscriber'],
								'Notification' => $notification,
								'Zone' => $zone['Zone'],
								'Pickup' => $pickup,
								'Provider' => $subscriber['Provider']
							);
							
							if ($this->sendMail($subscriberData)) {
								$this->out("Sent!\n");
								$this->Subscriber->Notification->id = $notification['id'];
								$this->Subscriber->Notification->saveField('last_sent', $currentTime);	
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
		
		// overriding delivery method for now
		$this->Email->delivery = 'debug';
		
		// plaintext for now
		$this->Email->sendAs = 'text';
		
		// Setting email subject and template for email/SMS
		if ($subscriberData['Provider']['protocol_id'] == 1) {
			// Email
			$this->Email->subject = 'LondonTrash.ca reminder';
			$this->Email->template = 'pickup';
		} else {
			// SMS
			$this->Email->subject = null;
			$this->Email->template = 'pickup_sms';
		}
		
		// pass data to email template
		$this->Controller->set('subscriberData', $subscriberData);

		// message headers
		$this->Email->from = 'noreply@londontrash.ca'; 
		$this->Email->to = $subscriberData['Subscriber']['contact_email'];
		
		if ($this->Email->send()) {
			// debug the email message
			$this->out('Subject: ' . $this->Email->subject);
			$this->out($this->Email->textMessage);
			return true;
		}
		return false;
	}

}	 
?>