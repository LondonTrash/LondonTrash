<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
  );

	var $hasMany = array(
		'Notification'
	);

	function beforeSave() {
		// check for a protocol (email/SMS)
		if (!empty($this->data['Subscriber']['protocol_id'])) {
			// set value of 'contact' according to the protocol that is set
			if ($this->data['Subscriber']['protocol_id'] == 1) {
				// email
				$this->data['Subscriber']['contact'] = $this->data['Subscriber']['email'];
				// set provider to email
				$this->data['Subscriber']['provider_id'] = 1;
			} elseif ($this->data['Subscriber']['protocol_id'] == 2) {
				// SMS
				$this->data['Subscriber']['contact'] = $this->stripNonNumeric($this->data['Subscriber']['phone']);
			}
			unset($this->data['Subscriber']['protocol_id']);
			
			if (empty($this->data['Subscriber']['contact'])) {
				return false;
			}
			
			return true;
		}
		// if we don't have a protocol type, cancel the save
		return false;
	}
	
	private function stripNonNumeric($data) {
		/*
			TODO: Strip non-numeric characters from phone numbers
		*/
		return $data;
	}
}
?>