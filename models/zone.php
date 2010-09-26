<?php
class Zone extends AppModel {
	var $name = 'Zone';

	var $hasMany = array(
		'Subscriber'
	);



        public function get_zone($address)
        {
            //find the zone
            $contents = file_get_contents("http://openhalton.ca/londontrash/LondonTrash.svc/GetZone?address=" . urlencode($address) . "&mapprovider=bing");
            $contents = json_decode($contents);

            $zone_name = $contents->d->ZoneText;

            return $zone_name;
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