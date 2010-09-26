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
            foreach( $events as $event ) {
                $schedule[] = array('type' => $event->getSummary(), 'start_date' => $event->getStart(), 'end_date' => $event->getEnd(), 'description' => $event->getDescription());
            }
         }
         
         return $schedule;
    }
};