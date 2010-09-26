<?php

App::import('Model', 'Zone');

class ZoneTestCase extends CakeTestCase {
    public function testGetZone() {
        $model = new Zone();
        
        $this->assertEqual("F", $model->get_zone("337 Ridout St. South London Ontario")); // pass
        // $this->assertEqual("F", $model->get_zone("337 Ridout St. London Ontario")); // fail - no "north" or "south"
        $this->assertEqual("F", $model->get_zone("N6C 3Z4")); // pass
        $this->assertEqual("F", $model->get_zone("36 Adare Crescent, London, ON, Canada"));
        
        $this->assertEqual("B", $model->get_zone("30 Silverbrook Drive London Ontario")); // pass
        $this->assertEqual("B", $model->get_zone("N5X 3B3")); // pass
        
        $this->assertEqual("E", $model->get_zone("610 Commissioners St. East London Ontario"));
        $this->assertEqual("E", $model->get_zone("612 Commissioners Rd E, London, ON"));
        
        $this->assertEqual("D", $model->get_zone("1183 Highbury Ave N, London, ON"));
        
        $this->assertEqual("CORE", $model->get_zone("366 Dundas St, London, ON")); // downtown
    }
    
    public function testGetSchedule() {
        $model = new Zone();
        $schedule = $model->get_schedule("A");
        
        $this->assertEqual(true, $this->_scheduleCheck("5-10-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("12-10-2010", $schedule)); // yard materials
        $this->assertEqual(false, $this->_scheduleCheck("13-10-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("14-10-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("22-10-2010", $schedule));
        $this->assertEqual(false, $this->_scheduleCheck("25-10-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("21-12-2010", $schedule));
        $this->assertEqual(false, $this->_scheduleCheck("29-12-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("31-12-2010", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("14-02-2011", $schedule));
        $this->assertEqual(false, $this->_scheduleCheck("22-02-2011", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("23-02-2011", $schedule));
        $this->assertEqual(false, $this->_scheduleCheck("22-04-2011", $schedule));
        $this->assertEqual(false, $this->_scheduleCheck("25-04-2011", $schedule));
        $this->assertEqual(true, $this->_scheduleCheck("26-04-2011", $schedule));
        
        $this->assertEqual(false, $this->_scheduleCheck("7-09-2011", $schedule)); // past the current schedule/calendar
        
        // 5-10-2010 -                                               29-09-2011      
        // print date("j-m-Y", $schedule[0]['start_date']) . ' - ' . date("j-m-Y", $schedule[count($schedule) - 1]['start_date']);
        // print count($schedule);
        
        // $model->get_scheduale("F");
        // array( Array ( [type] => pickup [start_date] => 1286164800 [end_date] => 1286251200 [description] => ) );
    }
    
    private function _scheduleCheck($date, array &$schedule) {
        foreach( $schedule as &$day ) {
            if( $date == date("j-m-Y", $day['start_date']) ) {
                return true;
            }
        }
        
        return false;
    }
}