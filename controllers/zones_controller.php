<?php
App::import('Vendor', 'SG-iCal', array('file' => 'SG-iCalendar/SG_iCal.php'));

class ZonesController extends AppController
{
	
	var $helpers = array('Time');
		
    function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}
		//pass me a timestamp, I return 0 = last month, 1 = this month, 2 = next month
		public function ThisMonth($date){
			return (date('Ymd')-date('Ymd', $date))+1;	
		}
		public function get_CalClass($date){
			$class = '';
			if(date('dmY',$date) < date('dmY')){
				$class .= ' before-today';
			}
			if(date('dmY',$date) == date('dmY')){
				$class .= ' today';
			}
			if(date('dmY',$date) > date('dmY')){
				$class .= ' after-today';
			}
			if ($this->ThisMonth($date) < 1){
				$class .= ' last-month';
			}
			if ($this->ThisMonth($date) == 1){
				$class .= ' this-month';
			}
			if ($this->ThisMonth($date) > 1){
				$class .= ' next-month';
			}
			return $class;
		}	
		
        public function view($zone = null) #zone letter
        {


            $schedule = null;
            
            if($this->data)
             {
                    $zone = $this->data['Zone']['zone'];

                    //TODO: Add some error processing here

                    var_dump($this->data['Zone']);
                    $this->Zone->Subscriber->set('contact', $this->data['Zone']['Email']);
                    $this->Zone->Subscriber->save();
             }

            if(!empty($zone))
            {
                $schedule = $this->Zone->get_schedule($zone);
            }

            if(empty($schedule))
            {
                $this->Session->setFlash("BOO FAIL!!!");
            }
			
			//set up the calendar vars
			//Sunday of this week
			$sunday = mktime(0,0,0, date('m'),date('d')-date('N'), date('Y'));
			$curr_date = $sunday;
			for ($i=0;$i<35;$i++){
				$calendar[$curr_date]['class'] = $this->get_CalClass($curr_date);
				$curr_date = mktime(0,0,0,date('m',$curr_date),date('d',$curr_date)+1,date('Y',$curr_date));
			}
			foreach ($schedule as $event){
				if (!isset($calendar[$event['start_date']])){
					break;
				}	
				$calendar[$event['start_date']]['class'] .= ' '.$event['type'];
			}
			
			$this->set("calendar", $calendar);
			
            $this->set("schedule", $schedule);
            $this->set("zone", $zone);
        }

}

?>
