<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
	);

	var $hasMany = array(
		'Notification' => array(
			'dependent' => true
		)
	);
	
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
	
	function beforeValidate() {
		// Trim whitespace from data
		$whitespace = create_function('&$value, &$key', '$key = trim($key); $value = trim($value);');
		array_walk_recursive($this->data, $whitespace);
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
			
			$subscriberData['Subscriber']['contact'] = $this->formatPhoneNumber($data['Subscriber']['phone']);
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
		if (!empty($data) && isset($data['Provider'])) {
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
			$data = preg_replace('/[^0-9]+/', '', $data);
			
			// remove 1 prefix
			if (strpos($data, '1') == 0) {
				$data = substr($data, 1);
			}
			
			return $data;
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
			if (empty($value)) {
				return true;
			}
			if (strlen($this->formatPhoneNumber($value)) == 10 && is_numeric($this->formatPhoneNumber($value))) {
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
	
	function matchRecord($id = null, $data = null) {
		if (empty($id) || empty($data)) {
			return false; 
		}
		// find record matching ID
		$this->contain('Provider');
		if (!$subscriber = $this->find('first', array('conditions' => array($this->alias . '.' . 'id' => $id)))) {
			return false;
		}
		// format phone numbers before comparing
		if ($subscriber['Provider']['protocol_id'] == 2) {
			$data[$this->alias]['contact'] = $this->formatPhoneNumber($data[$this->alias]['contact']);
		}

		return $subscriber[$this->alias]['contact'] == $data[$this->alias]['contact'];
	}

}
?>