<?php

class Zone extends AppModel {
	var $name = 'Zone';
	var $hasMany = array(
		'Subscriber'
	);
	
	public function __construct() {
		parent::__construct();
		
		$this->AddressCache = ClassRegistry::init('AddressCache');
	}

	/**
	 * Retrieve the zone information from http://openhalton.ca
	 * @param string $address The user entered address
	 * @return string the zone's name (if it was found, otherwise false)
	 */
	public function get_zone($address) {
		$zone_name = $this->getZoneLocal($address);
		if( !$zone_name ) {
			$zone_name = $this->_do_zone_lookup($address);
			if( false !== $zone_name ) {
				$addy_cache_data = array(
					'AddressCache' => array(
						'address' => $address,
						'zone' => $zone_name
				));
				$this->AddressCache->set($addy_cache_data);
				$this->AddressCache->save();
			}
		}
		
		return $zone_name;
	}
	
	private function _do_zone_lookup($address) {
		App::import('Lib', 'lookup', array('file' => 'lookup/ZoneLookup.php'));
		$zone_lookup = new ZoneLookup();
		
		$data = $zone_lookup->get_latlng_by_address($address);
		$data_size = count($data);
		
		if( 0 < $data_size ) {
			$zone_id = $zone_lookup->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng);
			$zone_id = (string) $zone_id;
			return $zone_id;
		}
		
		return false;
	}

	/**
	 * Retrieve the zone information from http://openhalton.ca
	 * @param string $address The user entered address
	 * @return string the zone's name (if it was found, otherwise false)
	 */
	/* private function getZoneOpenhalton($address) {
		//find the zone
		$contents = file_get_contents("http://openhalton.ca/londontrash/LondonTrash.svc/GetZone?address=" . urlencode($address) . "&mapprovider=bing");
		$contents = json_decode($contents);
		$zone_name = false;
		if (!empty($contents->d->ZoneText)) {
			$zone_name = $contents->d->ZoneText;
		}
		//TODO: save zone so we don't have to make a call to a service that may or may not be up all the time

		return $zone_name;
	} */

	/**
	 * Retrieve the zone information from the database
	 * @param string $address The user entered address
	 * @return string the zone's name (if it was found, otherwise false)
	 */
	private function getZoneLocal($address) {
		$data = $this->AddressCache->find('first', array(
			'conditions' => array(
				'AddressCache.address' => $address
			)
		));
		
		if( isset($data['AddressCache']['zone']) ) {
			return $data['AddressCache']['zone'];
		}
		
		return false;
	}

	/**
	 * Get the schedule for the specified zone
	 * @param string $zone
	 * @return array
	 */
	public function get_schedule($zone) {
		$zone_id = $this->find('first', array('conditions' => array('Zone.title' => $zone))); #logic to find zone goes here
		//find the schedule for said zone
		$this->Schedule = ClassRegistry::init('Schedule');
		$zone_schedule = $this->Schedule->get_schedule($zone_id);

		usort($zone_schedule, array($this, "compare_date"));

		return $zone_schedule;
	}

	/**
	 * Compare two dates
	 * @param int $a
	 * @param int $b
	 * @return boolean true if a > b
	 */
	private function compare_date($a, $b) {
		return $a['start_date'] > $b['start_date'];
	}

}

?>