<?php
class SearchesController extends Controller {
    
    var $uses = array('Zone');

		/**
		 * Keep it DRY
		 *
		 * @param string $address 
		 * @param string $zone 
		 * @return void
		 * @author Scott Reeves
		 */
		private function updateSession($address, $zone) {
			$this->Session->write('address', $address);
			$this->Session->write('zone', $zone);
		}
		
		/**
		 * Used with ambiguous addresses
		 * Updates the session and redirects to the proper schedule
		 *
		 * @param string $address 
		 * @param string $zone 
		 * @return void
		 * @author Scott Reeves
		 */
		public function choose($address, $zone) {
			if (!empty($address) && !empty($zone)) {
				// clear the ambiguities from the session
				$this->Session->delete('addressChoices');
				
				$this->updateSession($address, $zone);
				$this->redirect(array('controller' => 'zones', 'action' => 'view', $zone));
			}
			$this->Session->setFlash('Sorry! Please try your search again.');
			$this->redirect(array('action' => 'index'));
		}

    public function index($address = null) {
			
			if ($this->data || !empty($address)) {
				if ($this->data) {
					$address = $this->data['Search']['address'];
				}

				// clear any ambiguous address we have in the session
				$this->Session->delete('addressChoices');
				
				// Check to make sure they've entered an address before we do a lookup
				$rawSearchAddress = trim($address);
	
				if ($rawSearchAddress == 'Enter address' || empty($rawSearchAddress)) {
					$this->Session->setFlash("Please enter an address in the search box.");
					$this->redirect(array('action' => 'index'));
				}
				
				$searchAddress = ucwords($address);
				$zone = $this->Zone->get_zone($searchAddress);
			
			// quickly hacked so that people like Cottser would stop complaining
			// since people like Gav haven't updated this yet with the "select your N or S or E or W"
			/*
				TODO: Not sure if we need this anymore :) -Cottser
			*/
			$zone_name = null;
      if( isset($zone[0]) ) {
				$zone_name = $zone[0]->zone_name;
				$searchAddress = $zone[0]->address;
			}
			
			if( !$zone_name ) {
				//if zone is empty, try to append city
				$zone_name = null;
				$cities = array('London', 'Byron', 'Lambeth', 'Hyde Park');
				
				foreach($cities as $city) {
					if (empty($zone)) {
						$searchAddress = $searchAddress .= ', ' . $city . ', ON';
						$zone = $this->Zone->get_zone($searchAddress);
				
						$zone_name = null;
						if( isset($zone[0]) ) {
							$zone_name = $zone[0]->zone_name;
							$searchAddress = $zone[0]->address;
					
							break;
						}
					}
				}
				
			}
			
			if ($this->Zone->are_results_ambiguous()) {
				// pass array to view so we can display it there
				$this->Session->write('addressChoices', $zone);

				// redirect them back to search page with their search filled in
				$this->redirect(array('action' => 'index', '?' => array('a' => $rawSearchAddress)));
			}
            
            if(!empty($zone_name)) {
								$this->updateSession($searchAddress, $zone_name);
                $this->redirect(array("controller" => "zones", "action" => "view", $zone_name));
            }
            else
            {
                $this->Session->setFlash("Your address was not found. Please verify that you have typed it correctly and search again.");
            }
        }
    }
};

?>
