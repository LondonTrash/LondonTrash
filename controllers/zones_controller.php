<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class ZonesController extends AppController
{
    
    public function query_schedule()
    {
        //find the zone
        $zone = $this->Zone->find(); #logic to find zone goes here

        //find the schedule for said zone
        $this->loadModel('Schedule');
        $zone_schedule = $this->Schedule->get_schedule($zone);
       # $all_schedule = $this->Schedule->get_calendar() <-- all schedule;

        
        usort($zone_schedule, array($this, "compare_date"));
        $this->set('zone_schedule', $zone_schedule);

    }
    
    public function compare_date($a, $b)
    {
        return $a['start_date'] > $b['start_date'];
    }

}

?>
