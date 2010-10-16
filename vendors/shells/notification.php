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
		
		// grab all our zone data
		$zones = $this->Zone->find('all');
		
		foreach ($zones as $zone) {			
			// get the next scheduled regular pickup for this zone
			$pickup = $this->Zone->get_next_pickup($zone['Zone']['title'], array('type' => 'pickup'));
			
			// when to notify
			$notification_time = $pickup['start_date'] - $notificationOffset;

			//for each subscriber in the zone
			$subscribers = $this->Subscriber->find('all', array('conditions' => array('Subscriber.zone_id' => $zone['Zone']['id'])));
	
			foreach ($subscribers as $subscriber) {
				foreach ($subscriber['Notification'] as $notification) {
					// check to see if we've already sent a notification to this user
					if ($notification['last_sent'] == null || $notification['last_sent'] < $notification_time) {
						$this->Subscriber->Notification->id = $notification['id'];
						$this->Subscriber->Notification->saveField('last_sent', time());
						
						// check to see if we should actually be sending this notification now, or not

						$this->out("Sending notification to:\n" . $subscriber["Subscriber"]["contact"] .
							" in Zone " . $zone['Zone']['title'] . " about a pickup on " . date('F j Y', $pickup['start_date']) .
							"\nNotification will be sent at " . date('r', $notification_time)) . "\n\n";
							
						// send email using EmailComponent
					}
				
				}
			}
		}
	}
}	 
?>