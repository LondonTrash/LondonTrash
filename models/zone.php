<?php

class Zone extends AppModel {
	var $name = 'Zone';
	var $hasMany = array(
		'Subscriber'
	);
	
	protected $zone_data = null;
	protected $zone_data_size = 0;
	
	public function __construct() {
		parent::__construct();
		
		$this->AddressCache = ClassRegistry::init('AddressCache');
	}

	/**
	 * Retrieve the zone information from http://openhalton.ca
	 * @param string $address The user entered address
	 * @return string the zone's name (if it was found, otherwise false)
	 */
	public function get_zone($address, $lookup = true) {
		if( $lookup ) {
			$this->lookup_zone($address);
		}
				
		if( 0 < $this->zone_data_size ) {
			return $this->zone_data;
		}
		
		return false;
	}
	
	public function lookup_zone($address) {
		if( !$this->getZoneLocal($address) ) {
			if( $this->_do_zone_lookup($address) ) {
				if( 0 < $this->zone_data_size ) {
					return true;
				}
			}
		} else {
			return true;
		}
		
		return false;
	}
	
	public function get_zone_result_count() {
		return $this->zone_data_size;
	}
	
	private function _do_zone_lookup($address) {
		App::import('Lib', 'lookup', array('file' => 'lookup/ZoneLookup.php'));
		$zone_lookup = new ZoneLookup();

		// if we don't get a lat long from the address, return false
		if (!$data = $zone_lookup->get_latlng_by_address($address)) {
			return false;
		}

		$data_size = count($data);
		
		if( 0 < $data_size ) {
			$this->zone_data = array();
			$this->zone_data_size = 0;
			
			for( $i = 0; $i < $data_size; ++$i ) {
				// test to assure that resolved addresses are actually in London Ontario
				if( isset($data[$i]->address_components[2]->long_name) && $data[$i]->address_components[2]->long_name == "London" &&
				   isset($data[$i]->address_components[4]->long_name) && $data[$i]->address_components[4]->long_name == "Ontario" &&
				   isset($data[$i]->address_components[5]->long_name) && $data[$i]->address_components[5]->long_name == "Canada" ) {
				
				$zone_name = $zone_lookup->get_zone_by_latlng($data[$i]->geometry->location->lat, $data[$i]->geometry->location->lng);
				if( $zone_name ) {
					$this->zone_data[$i] = new stdClass;
					$this->zone_data[$i]->zone_name = (string) $zone_name;
					$this->zone_data[$i]->address = $data[$i]->formatted_address;
					
					++$this->zone_data_size;
					
					$addy_cache_data = array(
						'AddressCache' => array(
							'address' => $address,
							'zone' => $zone_name
					));
					$this->AddressCache->set($addy_cache_data);
					$this->AddressCache->save();
				}
				
				}
			}
			
			return true;
		}
		
		return false;
	}

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
			$this->zone_data = array();
			$this->zone_data[0] = new stdClass;
			$this->zone_data[0]->zone_name = $data['AddressCache']['zone'];
			$this->zone_data[0]->address = $data['AddressCache']['address'];
			
			$this->zone_data_size = 1;
			
			return true;
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