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
		$schedule = null;

		if ($this->data) {
			$zone = $this->data['Zone']['zone'];

			//TODO: Add some error processing here
			$this->Zone->Subscriber->set('contact', $this->data['Zone']['Email']);
			$this->Zone->Subscriber->save();
		 }

		if (!empty($zone)) {
			$schedule = $this->Zone->get_schedule($zone);
		}
		//print_r($schedule);
		if (empty($schedule)) {
			$this->Session->setFlash("BOO FAIL!!!");
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
				/*
					TODO: Fix undefined index: 'class' error here.
				*/
				$calendar[$event['start_date']]['class'] .= ' ' . $event['type'];
				$calendar[$event['start_date']]['event'] = $event;
			}
		}
		
		$this->set("calendar", $calendar);
	
		$this->set("schedule", $schedule);
		$this->set("zone", $zone);
		$this->set('delay_unit', array('hours', 'days'));
		$this->set('notification_type', array('Regular', 'Special', 'Both'));
	}

}
?>