<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class Schedule extends AppModel {

	var $useTable = false;

	public function get_schedule($zone) {
		$url = $zone['Zone']['ical_url'];
		
		$ical = new SG_iCal($url);
		$schedule = array();
		$events = $ical->getEvents();

		if (!is_array($events)) { return array(); }

		foreach($events as $event) {
			$calEvent = array(
				'type' => $event->getSummary(),
				'start_date' => $event->getStart(),
				'end_date' => $event->getEnd()-1,
				'description' => $event->getDescription()
			);

			if (isset($event->recurrence)) {
				$count = 0;
				$start = $event->getStart();
				$freq = $event->getFrequency();
				if ($freq->firstOccurrence() == $start) {
					$schedule[] = $calEvent;
				}
				while (($next = $freq->nextOccurrence($start)) > 0 ) {
					if (!$next or $count >= 1000) break;
					$count++;
					$start = $next;
					$calEvent["start_date"] = $start;
					$calEvent["end_date"] = $start + $event->getDuration()-1;

					$schedule[] = $calEvent;
				}
			} 
			$schedule[] = $calEvent;
		}
		
		return $schedule;
	}

	//Usually we'll pass this the 'all zones' info,
	//but returns the next scheduled event
	public function get_nextScheduled($zone) {
		$url = $zone['Zone']['ical_url'];

		$ical = new SG_iCal($url);
		$schedule = array();
		$events = $ical->getEvents();
		if( is_array($events) ) {
			$nextScheduled = 0;
			foreach( $events as $event ) {
				//we want to return the earliest event after today
				if ($event->getStart() > mktime() && ($nextScheduled == 0 || $nextScheduled > $event->getStart())){
					$nextScheduled = array(
						'type' => $event->getSummary(),
						'start_date' => $event->getStart(),
						'end_date' => $event->getEnd(),
						'description' => $event->getDescription()
					);
				}
			}
		}
 
		return $nextScheduled;				
	}

};