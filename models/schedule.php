<?php
    App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));
    
class Schedule extends AppModel {

    var $useTable = false;


    public function get_schedule($zone)
    {

         $url = $zone['Zone']['ical_url'];


         $ical = new SG_iCal($url);
         $schedule = array();
         $events = $ical->getEvents();
         if( is_array($events) ) {
            // Commented out by Aaron McGowan.
            // foreach( $ical->getEvents() As $event ) {
            foreach( $events as $event ) {
                $schedule[] = array('type' => $event->getSummary(), 'start_date' => $event->getStart(), 'end_date' => $event->getEnd(), 'description' => $event->getDescription());
            }
         }
         
         return $schedule;
    }
    
    //Usually we'll pass this the 'all zones' info,
    //but returns the next scheduled event
    public function get_nextScheduled($zone)
    {

         $url = $zone['Zone']['ical_url'];


         $ical = new SG_iCal($url);
         $schedule = array();
         $events = $ical->getEvents();
         if( is_array($events) ) {
         	
         	$nextScheduled = 0;
            foreach( $events as $event ) {
            	
            	//we want to return the earliest event after today
               	if ($event->getStart() > mktime() && ($nextScheduled == 0 || $nextScheduled > $event->getStart())){
               		$nextScheduled = array('type' => $event->getSummary(), 'start_date' => $event->getStart(), 'end_date' => $event->getEnd(), 'description' => $event->getDescription());
               	}
            }
         }
         
         return $nextScheduled;
    		
    }
};