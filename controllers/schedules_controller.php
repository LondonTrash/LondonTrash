<?php

App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class SchedulesController extends AppController
{
    
    public function get_calendar()
    {

     $ical = new SG_iCal("http://www.google.com/calendar/ical/nlkc39jt4p0nbc4pk9pj7p5fh0%40group.calendar.google.com/public/basic.ics");
     foreach( $ical->getEvents() As $event ) {
        var_dump($event);
     }

     $this->set('greeting', 'Hello there');
    }
};
?>