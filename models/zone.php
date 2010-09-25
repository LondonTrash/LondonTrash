<?php
class Zone extends AppModel {
	var $name = 'Zone';

	var $hasMany = array(
		'Subscriber'
	);



        public function get_zone($address)
        {
			//if we haven't got the zone locally, get it from the openhalton database
			if(!$zone_name = $this->get_zone_local($address)){
				$zone_name = $this->get_zone_openhalton($address);
			}
			return $zone_name;
        }

		private function get_zone_openhalton($address){
			//find the zone
            $contents = file_get_contents("http://openhalton.ca/londontrash/LondonTrash.svc/GetZone?address=" . urlencode($address) . "&mapprovider=bing");
            $contents = json_decode($contents);
			var_dump($contents->d->ZoneText);
			$zone_name = false;
			if(!empty($contents->d->ZoneText)){
				$zone_name = $contents->d->ZoneText;
			}
			//TODO: save zone so we don't have to make a call to a service that may or may not be up all the time

            return $zone_name;
		}

		private function get_zone_local($address){
			//parse out postal code
			//get the zone based on the postal code
			//if zones can change: make sure that the zone retrieval date is not greater than x
			return false;
		}

        public function get_schedule($zone)
        {
            $zone_id = $this->find('first', array('conditions' => array('Zone.title' => $zone))); #logic to find zone goes here

            //find the schedule for said zone
            $this->Schedule = ClassRegistry::init('Schedule');
            $zone_schedule = $this->Schedule->get_schedule($zone_id);

            usort($zone_schedule, array($this, "compare_date"));

            return $zone_schedule;
        }

        public function compare_date($a, $b)
        {
            return $a['start_date'] > $b['start_date'];
        }

}
?>