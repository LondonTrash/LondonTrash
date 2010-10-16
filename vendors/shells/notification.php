<?php
class NotificationShell extends Shell {

	var $uses = array('Subscriber', 'Zone');

	function main() {
		//send out reminder emails
		$this->out("This is your reminder!");

		//for each zone, get the next pickup times
		$zones = $this->Zone->find('list', array('fields' => array('Zone.title', 'Zone.id')));
		
		#var_dump($zones);
		
		foreach ($zones as $zone_title => $zone_id) {
			//get the schedule
			$schedule = $this->Zone->get_schedule($zone_title);

			//for each user in the zone
			$subscribers = $this->Subscriber->find('all', array('conditions' => array('Subscriber.zone_id' => $zone_id)));

			foreach ($subscribers as $subscriber) {
				foreach ($subscriber['Notification'] as $notification) {
					foreach ($schedule as $pickup) {
						$notification_time = $pickup['start_date'] - $notification['delay'] - strtotime('20 minutes');
						
						if (time() >= $notification_time && ($notification['last_sent'] == null || $notification['last_sent'] > $notification_time)) {
							$this->Subscriber->Notification->id = $notification['id'];
							$this->Subscriber->Notification->saveField('last_sent', time());

							echo "Sending notification to" . $subscriber["Subscriber"]["contact"] . " about a pickup on " . $pickup['start_date'];
							var_dump($subscriber["Subscriber"]["contact"]);
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