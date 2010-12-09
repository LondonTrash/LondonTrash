<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
	);

	var $hasMany = array('Notification');
	
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => 'customEmail',
				'message' => 'Please enter a valid email address'
			)
		),
		'phone' => array(
			'phone' => array(
				'rule' => 'checkPhone',
				'message' => 'Please enter a 10-digit phone number'
			)
		),
		'provider_id' => array(
			'provider' => array(
				'rule' => 'checkProvider',
				'message' => 'Please choose your provider'
			)
		)
	);
	
	function afterFind($results, $primary) {
		if ($primary) {
			foreach ($results as $key => $val) {
				$results[$key][$this->alias]['contact_email'] = $this->formatContactEmail($val);
			}
		}
		return $results;
	}
	
	function beforeSave() {
		// strip non-numeric characters from phone number
		if (!empty($this->data['Subscriber']['phone'])) {
			$this->data['Subscriber']['phone'] = $this->formatPhoneNumber($this->data['Subscriber']['phone']);
		}
		return true;		
	}
	
	function saveSubscriber($data = null) {
		if (empty($data)) {
			return false;
		}
		$hasData = false;
		
		if (!empty($data['Subscriber']['email'])) {
			$hasData = true;
			
			$subscriberData['Subscriber']['contact'] = $data['Subscriber']['email'];
			$subscriberData['Subscriber']['provider_id'] = 1;
			$subscriberData['Subscriber']['zone_id'] = $data['Subscriber']['zone_id'];
			
			$subscriberData['Notification'][0]['delay'] = NULL;
			
			if (!$this->saveAll($subscriberData, array('validate' => false))) {
				return false;
			}
		}
		if (!empty($data['Subscriber']['phone']) && !empty($data['Subscriber']['provider_id'])) {
			$hasData = true;
			
			$subscriberData['Subscriber']['contact'] = $data['Subscriber']['phone'];
			$subscriberData['Subscriber']['provider_id'] = $data['Subscriber']['provider_id'];
			$subscriberData['Subscriber']['zone_id'] = $data['Subscriber']['zone_id'];

			$subscriberData['Notification'][0]['delay'] = NULL;
			
			if (!$this->saveAll($subscriberData, array('validate' => false))) {
				return false;
			}
		}
		if ($hasData != true) {
			return false;
		}
		return true;
	}
	
	private function formatContactEmail($data) {
		if (!empty($data)) {
			if ($data['Provider']['protocol_id'] == 1) {
				// Email
				return $data[$this->alias]['contact'];
			} else {
				// SMS
				return $data[$this->alias]['contact'] . '@' . $data['Provider']['template'];
			}
		}
		return false;
	}
	
	private function formatPhoneNumber($data) {
		if (!empty($data)) {
			return preg_replace('/[^0-9]+/', '', $data);
		}
		return false;
	}
	
	function customEmail($field = array()) { 
		foreach ($field as $key => $value) { 
			if (empty($value) || Validation::email($value)) { 
				return true; 
			} 
		} 
		return false;
	}
	
	function checkPhone($field = array()) {
		foreach ($field as $key => $value) {
			if (empty($value) || is_numeric($this->formatPhoneNumber($value))) {
				return true;
			}
		}
		return false;
	}
	
	function checkProvider($field = array()) {
		foreach ($field as $key => $value) {
			if (!empty($this->data['Subscriber']['phone']) && empty($value)) {
				return false;
			}
		}
		return true;
	}

}
?>