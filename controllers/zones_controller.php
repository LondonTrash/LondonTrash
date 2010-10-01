<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

/**
 * @property Zone $Zone
 * @property Auth $Auth
 * @property Session $Session
 */
class ZonesController extends AppController {
	
	var $helpers = array('Time');
		
  function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	//pass me a timestamp, I return 0 = last month, 1 = this month, 2 = next month
	public function ThisMonth($date){
		return (date('Ymd')-date('Ymd', $date))+1;	
	}
		
	/**
	 * view
	 *
	 * @param string $zone (zone letter)
	 * @return void
	 */
	public function view($zone = null) {		
		// if no zone is passed, redirect to search
		if (!$zone) {
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));
		}
		$schedule = null;

		//replacing HTTP:// with webcal:// in the zone calendar link
		$zone_data = $this->Zone->findByTitle($zone);
		$webcal_url = preg_replace( '/http:/', 'webcal:', $zone_data['Zone']['ical_url'], 1 );
		
		if ($this->data) {
			$zone = $this->data['Zone']['zone'];

			//TODO: Add some error processing here
			$this->Zone->Subscriber->set('contact', $this->data['Zone']['Email']);
			$this->Zone->Subscriber->save();
		 }

		if (!empty($zone)) {
			$schedule = $this->Zone->get_schedule($zone);
		}
		
		/*
			TODO: Check for valid zone - i.e. check zones table so they're
			* not trying a gibberish zone
		*/

		if (empty($schedule)) {
			/*
				TODO: This should probably fire off an email to an admin, saying it needs to be fixed
			*/
			$this->Session->setFlash("Sorry, we weren't able to find a schedule for that address. Please try again.");
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));
		}
			
		//set up the calendar vars
		//Sunday of this week
		if (date('N') != 7) {
			$sunday = mktime(0,0,0, date('m'),date('d')-date('N'), date('Y'));
		} else {
			$sunday = mktime();
		}
		
		$curr_date = $sunday;
		
		for ($i=0;$i<375;$i++) {
			$calendar[$curr_date]['date'] = date('d-m-Y', $curr_date);
			$curr_date = mktime(0,0,0,date('m',$curr_date),date('d',$curr_date)+1,date('Y',$curr_date));
		}

		if( !empty($schedule) ) {
			foreach ($schedule as $event) {
				if (!isset($calendar[$event['start_date']])) {
					break;
				}
				$calendar[$event['start_date']]['event'] = $event;
			}
		}
		
		$formattedZone = $this->Zone->field('formatted_title', array('title' => $zone));

		$this->set("webcal_url", $webcal_url);		
		$this->set("calendar", $calendar);
		$this->set("schedule", $schedule);
		$this->set("zone", $zone);
		$this->set('zone_id', $zone_data['Zone']['id']);
		$this->set('formattedZone', $formattedZone);
		$this->set('delay_unit', array('hours', 'days'));
		$this->set('notification_type', array('Regular', 'Special', 'Both'));
		$this->set('title_for_layout', 'Schedule (' . $formattedZone . ')');
	}

}
?>
