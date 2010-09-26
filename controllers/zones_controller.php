<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class ZonesController extends AppController
{
	
	var $helpers = array('Time');
		
    function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

        public function view($zone = null) #zone letter
        {
            $schedule = null;
            if(!empty($zone))
            {
                $schedule = $this->Zone->get_schedule($zone);
            }

            if(empty($schedule))
            {
                $this->Session->setFlash("BOO FAIL!!!");
            }

            $this->set("schedule", $schedule);
        }
}

?>
