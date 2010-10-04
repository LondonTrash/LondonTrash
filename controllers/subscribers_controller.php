<?php
class SubscribersController extends AppController {
	var $name = "Subscribers";
	
	public function add() {
		debug($this->data);
		if (!empty($this->data)) {
			$subscriber = $this->Subscriber->save($this->data);
			
			if (!empty($subscriber)) {
				$this->data['Notification']['subscriber_id'] = $this->Subscriber->id;
				$this->Subscriber->Notification->save($this->data);
			}
		}
	}
}
?>