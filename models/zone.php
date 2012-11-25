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
		
		ClassRegistry::init('AddressCache');
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
	
	public function are_results_ambiguous() {
		return 1 < $this->zone_data_size ? true : false;
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
				$match = FALSE;
				// Loop through address components and pull out country, province, and
				// city.
				foreach ($data[$i]->address_components as $address_component) {
					// Check that the country is Canada, otherwise skip to the next item.
					if (in_array('country', $address_component->types) && $address_component->long_name != 'Canada') {
						continue;
					}
					// Check that the province is Ontario, otherwise skip to the next
					// item.
					if (in_array('administrative_area_level_1', $address_component->types) && $address_component->long_name != 'Ontario') {
						continue;
					}
					// Check that the city is London, otherwise skip to the next item.
					if (in_array('locality', $address_component->types)) {
						if ($address_component->long_name == 'London') {
							// Country, province, and city match.
							$match = TRUE;
						} else {
							continue;
						}
					}
				}

				if ($match == TRUE) {
					$zone_name = $zone_lookup->get_zone_by_latlng($data[$i]->geometry->location->lat, $data[$i]->geometry->location->lng);
					if( $zone_name ) {
						$o = new stdClass;
						$o->zone_name = (string) $zone_name;
						$o->address = $address;
						$o->formatted_address = $data[$i]->formatted_address;
						
						$this->zone_data[] = $o;
						
						// this is jedi aaron in action.
						++$this->zone_data_size;
						
						$addy_cache_data = array(
							'AddressCache' => array(
								'address' => $address,
								'formatted_address' => $data[$i]->formatted_address,
								'zone' => $zone_name
						));
						
						$this->AddressCache = new AddressCache();
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
		$this->AddressCache = ClassRegistry::init('AddressCache');
		$data = $this->AddressCache->find('all', array(
			'conditions' => array(
				'AddressCache.address' => $address
			)
		));
		$data_size = count($data);
		if( 0 < $data_size ) {
			$this->zone_data = array();
			$this->zone_data_size = 0;
			
			for( $i = 0; $i < $data_size; ++$i ) {
				$o = new stdClass;
				$o->zone_name = $data[$i]['AddressCache']['zone'];
				$o->address = $data[$i]['AddressCache']['address'];
				$o->formatted_address = $data[$i]['AddressCache']['formatted_address'];
				
				$this->zone_data[] = $o;
				++$this->zone_data_size;
			}
			
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
		$zone_id = $this->find('first', array('conditions' => array('Zone.title' => $zone)));
		//find the schedule for said zone
		$this->Schedule = ClassRegistry::init('Schedule');
		$zone_schedule = $this->Schedule->get_schedule($zone_id);
		usort($zone_schedule, array($this, "compare_date"));
		return $zone_schedule;
	}
	
	public function get_next_pickup($zone, $options = array()) {
		$schedule = $this->get_schedule($zone);
		
		// filter out past events
		$schedule = array_filter($schedule, array($this, "filter_past_pickups"));
		
		// filter by pickup type
		if (isset($options['type'])) {
			$this->pickupType = $options['type'];
			$schedule = array_filter($schedule, array($this, "filter_pickup_type"));
		}
		
		return array_shift($schedule);
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
	
	private function filter_past_pickups($array) {
		return $array['start_date'] > time();
	}
	
	private function filter_pickup_type($array) {
		return $array['type'] == $this->pickupType;
	}
}

?>