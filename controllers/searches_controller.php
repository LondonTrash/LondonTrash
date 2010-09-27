<?php
class SearchesController extends Controller {
    
    var $uses = array('Zone');

    public function index()
    {
        if($this->data)
        {
			$searchAddress = ucwords($this->data['Search']['Address']);
            $zone = $this->Zone->get_zone($searchAddress);
			
			// quickly hacked so that people like Cottser would stop complaining
			// since people like Gav haven't updated this yet with the "select your N or S or E or W"
			$zone_name = null;
            if( isset($zone[0]) ) {
				$zone_name = $zone[0]->zone_name;
				$searchAddress = $zone[0]->address;
			}
			
            //if zone is empty, try to append city
            /* $cities = array('London', 'Byron', 'Lambeth', 'Hyde Park');
            foreach($cities as $city) {
							if (empty($zone)) {
								$searchAddress = $searchAddress .= ', ' . $city . ', ON';
								$zone = $this->Zone->get_zone($searchAddress);
							}
						} */
            
            if(!empty($zone_name))
            {
				$this->Session->write("address", $searchAddress);
				$this->Session->write("zone", $zone_name);
                $this->redirect(array("controller"=>"zones", "action"=>"view", $zone_name));
            }
            else
            {
                $this->Session->setFlash("Your address was not found. Please verify that you have typed it correctly and search again.");
            }
        }
    }
};

?>
