<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class ZonesController extends AppController {
	
	var $helpers = array('Time');
		
  function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->getCookieData();
	}
		
	/**
	 * View garbage schedule
	 *
	 * @param string $zone (zone letter)
	 * @return void
	 */
	public function view($zone = null) {		
		// if no zone is passed, redirect to search
		if (!$zone) {
			$this->redirect(array('controller' => 'searches', 'action' => 'clear'));
		}
		$schedule = null;

		//replacing HTTP:// with webcal:// in the zone calendar link
		// This is for webcal:// iCal feeds
		$zone_data = $this->Zone->findByTitle($zone);
		$webcal_url = str_replace('http://', 'webcal://', $zone_data['Zone']['ical_url']);
		
		// add to google calendar link
		$gcalPrefix = 'http://www.google.com/calendar/render?cid=';
		$gcal_url = $gcalPrefix . str_replace('/ical/', '/feeds/', $zone_data['Zone']['ical_url']); 
		$gcal_url = str_replace('.ics', '', $gcal_url);
		
		if (!empty($zone)) {
			$schedule = $this->Zone->get_schedule($zone);
		}
		
		if (empty($schedule)) {
			$this->Session->setFlash("Sorry, we weren't able to find a schedule for that address. Please try again.");
			$this->redirect(array('controller' => 'searches', 'action' => 'clear'));
		}
		
		$next_pickup = 0;
		foreach ($schedule as $date){
			if (date($date['start_date']) > mktime() && ($next_pickup == 0 || $next_pickup  > $date['start_date']) && $date['type'] == 'pickup'){
				$next_pickup = $date['start_date'];
			}
		}
		
		//something to put in #holiday
		$holiday = $this->Zone->get_schedule('all');		
		
		$formattedZone = $this->Zone->field('formatted_title', array('title' => $zone));

		$this->set("pickup", $next_pickup);
		$this->set("webcal_url", $webcal_url);
		$this->set("gcal_url",$gcal_url);
		$this->set("schedule", $schedule);
		$this->set("zone", $zone);
		$this->set('formattedZone', $formattedZone);
		$this->set('delay_unit', array('hours', 'days'));
		$this->set('notification_type', array('Regular', 'Special', 'Both'));
		$this->set('title_for_layout', 'Schedule (' . $formattedZone . ')');
		
		$this->Session->write('zone_id', $zone_data['Zone']['id']);
	}
}
?>