<?php

App::import('Model', 'Zone');

class ZoneTestCase extends CakeTestCase {
    public function testGetZone() {
        $model = new Zone();
        
        $this->assertEqual("F", $model->get_zone("337 Ridout St. South London Ontario")); // pass
        $this->assertEqual("F", $model->get_zone("337 Ridout St. London Ontario")); // fail
        $this->assertEqual("F", $model->get_zone("N6C 3Z4")); // pass
        
        $this->assertEqual("B", $model->get_zone("30 Silverbrook Drive London Ontario")); // pass
        
        $this->assertEqual("B", $model->get_zone("N5X 3B3"));
    }
    
    public function testGetSchedule() {
        $model = new Zone();
        
        // $model->get_scheduale("F");
        // array( Array ( [type] => pickup [start_date] => 1286164800 [end_date] => 1286251200 [description] => ) );
    }
}