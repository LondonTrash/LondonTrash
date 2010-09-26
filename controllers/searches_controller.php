<?php
class SearchesController extends Controller {
    
    var $uses = array('Zone');

    public function index()
    {
        if($this->data)
        {
			$searchAddress = ucwords($this->data['Search']['Address']);
            $zone = $this->Zone->get_zone($searchAddress);
            
            //if zone is empty, try to append city
            $cities = array('London', 'Byron', 'Lambeth', 'Hyde Park');
            foreach($cities as $city)
            {
				if (empty($zone))
				{
					$searchAddress = $searchAddress .= ', ' . $city . ', ON';
					$zone = $this->Zone->get_zone($searchAddress);
				} else {
					continue;
				}
			}
            
            if(!empty($zone))
            {
				$this->Session->write("address", $searchAddress);
				$this->Session->write("zone", $zone);
                $this->redirect(array("controller"=>"zones", "action"=>"view", $zone));
            }
            else
            {
                $this->Session->setFlash("Your address was not found. Please verify that you have typed it correctly and search again.");
            }
        }
    }
};

?>
