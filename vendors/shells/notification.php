<?php
class NotificationShell extends Shell {

	var $uses = array('Subscriber', 'Zone');
	
	var $tasks = array('SwiftMailer');
	
	var $swiftTransport = null;
	
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
		$currentTime = time();
		
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
				$timeDifference = $currentTime - $notification_time;
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
				
				$this->initializeMailer();
	
				foreach ($subscribers as $subscriber) {
					foreach ($subscriber['Notification'] as $notification) {
						if (!empty($notification['last_sent'])) {
							$this->out("Notification last sent: " . date('r', $notification['last_sent']));
						}

						// check to see if we've already sent a notification to this user within the grace period
						if ($notification['last_sent'] == null || ($notification['last_sent'] < $graceStart && $notification['last_sent'] > $graceEnd)) {
							$this->out($subscriber['Subscriber']['contact_email'] . " in Zone " . $zone['Zone']['title'] .
							" about a pickup on " . date('F j Y', $pickup['start_date']));
							
							$subscriberData = array(
								'Subscriber' => $subscriber['Subscriber'],
								'Notification' => $notification,
								'Zone' => $zone['Zone'],
								'Pickup' => $pickup,
								'Provider' => $subscriber['Provider']
							);
							
							if ($this->sendMail($subscriberData)) {
								$this->out("Sent!");
								$this->Subscriber->Notification->id = $notification['id'];
								$this->Subscriber->Notification->saveField('last_sent', time());	
							} else {
								$this->out("Unable to send.");
							}
							
						}
				
					}
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
		}
		
		// Set transport for later usage
		$this->swiftTransport =& $this->SwiftMailer->instance->init_swiftmail();
	}
	
	function sendMail($subscriberData) {
		$this->SwiftMailer->instance->sendAs = 'text';
		$this->SwiftMailer->instance->from = 'noreply@londontrash.ca';
		$this->SwiftMailer->instance->fromName = 'LondonTrash.ca';
		$this->SwiftMailer->instance->to = $subscriberData['Subscriber']['contact_email'];
		
		// Setting email subject and template for email/SMS
		if ($subscriberData['Provider']['protocol_id'] == 1) {
			// Email
			$this->SwiftMailer->instance->subject = 'LondonTrash.ca reminder';
			$this->SwiftMailer->instance->template = 'pickup';
		} else {
			// SMS
			$this->SwiftMailer->instance->subject = null;
			$this->SwiftMailer->instance->template = 'pickup_sms';
		}

		// pass data to email template
		$this->SwiftMailer->set('subscriberData', $subscriberData);
		
		// logging
		//$this->SwiftMailer->instance->registerPlugin('LoggerPlugin', new Swift_Plugins_Loggers_EchoLogger());

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