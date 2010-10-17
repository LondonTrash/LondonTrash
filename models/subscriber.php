<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
	);

	var $hasMany = array('Notification');
	
	function afterFind($results, $primary) {
		if ($primary) {
			foreach ($results as $key => $val) {
				$results[$key][$this->alias]['contact_email'] = $this->formatContactEmail($val);
			}
		}
		return $results;
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

}
?>