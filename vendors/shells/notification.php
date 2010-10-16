<?php
class NotificationShell extends Shell {

	var $uses = array('Subscriber', 'Zone');
	
	function main() {
		/**
		 * How far before we should send the notification
		 * This value is in seconds.
		 * 
		 * Since we're using all day events in gCal, 12am - 5h = 7pm the night before
		 */
		$notificationOffset = 60 * 60 * 5;
		
		//for each zone, get the next pickup times
		$zones = $this->Zone->find('list', array('fields' => array('Zone.title', 'Zone.id')));
		
		foreach ($zones as $zone_title => $zone_id) {
			//get the schedule
			$schedule = $this->Zone->get_schedule($zone_title);

			//for each user in the zone
			$subscribers = $this->Subscriber->find('all', array('conditions' => array('Subscriber.zone_id' => $zone_id)));
			
			foreach ($subscribers as $subscriber) {
				foreach ($subscriber['Notification'] as $notification) {
					foreach ($schedule as $pickup) {
						
						// when to notify
						$notification_time = $pickup['start_date'] - $notificationOffset;
						
						// only look at events in the future.
						// also, let's just worry about regular pickups for now.
						if (time() <= $notification_time && $pickup['type'] == 'pickup') {
							
							// check to see if we've already sent a notification
							if ($notification['last_sent'] == null || $notification['last_sent'] < $notification_time) {
								$this->Subscriber->Notification->id = $notification['id'];
								$this->Subscriber->Notification->saveField('last_sent', time());

								$this->out("\n\nSending notification to:\n" . $subscriber["Subscriber"]["contact"] .
									" in Zone " . $zone_title . " about a pickup on " . date('F j Y', $pickup['start_date']) .
									"\nNotification will be sent at " . date('r', $notification_time));
							}
						
						}
					}
					#	 var_dump($notification);
				}
				//for each notification for that user
				//check to see if the notification should be sent
				//check to see if the notification has been sent already
				//if not, send it out!
			}
		}
	}
}	 
?>